<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\Endpoints;

use Beezmaster\JiraClient\Enums\HttpMethod;
use Beezmaster\JiraClient\Payload\IssuePayload;
use Beezmaster\JiraClient\Request;
use Beezmaster\JiraClient\RequestPayload\IssueRequestPayload;
use Beezmaster\JiraClient\ResponsePayload\AbstractResponsePayload;
use GuzzleHttp\Psr7\Response;
use Beezmaster\JiraClient\Response as JiraResponse;

final class Issue extends BaseEndpoint
{
    public const BASE_ENDPOINT = '/issue';

    public function all(): JiraResponse
    {
        return $this->client->makeRequest(HttpMethod::GET, self::BASE_ENDPOINT . '/');
    }

    public function get(array $pathVariables): JiraResponse
    {
        $url = self::BASE_ENDPOINT . '/%s';

        //return $this->client->makeRequest(HttpMethod::GET, $url);
        return $this->client->makeRequest((new Request('GET', $url, $payload, $pathVariables, $query)));
    }

    public function post(IssueRequestPayload $payload): JiraResponse
    {
        return $this->client->makeRequest(
            (new Request(HttpMethod::POST, self::BASE_ENDPOINT, null, $payload))
        );
    }
}
