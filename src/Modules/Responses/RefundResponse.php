<?php

namespace Shitutech\Shareable\Modules\Responses;

use Shitutech\Shareable\Modules\Base\BaseResponse;

class RefundResponse extends BaseResponse
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

}