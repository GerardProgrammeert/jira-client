<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Exceptions\JiraClientBadRequest;
use Beezmaster\JiraClient\Exceptions\JiraClientServerException;
use Psr\Http\Message\ResponseInterface;

class Response
{
    public function __construct(private readonly ResponseInterface $response)
    {
        $this->handleStatus();
    }

    public function getResponsePayload(): void
    {
        //todo create payload with a Factory for a Response payload
    }

    public function getBody()
    {
        return $this->response->getBody();
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }

    public function getHeaders()
    {
        return $this->response->getHeaders();
    }

    public function toArray(): array
    {
        $body = (string) $this->response->getBody();

        return json_decode($body, true) ?? [];
    }

    private function handleStatus(): void
    {
        if (!config('jira.raise_exception')) {
            return;
        }

        $statusCode = $this->getStatusCode();

        match (true) {
            $statusCode >= 400 && $statusCode <= 499 => throw new JiraClientBadRequest($this->response),
            $statusCode >= 500 && $statusCode <= 599 => throw new JiraClientServerException(),
        };
    }
}
