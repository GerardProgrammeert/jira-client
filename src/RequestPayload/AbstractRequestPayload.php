<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\RequestPayload;

abstract class AbstractRequestPayload implements RequestPayloadInterface
{
    abstract public function toArray(): array;

    abstract public static function hydrate(array $data): self;
}
