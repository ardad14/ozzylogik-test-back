<?php

namespace App\Providers;

use App\Services\Elasticsearch\ElasticsearchService;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ElasticsearchService::class, function () {
            return new ElasticsearchService(
                $this->app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }

    private function bindSearchClient(): void
    {
        $this->app->bind(Client::class, function ($app) {
            $client =  ClientBuilder::create()
                ->setHosts($app['config']->get('elasticsearch.config.hosts'))
                ->build();

            $response = $client->info();

            return $client;
        });
    }
}
