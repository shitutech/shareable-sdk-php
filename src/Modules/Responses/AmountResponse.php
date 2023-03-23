<?php

namespace Shitutech\Shareable\Modules\Responses;

use Shitutech\Shareable\Modules\Base\BaseResponse;

class AmountResponse extends BaseResponse
{
    /**
     * @var string 收单商户号
     */
    protected $mchId = '';

    /**
     * @var string 上游交易订单号
     */
    protected $transactionId = '';

    /**
     * @var int 订单剩余待分金额，单位分
     */
    protected $sharableAmount = 0;

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
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @return int
     */
    public function getSharableAmount(): int
    {
        return $this->sharableAmount;
    }

}