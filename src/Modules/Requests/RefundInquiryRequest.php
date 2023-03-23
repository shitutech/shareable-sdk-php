<?php

namespace Shitutech\Shareable\Modules\Requests;

use Shitutech\Shareable\Modules\Base\BaseRequest;

class RefundInquiryRequest extends BaseRequest
{
    /**
     * @var string 收单商户号
     */
    protected $mchId = '';

    /**
     * @var string 商户回退单号
     */
    protected $mchReturnNo = '';

    public function getApiPath(): string
    {
        return '/api/sharing/refund/inquiry';
    }

    /**
     * @param string $mchId
     * @return RefundInquiryRequest
     */
    public function setMchId(string $mchId): RefundInquiryRequest
    {
        $this->mchId = trim($mchId);
        return $this;
    }

    /**
     * @param string $mchReturnNo
     * @return RefundInquiryRequest
     */
    public function setMchReturnNo(string $mchReturnNo): RefundInquiryRequest
    {
        $this->mchReturnNo = trim($mchReturnNo);
        return $this;
    }

}