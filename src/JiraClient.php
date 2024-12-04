<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Endpoints\BaseEndpoint;
use Beezmaster\JiraClient\Endpoints\Issue;
use Beezmaster\JiraClient\Endpoints\Project;
use Beezmaster\JiraClient\Enums\HttpMethod;
use Beezmaster\JiraClient\Exceptions\JiraClientBadRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Beezmaster\JiraClient\AbstractJiraClient;
use Beezmaster\JiraClient\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JiraClient extends AbstractJiraClient
{

    public function __construct(private readonly Client $client)
    {
    }

    public function makeRequest(Request $request)
    {
        $response = $this->client->request($request->getMethod(), $request->getUrl(), $request->getOptions());

        return new Response($request, $response);
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
