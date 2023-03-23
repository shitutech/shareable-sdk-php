<?php

namespace Shitutech\Shareable\Modules\Requests;

use Shitutech\Shareable\Modules\Base\BaseRequest;

class RefundRequest extends BaseRequest
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
     * @var string 回退方标识，需与对应分账订单查询结果一致
     */
    protected $returnReceiverId = '';

    /**
     * @var string 回退方类型，需与对应分账订单查询结果一致
     */
    protected $returnReceiverType = '';

    /**
     * @var string 回退描述
     */
    protected $returnDescription = '';

    /**
     * @var int 回退金额，单位为分
     */
    protected $returnAmount = 0;

    public function getApiPath(): string
    {
        return '/api/sharing/refund';
    }

    /**
     * @param string $mchId
     * @return RefundRequest
     */
    public function setMchId(string $mchId): RefundRequest
    {
        $this->mchId = trim($mchId);
        return $this;
    }

    /**
     * @param string $mchSharingNo
     * @return RefundRequest
     */
    public function setMchSharingNo(string $mchSharingNo): RefundRequest
    {
        $this->mchSharingNo = trim($mchSharingNo);
        return $this;
    }

    /**
     * @param string $mchReturnNo
     * @return RefundRequest
     */
    public function setMchReturnNo(string $mchReturnNo): RefundRequest
    {
        $this->mchReturnNo = trim($mchReturnNo);
        return $this;
    }

    /**
     * @param string $returnReceiverId
     * @return RefundRequest
     */
    public function setReturnReceiverId(string $returnReceiverId): RefundRequest
    {
        $this->returnReceiverId = trim($returnReceiverId);
        return $this;
    }

    /**
     * @param string $returnReceiverType
     * @return RefundRequest
     */
    public function setReturnReceiverType(string $returnReceiverType): RefundRequest
    {
        $this->returnReceiverType = trim($returnReceiverType);
        return $this;
    }

    /**
     * @param string $returnDescription
     * @return RefundRequest
     */
    public function setReturnDescription(string $returnDescription): RefundRequest
    {
        $this->returnDescription = trim($returnDescription);
        return $this;
    }

    /**
     * @param int $returnAmount
     * @return RefundRequest
     */
    public function setReturnAmount(int $returnAmount): RefundRequest
    {
        $this->returnAmount = $returnAmount;
        return $this;
    }

}