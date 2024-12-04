<?php

declare(strict_types=1);

namespace BeezMaster\JiraClient\Endpoints;

use Beezmaster\JiraClient\AbstractJiraClient;

class BaseEndpoint {
    public function __construct(protected readonly AbstractJiraClient $client)
    {
    }
}
