<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\ResponsePayload;

readonly abstract class AbstractResponsePayload
{
    abstract public function toArray(): array;

    abstract public static function hydrate(array $data): self;
}
