<?php

namespace Shitutech\Shareable\Modules\Requests;

use Shitutech\Shareable\Modules\Base\BaseRequest;

class UnbindRequest extends BaseRequest
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
        return '/api/sharing/receiver/unbind';
    }

    /**
     * @param string $mchId
     * @return UnbindRequest
     */
    public function setMchId(string $mchId): UnbindRequest
    {
        $this->mchId = trim($mchId);
        return $this;
    }

    /**
     * @param string $receiver
     * @return UnbindRequest
     */
    public function setReceiver(string $receiver): UnbindRequest
    {
        $this->receiver = trim($receiver);
        return $this;
    }

}