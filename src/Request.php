<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Enums\HttpMethod;
use Beezmaster\JiraClient\Payload\AbstractPayload;
use Beezmaster\JiraClient\RequestPayload\AbstractRequestPayload;
use GuzzleHttp\RequestOptions;

//@todo extend with PSR RequestInterfdace
final class Request
{
    public function __construct(
        private HttpMethod $method,
        private string $endpoint,
        private $path = [],
        private ?AbstractRequestPayload $payload = null)
    {
    }

    public function getUrl(): string
    {
        $endpoint = '/rest/api/3' . $this->endpoint;
        if (empty($this->path))
        {
            return $endpoint;
        }

        return sprintf($endpoint, ...$this->path);
    }

    public function getMethod(): string
    {
        return $this->method->value;
    }

    private function getHeaders(array $headers = []): array
    {
        $defaultHeaders = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        return array_merge($defaultHeaders, $headers);
    }

    public function getOptions(array $headers = []): array
    {
        $array = [
            RequestOptions::HEADERS => $this->getHeaders($headers),
            RequestOptions::JSON => $this->payload->toArray(),
            RequestOptions::DEBUG => config('jira.debug'),
        ];

        return $array;
    }
}
