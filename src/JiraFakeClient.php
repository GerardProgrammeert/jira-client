<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use GuzzleHttp\Psr7\Response;

class JiraFakeClient extends AbstractJiraClient
{
    public function makeRequest(): Response
    {
        return new Response();
        // TODO: Implement makeRequest() method.
    }
}
