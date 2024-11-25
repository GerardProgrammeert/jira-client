<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\RequestPayload;

Interface RequestPayloadInterface {
    public static function hydrate(array $data): self; 
    public function toArray(): array;
}
