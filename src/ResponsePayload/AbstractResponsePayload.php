<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\ResponsePayload;

class AbstractResponsePayload
{
    abstract public function toArray(): array;
    abstract static function hydrate(array $data): self;
}
