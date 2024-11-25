<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\AbstractJiraClient;
use GuzzleHttp\Psr7\Response;

class JiraFakeClient extends AbstractJiraClient
{

    public function makeRequest(): Response
    {
        return new Response();
        // TODO: Implement makeRequest() method.
    }
}
