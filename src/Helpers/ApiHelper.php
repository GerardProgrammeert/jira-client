<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\Helpers;

use Str;
use Beezmaster\JiraClient\Request;

class ApiHelper {

    public static function getEndpoint(Request $request): string
    {
        $parts = [];
        $parts['method'] = $request->getMethod();
        $parts['endpoint'] = Str::of($request->getUrl())->after( '/rest/api/3')->replace('/','_');

        return Str::studly(Str::lower(implode('_',$parts)));
    }
}
