<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\RequestPayload;

interface RequestPayloadInterface
{
    public static function hydrate(array $data): self;

    public function toArray(): array;
}
