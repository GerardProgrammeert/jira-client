<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Endpoints\Issue;
use Beezmaster\JiraClient\Endpoints\Project;
use Beezmaster\JiraClient\Enums\HttpMethod;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractJiraClient
{
    // protected function getOptions(): array
    // {
    //     return [
    //         'Headers' => [
    //             [
    //                 'Accept' => 'application/json',
    //             ]
    //         ]
    //     ];
    // }

    //abstract public function makeRequest(Request $request);

    public function issue(): Issue
    {
        return new Issue($this);
    }

    public function project(): Project
    {
        return new Project($this);
    }
}
