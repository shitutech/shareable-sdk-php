<?php

namespace Shitutech\Shareable\Modules\Requests;

use Shitutech\Shareable\Modules\Base\BaseRequest;

class SharingInquiryRequest extends BaseRequest
{
    /**
     * @var string 收单商户号
     */
    protected $mchId = '';

    /**
     * @var string 分账单号，分账方的分账订单号
     */
    protected $mchSharingNo = '';

    public function getApiPath(): string
    {
        return '/api/sharing/inquiry';
    }

    /**
     * @param string $mchId
     * @return SharingInquiryRequest
     */
    public function setMchId(string $mchId): SharingInquiryRequest
    {
        $this->mchId = trim($mchId);
        return $this;
    }

    /**
     * @param string $mchSharingNo
     * @return SharingInquiryRequest
     */
    public function setMchSharingNo(string $mchSharingNo): SharingInquiryRequest
    {
        $this->mchSharingNo = trim($mchSharingNo);
        return $this;
    }

}