<?php

namespace Shitutech\Shareable;

use Shitutech\Shareable\Exceptions\SeException;
use Shitutech\Shareable\Modules\Base\BaseResponse;

final class SeClientResponse
{
    /**
     * @var BaseResponse|null
     */
    protected $response = null;

    /**
     * @var string
     */
    protected $respData = '';

    /**
     * @param BaseResponse $response
     * @param string $respJsonData
     */
    public function __construct(BaseResponse $response, string $respJsonData)
    {
        $this->response = $response;
        $this->respData = $respJsonData;
    }

    /**
     * @return BaseResponse
     * @throws SeException
     */
    public function fetchResult(): BaseResponse
    {
        $respData = trim($this->respData);
        if (empty($respData)) {
            throw new SeException("响应数据为空");
        }

        $decodeData = json_decode($respData, true);
        if (!is_array($decodeData)) {
            throw new SeException("响应数据 JSON 解码失败");
        }

        if (!isset($decodeData['code'])) {
            throw new SeException("响应数据缺少状态码字段 code");
        }

        if ($decodeData['code'] != '200') {
            throw new SeException("响应报告发生异常。Err: {$decodeData['code']}::{$decodeData['msg']}");
        }

        if (!isset($decodeData['data'])) {
            throw new SeException("响应数据缺少业务数据字段 data");
        }

        if (!is_array($decodeData['data']) || !$decodeData['data']) {
            throw new SeException("业务数据无效");
        }

        $resultData = $decodeData['data'];

        $this->response->setProperty($resultData);

        return $this->response;
    }

    public function toArray(): array
    {
        return $this->response->toArray();
    }

    public function toJson()
    {
        return $this->response->toJSON();
    }

}