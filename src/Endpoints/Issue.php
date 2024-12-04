<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\Endpoints;

use Beezmaster\JiraClient\AbstractJiraClient;
use Beezmaster\JiraClient\Enums\HttpMethod;
use Beezmaster\JiraClient\Payload\IssuePayload;
use Beezmaster\JiraClient\Request;
use Beezmaster\JiraClient\RequestPayload\IssueRequestPayload;
use Beezmaster\JiraClient\Response;

final class Issue extends BaseEndpoint
{
    const string BASE_ENDPOINT = '/issue';

    public function all(): Response
    {
        return $this->client->makeRequest(HttpMethod::GET, self::BASE_ENDPOINT . '/');
    }

    public function get(array $routeParams): Response
    {
        $url = self::BASE_ENDPOINT . '/%s';

        return $this->client->makeRequest(
            (new Request(HttpMethod::GET, $url, $payload, $routeParams, $query))
        );
    }

    public function post(IssueRequestPayload $payload): Response
    {
        return $this->client->makeRequest(
            (new Request(HttpMethod::POST, self::BASE_ENDPOINT, null, $payload))
        );
    }
}
