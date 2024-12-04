<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\Endpoints;

use Beezmaster\JiraClient\Enums\HttpMethod;
use GuzzleHttp\Psr7\Response;

final class Project extends BaseEndpoint
{
    public const BASE_ENDPOINT = '/project';

    public function all(): void
    {
        $this->makeRequest('GET', self::BASE_ENDPOINT);
    }

    public function get(string $id): Response
    {
        $url = sprintf(self::BASE_ENDPOINT . '/%s', $id);

        return $this->client->makeRequest(HttpMethod::GET, $url);
    }
}
