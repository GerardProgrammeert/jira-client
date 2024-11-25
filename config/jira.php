<?php

return [
    'base_api_url' => env('JIRA_BASE_API_URL', null),
    'user_name' => env('JIRA_USER_NAME', null),
    'api_key' => env('JIRA_API_KEY', null),
    'log_request' => env('JIRA_LOG_REQUEST', false),
    'log_response' => env('JIRA_LOG_RESPONSE', false),
    'debug' => env('JIRA_DEBUG', false),
    'raise_exceptoin' => env('JIRA_RAISE_EXCEPTION', true), //throws exception base on status code
];