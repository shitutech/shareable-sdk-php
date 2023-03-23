<?php

namespace Shitutech\Shareable;

use Shitutech\Shareable\Exceptions\SeException;
use Shitutech\Shareable\Helpers\UtilHelper;
use Shitutech\Shareable\Modules\Base\BaseRequest;

final class SeClientRequest
{
    /**
     * @var BaseRequest|null
     */
    protected $request = null;

    /**
     * @var string
     */
    protected $userAgent = 'ShareableSdk/v1.0.0';

    /**
     * @var float
     */
    protected $timeout = 15.0;

    public function __construct(BaseRequest $request)
    {
        $this->request = $request;
    }


    /**
     * @param string $userAgent
     * @return SeClientRequest
     */
    public function setUserAgent(string $userAgent): SeClientRequest
    {
        $userAgent = trim($userAgent);
        if ($userAgent) {
            $this->userAgent .= " {$userAgent}";
        }

        return $this;
    }

    /**
     * @param float $timeout
     * @return SeClientRequest
     */
    public function setTimeout(float $timeout): SeClientRequest
    {
        $this->timeout = $timeout > 0 ? $timeout : 15.0;;
        return $this;
    }

    /**
     * @return string
     * @throws SeException
     */
    public function send(): string
    {
        $dataJson = $this->request->fetchBizData();
        $apiUri = $this->request->getApiPath();

        $nonceStr = UtilHelper::randomStr(32);
        $timestamp = intval(microtime(true) * 1000);

        $objConfig = SeConfig::getInstance();

        $signStr = sprintf("POST\n%s\n%d\n%s\n%s\n", $apiUri, $timestamp, $nonceStr, $dataJson);

        $sign = '';
        if (!openssl_sign($signStr, $sign, $this->getSignKey(), OPENSSL_ALGO_SHA256)) {
            throw new SeException('签名失败。Err: ' . openssl_error_string());
        }

        $signBase64 = base64_encode($sign);

        $authStr = sprintf('%s:%s:%s:%d:%s', $objConfig->getAppId(), $nonceStr,
            $objConfig->getSignType(), $timestamp, $signBase64);

        $ch = curl_init();

        $headers = [
            'Content-Type: application/json;charset=UTF-8',
            'Accept: application/json',
            'Authorization: ' . $authStr,
            'Content-Length: ' . strlen($dataJson),
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, 'https://pay.51wanquan.com' . $apiUri);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);

        $data = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errNo = curl_errno($ch);
        $errMsg = curl_error($ch);
        curl_close($ch);

        if ($errNo) {
            throw new SeException("CURL 请求发生异常。Err: {$errNo}::{$errMsg}");
        }

        if ($data === false) {
            throw new SeException("CURL 请求发生未知异常，响应执行结果为 false");
        }

        $parseResult = $this->parseMessage($data);
        $respBody = trim($parseResult['body']);

        if ($statusCode != 200) {
            throw new SeException("响应抛出异常。HTTP code {$statusCode}" . ($respBody ? ", Err: {$respBody}" : ''));
        }

        if (empty($respBody)) {
            throw new SeException("CURL 远程请求响应未返回任何数据");
        }

        $this->verifyResponseSign($respBody, $parseResult['headers']);

