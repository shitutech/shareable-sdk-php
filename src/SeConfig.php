<?php

namespace Shitutech\Shareable;

final class SeConfig
{
    /**
     * @var string 接入方分配的appId
     */
    private $appId = "";

    /**
     * @var string 签名方式，固定值为RSA2, 签名算法为Sha256WithRSA
     */
    private $signType = "RSA2";

    /**
     * @var string 商户签名私钥，用于数据加密
     */
    private $privateKey = "";

    /**
     * @var string 平台公钥，用于响应验签
     */
    private $platformPublicKey = "";

    private function __construct()
    {
        //
    }

    private function __clone()
    {
        //
    }

    public static function getInstance(): SeConfig
    {
        static $objSelf = null;

        if ($objSelf === null) {
            $objSelf = new self();
        }

        return $objSelf;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     * @return SeConfig
     */
    public function setAppId(string $appId): SeConfig
    {
        $this->appId = trim($appId);
        return $this;
    }

    /**
     * @return string
     */
    public function getSignType(): string
    {
        return $this->signType;
    }

    /**
     * @param string $signType
     * @return SeConfig
     */
    public function setSignType(string $signType): SeConfig
    {
        $this->signType = trim($signType);
        return $this;
    }

    /**
     * @return string
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @param string $privateKey
     * @return SeConfig
     */
    public function setPrivateKey(string $privateKey): SeConfig
    {
        $this->privateKey = trim($privateKey);
        return $this;
    }

    /**
     * @return string
     */
    public function getPlatformPublicKey(): string
    {
        return $this->platformPublicKey;
    }

    /**
     * @param string $platformPublicKey
     * @return SeConfig
     */
    public function setPlatformPublicKey(string $platformPublicKey): SeConfig
    {
        $this->platformPublicKey = trim($platformPublicKey);
        return $this;
    }

}