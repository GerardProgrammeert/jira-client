<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Exceptions\JiraClientBadRequest;
use Beezmaster\JiraClient\Exceptions\JiraClientServerException;
use Beezmaster\JiraClient\ResponsePayload\AbstractResponsePayload;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Beezmaster\JiraClient\ResponsePayload\ResponsePayloadFactory;
class Response
{
    public function __construct(
        private readonly Request $request,
        private readonly ResponseInterface $response,
    )
    {
        $this->handleStatus();
    }

    public function getResponsePayload(): AbstractResponsePayload
    {
        return ResponsePayloadFactory::create($this->request, $this->response);
    }

    public function getBody(): StreamInterface
    {
        return $this->response->getBody();
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        return $this->withStatus($code, $reasonPhrase);
    }

    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }

    public function getHeaders(): array
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
        if (!config('jira.raise_exception'))
        {
            return; 
        }
        
        $statusCode = $this->getStatusCode();

        match (true) {
            $statusCode >= 400 && $statusCode <= 499 => throw new JiraClientBadRequest($this->getBody()->getContents()),
            $statusCode >= 500 && $statusCode <= 599 => throw new JiraClientServerException(),
        };

        return;
    }
}
