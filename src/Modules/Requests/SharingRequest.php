<?php

namespace Shitutech\Shareable\Modules\Requests;

use Shitutech\Shareable\Modules\Base\BaseRequest;

class SharingRequest extends BaseRequest
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
     * @var int 分账接收方列表分账金额之和，单位分， 例如：100
     */
    protected $totalAmount = 0;

    /**
     * @var string 分账接收方，分账接收方信息，json格式的字符串，最多5个接收方配置
     */
    protected $receivers = '';

    public function getApiPath(): string
    {
        return '/api/sharing';
    }

    /**
     * @param string $mchId
     * @return SharingRequest
     */
    public function setMchId(string $mchId): SharingRequest
    {
        $this->mchId = trim($mchId);
        return $this;
    }

    /**
     * @param string $mchSharingNo
     * @return SharingRequest
     */
    public function setMchSharingNo(string $mchSharingNo): SharingRequest
    {
        $this->mchSharingNo = trim($mchSharingNo);
        return $this;
    }

    /**
     * @param string $transactionId
     * @return SharingRequest
     */
    public function setTransactionId(string $transactionId): SharingRequest
    {
        $this->transactionId = trim($transactionId);
        return $this;
    }

    /**
     * @param int $totalAmount
     * @return SharingRequest
     */
    public function setTotalAmount(int $totalAmount): SharingRequest
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @param string $receivers "[{\"amount\":1,\"description\":\"test1\",\"receiverId\":\"5578578\",\"receiverType\":\"B\"}]"
     * @return SharingRequest
     */
    public function setReceivers(string $receivers): SharingRequest
    {
        $this->receivers = trim($receivers);
        return $this;
    }

}