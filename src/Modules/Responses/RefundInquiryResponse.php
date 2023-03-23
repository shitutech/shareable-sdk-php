<?php

namespace Shitutech\Shareable\Modules\Responses;

use Shitutech\Shareable\Modules\Base\BaseResponse;

class RefundInquiryResponse extends BaseResponse
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
     * @var string 商户回退单号
     */
    protected $mchReturnNo = '';

    /**
     * @var string 上游回退单号
     */
    protected $returnNo = '';

    /**
     * @var string 回退状态SUCCESS-成功， FAIL-失败， ING-处理中
     */
    protected $returnStatus = '';

    /**
     * @var string 回退方标识
     */
    protected $returnReceiverId = '';

    /**
     * @var string 回退方类型
     */
    protected $returnReceiverType = '';

    /**
     * @var int 回退金额，单位为分
     */
    protected $returnAmount = 0;

    /**
     * @var string 回退完成时间
     */
    protected $finishTime = '';

    /**
     * @var string 回退失败原因，仅在失败时有值
     */
    protected $failReason = '';

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
    public function getMchReturnNo(): string
    {
        return $this->mchReturnNo;
    }

    /**
     * @return string
     */
    public function getReturnNo(): string
    {
        return $this->returnNo;
    }

    /**
     * @return string
     */
    public function getReturnStatus(): string
    {
        return $this->returnStatus;
    }

    /**
     * @return string
     */
    public function getReturnReceiverId(): string
    {
        return $this->returnReceiverId;
    }

    /**
     * @return string
     */
    public function getReturnReceiverType(): string
    {
        return $this->returnReceiverType;
    }

    /**
     * @return int
     */
    public function getReturnAmount(): int
    {
        return $this->returnAmount;
    }

    /**
     * @return string
     */
    public function getFinishTime(): string
    {
        return $this->finishTime;
    }

    /**
     * @return string
     */
    public function getFailReason(): string
    {
        return $this->failReason;
    }

}