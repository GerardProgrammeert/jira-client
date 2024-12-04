<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\ResponsePayload;

final readonly class PostIssueResponsePayload extends AbstractResponsePayload
{
    public function __construct(
        private string $id,
        private string $key,
        private string $self,
    )
    {
    }

    public static function hydrate(array $data): self
    {
        return new static(...$data);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}