        return $respBody;
    }

    /**
     * @param $respData
     * @param array $respHeaders
     * @return void
     * @throws SeException
     */
    private function verifyResponseSign($respData, array $respHeaders)
    {
        $respVerifySign = '';
        foreach ($respHeaders as $headerKey => $headerValue) {
            $headerKey = strtolower(trim($headerKey));
            if ($headerKey == 'response-signature') {
                $respVerifySign = trim(array_shift($headerValue));
                break;
            }
        }

        if (!$respVerifySign) {
            throw new SeException('未在响应中发现待验签的数据');
        }

        $extractData = UtilHelper::extractStringToStringArray($respVerifySign, ':', true, false, 3);
        if (count($extractData) < 3) {
            throw new SeException('待验签字符串格式不正确');
        }

        list($nonceStr, $timestamp, $sign) = $extractData;
        if (empty($nonceStr) || empty($timestamp) || empty($sign)) {
            throw new SeException('待验签内容存在无效内容');
        }

        $signBinary = base64_decode($sign);
        if (!$signBinary) {
            throw new SeException('待验签签名字符串 base64 解码失败');
        }

        $signStr = "{$nonceStr}\n{$timestamp}\n{$respData}\n";
        if (!openssl_verify($signStr, $signBinary, $this->getVerifyKey(), OPENSSL_ALGO_SHA256)) {
            throw new SeException('响应公钥验签失败。Err: ' . openssl_error_string());
        }
    }

    /**
     * 获取验签公钥
     *
     * @return resource
     * @throws SeException
     */
    private function getVerifyKey()
    {
        $publicKey = SeConfig::getInstance()->getPlatformPublicKey();
        if (!$publicKey) {
            throw new SeException('验签公钥不存在');
        }

        $publicKeyReal = "-----BEGIN PUBLIC KEY-----\n";
        $publicKeyReal .= wordwrap($publicKey, 64, "\n", true);
        $publicKeyReal .= "\n-----END PUBLIC KEY-----";

        $keyRes = openssl_pkey_get_public($publicKeyReal);
        if ($keyRes === false) {
            throw new SeException('验签公钥无效。Err: ' . openssl_error_string());
        }

        return $keyRes;
    }


    /**
     * 获取签名私钥
     *
     * @return resource
     * @throws SeException
     */
    private function getSignKey()
    {
        $privateKey = SeConfig::getInstance()->getPrivateKey();
        if (!$privateKey) {
            throw new SeException('签名私钥不存在');
        }

        $privateKeyReal = "-----BEGIN RSA PRIVATE KEY-----\n";
        $privateKeyReal .= wordwrap($privateKey, 64, "\n", true);
        $privateKeyReal .= "\n-----END RSA PRIVATE KEY-----";

        $keyRes = openssl_pkey_get_private($privateKeyReal);
        if ($keyRes === false) {
            throw new SeException('签名私钥无效。Err: ' . openssl_error_string());
        }

        return $keyRes;
    }

    /**
     * Parses an HTTP message into an associative array.
     *
     * The array contains the "start-line" key containing the start line of
     * the message, "headers" key containing an associative array of header
     * array values, and a "body" key containing the body of the message.
     *
     * @param string $message HTTP request or response to parse.
     * @return array{ start-line: string,  headers: array, body: string }
     */
    protected function parseMessage(string $message): array
    {
        if (!$message) {
            throw new \InvalidArgumentException('Invalid message');
        }

        $message = ltrim($message, "\r\n");

        $messageParts = preg_split("/\r?\n\r?\n/", $message, 2);

        if ($messageParts === false || count($messageParts) !== 2) {
            throw new \InvalidArgumentException('Invalid message: Missing header delimiter');
        }

        [$rawHeaders, $body] = $messageParts;
        $rawHeaders .= "\r\n"; // Put back the delimiter we split previously
        $headerParts = preg_split("/\r?\n/", $rawHeaders, 2);

        if ($headerParts === false || count($headerParts) !== 2) {
            throw new \InvalidArgumentException('Invalid message: Missing status line');
        }

        [$startLine, $rawHeaders] = $headerParts;

        if (preg_match("/(?:^HTTP\/|^[A-Z]+ \S+ HTTP\/)(\d+(?:\.\d+)?)/i", $startLine, $matches) && $matches[1] === '1.0') {
            // Header folding is deprecated for HTTP/1.1, but allowed in HTTP/1.0
            $rawHeaders = preg_replace(Rfc7230::HEADER_FOLD_REGEX, ' ', $rawHeaders);
        }

        /** @var array[] $headerLines */
        $count = preg_match_all(Rfc7230::HEADER_REGEX, $rawHeaders, $headerLines, PREG_SET_ORDER);

        // If these aren't the same, then one line didn't match and there's an invalid header.
        if ($count !== substr_count($rawHeaders, "\n")) {
            // Folding is deprecated, see https://tools.ietf.org/html/rfc7230#section-3.2.4
            if (preg_match(Rfc7230::HEADER_FOLD_REGEX, $rawHeaders)) {
                throw new \InvalidArgumentException('Invalid header syntax: Obsolete line folding');
            }

            throw new \InvalidArgumentException('Invalid header syntax');
        }

        $headers = [];

        foreach ($headerLines as $headerLine) {
            $headers[$headerLine[1]][] = $headerLine[2];
        }

        return [
            'start-line' => $startLine,
            'headers' => $headers,
            'body' => $body,
        ];
    }

}