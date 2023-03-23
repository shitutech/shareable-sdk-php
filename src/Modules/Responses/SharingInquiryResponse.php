<?php

namespace Shitutech\Shareable\Modules\Responses;

use Shitutech\Shareable\Modules\Base\BaseResponse;

class SharingInquiryResponse extends BaseResponse
{
    /**
     * @var string 收单商户号
     */
    protected $mchId = '';

    /**
     * @var string 分账单号，分账方的分账订单号
     */
    protected $mchSharingNo = '';

    /**
     * @var string 上游交易订单号
     */
    protected $transactionId = '';

    /**
     * @var string 分账单号
     */
    protected $sharingNo = '';

    /**
     * @var string PROCESSING-处理中 FINISHED-处理完成
     */
    protected $status = '';

    /**
     * @var string 分账接收方, 分账接收方信息，参见SharingReceiver定义
     */
    protected $receivers = '';

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
    public function getMchSharingNo(): string
    {
        return $this->mchSharingNo;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @return string
     */
    public function getSharingNo(): string
    {
        return $this->sharingNo;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getReceivers(): string
    {
        return $this->receivers;
    }

    /**
     * @return array{
     *     receiverId: string,
     *     receiverType: string,
     *     amount: int,
     *     description: string,
     *     sharingStatus: string,
     *     finishTime: string,
     *     failReason: string|null
     * }
     */
    public function getReceiversList(): array
    {
        $data = trim($this->receivers);
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