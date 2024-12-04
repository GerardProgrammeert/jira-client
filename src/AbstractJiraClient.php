<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Endpoints\Issue;
use Beezmaster\JiraClient\Endpoints\Project;

abstract class AbstractJiraClient
{
    // protected function getOptions(): array
    // {
    //     return [
    //         'Headers' => [
    //             [
    //                 'Accept' => 'application/json',
    //             ]
    //         ]
    //     ];
    // }

    //abstract public function makeRequest(Request $request);

    public function issue(): Issue
    {
        return new Issue($this);
    }

    public function project(): Project
    {
        return new Project($this);
    }
}
