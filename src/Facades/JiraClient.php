<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\Facades;

use Beezmaster\JiraClient\JiraClient as Client;
use Illuminate\Support\Facades\Facade;

class JiraClient extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return Client::class; //todo
    }
}
