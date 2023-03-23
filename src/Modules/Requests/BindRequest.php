<?php

namespace Shitutech\Shareable\Modules\Requests;

use Shitutech\Shareable\Modules\Base\BaseRequest;

class BindRequest extends BaseRequest
{
    /**
     * @var string 收单商户号
     */
    protected $mchId = '';

    /**
     * @var string 分账接收方信息 JsonStr, "{\"receiverType\":\"B\",\"receiverId\":\"880100552\"}"
     */
    protected $receiver = '';

    public function getApiPath(): string
    {
        return '/api/sharing/receiver/bind';
    }

    /**
     * @return string
     */
    public function getMchId(): string
    {
        return $this->mchId;
    }

    /**
     * @param string $mchId
     * @return BindRequest
     */
    public function setMchId(string $mchId): BindRequest
    {
        $this->mchId = trim($mchId);
        return $this;
    }

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @param string $receiver
     * @return BindRequest
     */
    public function setReceiver(string $receiver): BindRequest
    {
        $this->receiver = trim($receiver);
        return $this;
    }

}