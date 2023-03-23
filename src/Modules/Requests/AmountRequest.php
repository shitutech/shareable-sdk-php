<?php

namespace Shitutech\Shareable\Modules\Requests;

use Shitutech\Shareable\Modules\Base\BaseRequest;

class AmountRequest extends BaseRequest
{
    protected $mchId = '';
    protected $transactionId = '';

    public function getApiPath(): string
    {
        return '/api/sharing/sharable-amount/inquiry';
    }

    /**
     * @param string $mchId
     * @return AmountRequest
     */
    public function setMchId(string $mchId): AmountRequest
    {
        $this->mchId = trim($mchId);
        return $this;
    }

    /**
     * @param string $transactionId
     * @return AmountRequest
     */
    public function setTransactionId(string $transactionId): AmountRequest
    {
        $this->transactionId = trim($transactionId);
        return $this;
    }
}