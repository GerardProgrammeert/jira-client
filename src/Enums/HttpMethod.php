<?php

namespace Beezmaster\JiraClient\Enums;

enum HttpMethod: string
{
    case GET = 'GET';
    case PUT = 'PUT';
    case POST = 'POST';
    case DELETE = 'DELETE';
    case OPTIONS = 'OPTIONS';
    case PATCH = 'PATCH';
}
