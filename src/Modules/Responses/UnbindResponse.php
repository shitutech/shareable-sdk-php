<?php

namespace Shitutech\Shareable\Modules\Responses;

use Shitutech\Shareable\Modules\Base\BaseResponse;

class UnbindResponse extends BaseResponse
{
    /**
     * @var string 收单商户号
     */
    protected $mchId = '';

    /**
     * @var string 分账接收方信息
     */
    protected $receiver = '';

    /**
     * @return string
     */
    public function getMchId(): string
    {
        return $this->mchId;
    }

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @return array{ receiverId: string, receiverType: string }
     */
    public function getReceiverList(): array
    {
        $data = trim($this->receiver);
        if (empty($data)) {
            return [];
        }

        $decode = json_decode($data, true);
        if ($decode == null) {
            return [];
        }

        return $decode;
    }
}