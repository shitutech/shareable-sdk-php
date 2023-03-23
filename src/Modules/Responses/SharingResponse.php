<?php

namespace Shitutech\Shareable\Modules\Responses;

use Shitutech\Shareable\Modules\Base\BaseResponse;

class SharingResponse extends BaseResponse
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

}