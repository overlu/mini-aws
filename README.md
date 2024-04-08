## AWS Service Provider for Mini3

基于 [AWS SDK for PHP](https://github.com/aws/aws-sdk-php) 完成的Mini扩展

### 安装

use composer

```sh
composer require overlu/mini-aws
```

#### 注册服务

打开 `config/app.php` 并注册Aws服务.

```php
'providers' => [
    // ...
    MiniAws\AwsServiceProvider::class,
]
```

#### 配置

发布配置文件

```sh
php bin/artisan vendor:publish  --provider="MiniAws\AwsServiceProvider"
```

这些设置可以在生成的`config/aws.php`配置文件中找到。

```php
return [
    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID', ''),
        'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
    ],
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    'version' => 'latest',
    // 您可以覆盖特定服务的设置
    'Ec2' => [
        'region' => 'us-east-1',
    ],
];
```

默认情况下，`credentials`和`region`设置将从您的`.env`的文件。

```
AWS_ACCESS_KEY_ID=xxx
AWS_SECRET_ACCESS_KEY=xxx
AWS_DEFAULT_REGION=xxx
```

更多配置参考 [configuring the SDK](http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html)

### 使用

使用Amazon S3客户端上传文件

```php
$s3 = app('aws')->createClient('s3');
$s3->putObject([
    'Bucket'     => 'YOUR_BUCKET',
    'Key'        => 'YOUR_OBJECT_KEY',
    'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext',
]);
```

```php
$s3 = \MiniAws\Facades\Aws::createClient('s3');
$s3->putObject([
    'Bucket'     => 'YOUR_BUCKET',
    'Key'        => 'YOUR_OBJECT_KEY',
    'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext',
]);
```

```php
$s3 = \MiniAws\Facades\Aws::createS3();
$s3->putObject([
    'Bucket'     => 'YOUR_BUCKET',
    'Key'        => 'YOUR_OBJECT_KEY',
    'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext',
]);
```