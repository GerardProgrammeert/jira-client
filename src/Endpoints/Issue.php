<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\Endpoints;

use Beezmaster\JiraClient\AbstractJiraClient;
use Beezmaster\JiraClient\Enums\HttpMethod;
use Beezmaster\JiraClient\Payload\IssuePayload;
use Beezmaster\JiraClient\Request;
use Beezmaster\JiraClient\RequestPayload\IssueRequestPayload;
use GuzzleHttp\Psr7\Response;

final class Issue extends BaseEndpoint
{
    const BASE_ENDPOINT = '/issue';

    public function all(): Response
    {
        return $this->client->makeRequest(HttpMethod::GET, self::BASE_ENDPOINT . '/');
        return $this->client->makeRequest((new Request('GET', $url)));
    }

    public function get(array $pathVariables): Response
    {
        $url = self::BASE_ENDPOINT . '/%s';

        //return $this->client->makeRequest(HttpMethod::GET, $url);
        return $this->client->makeRequest((new Request('GET', $url, $payload ,$pathVariables, $query)));
    }

    public function post(IssueRequestPayload $payload): AbstractResponsePayload
    {
        return $this->client->makeRequest(
            (new Request(HttpMethod::POST, self::BASE_ENDPOINT, null, $payload))
        );
    }
}
