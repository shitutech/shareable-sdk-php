# 介绍

分账 API PHP SDK

# 使用方法

## 配置仓库

在项目的 ``composer.json`` 内新增仓库配置

```json
{
  "minimum-stability": "stable",
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/shitutech/shareable-sdk-php.git"
    }
  ]
}
```

执行安装：

```shell
composer.phar require shitutech/shareable
```

## 使用

```php
use Shitutech\Shareable\Modules\Requests\BindRequest;
use Shitutech\Shareable\Modules\Responses\BindResponse;
use Shitutech\Shareable\SeClientRequest;
use Shitutech\Shareable\SeClientResponse;
use Shitutech\Shareable\SeConfig;


SeConfig::getInstance()->setAppId('*****')
    ->setPrivateKey('************')
    ->setPlatformPublicKey('************');

try {
    $objReq = (new BindRequest())->setMchId('*******')
        ->setReceiver(json_encode(['receiverId' => '********', 'receiverType' => 'B']));

    var_export($objReq->fetchBizData(false));
    echo PHP_EOL . PHP_EOL;

    $respData = (new SeClientRequest($objReq))->send();

    var_export($respData);
    echo PHP_EOL . PHP_EOL;

    $objResp = (new SeClientResponse(new BindResponse(), $respData))->fetchResult();

    /**
     * @var BindResponse $objResp
     */
    var_dump($objResp->getReceiverList());

} catch (\Throwable $e) {
    var_dump([
        'code' => $e->getCode(),
        'msg' => $e->getMessage(),
        'fLine' => $e->getFile() . ":" . $e->getLine(),
    ]);
}
```

# 接口

| API       | 请求类                          | 响应类                           |
|-----------|------------------------------|-------------------------------|
| 添加分账接收方   | BindRequest::class           | BindResponse::class           |
| 删除分账接收方   | UnbindRequest::class         | UnbindResponse::class         |
| 查询订单待分账金额 | AmountRequest::class         | AmountResponse::class         |
| 分账        | SharingRequest::class        | SharingResponse::class        |
| 分账查询      | SharingInquiryRequest::class | SharingInquiryResponse::class |
| 分账回退      | RefundRequest::class         | RefundResponse::class         |
| 分账回退查询    | RefundInquiryRequest::class  | RefundInquiryResponse::class  |