<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Endpoints\Issue;
use Beezmaster\JiraClient\Endpoints\Project;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class JiraClient extends AbstractJiraClient
{
    public function __construct(private readonly Client $client)
    {
    }

    public function makeRequest(Request $request): ResponseInterface
    {
        $response = $this->client->request($request->getMethod(), $request->getUrl(), $request->getOptions());

        return new Response($response);
    }

    public function issue(): Issue
    {
        return new Issue($this);
    }

    public function project(): Project
    {
        return new Project($this);
    }
}
