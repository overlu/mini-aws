<?php
/**
 * This file is part of Mini.
 * @auth lupeng
 */
declare(strict_types=1);

namespace MiniAws;

use Aws\Sdk;
use Mini\Contracts\Container\BindingResolutionException;
use Mini\Service\AbstractServiceProvider;

class AwsServiceProvider extends AbstractServiceProvider
{
    /**
     * @return void
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/aws.php',
            'aws'
        );

        // create image
        $this->app->singleton(Sdk::class, function ($app) {
            return new Sdk(config('aws', []));
        });

        $this->app->alias(Sdk::class, 'aws');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/aws.php' => config_path('aws.php')
        ]);
    }
}