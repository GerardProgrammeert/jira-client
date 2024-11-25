<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use BeezMaster\JiraClient\AbstractJiraClient;
use Beezmaster\JiraClient\JiraClient;
use BeezMaster\JiraClient\JiraClientFactory;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class JiraServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AbstractJiraClient::class, function ($app) {
            return JiraClientFactory::create();
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/jira.php' => config_path('jira.php'),
        ], 'jira-config');
    }
}
