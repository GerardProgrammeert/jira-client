<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\Middleware;

use GuzzleHttp\Middleware;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\RequestOptions;
use Str;

class ResponseLoggingMiddleware {

    public static function logResponse(): callable
    {
        return Middleware::tap(
            null,
            function (RequestInterface $request, mixed $options, $promise) {
                $promise->then(function(ResponseInterface $respond) use ($request) {
                   $result = \Storage::put(
                        '/jira-client/responses/' . self::getResponseFileName($request),
                         $respond->getBody()->getContents()
                    );
                   logger($result);
                });
            }
        );
    }

    private static function getResponseFileName(RequestInterface $request): string
    {
        $fileNameParts = [];
        $fileNameParts['method'] = $request->getMethod();
        $fileNameParts['endpoint'] = Str::of($request->getUri())
            ->after('/rest/api/3/')
            ->trim('/')
            ->replace('/','_');
        //@todo use Fluent str helper
        return Str::studly(Str::lower(implode('_', $fileNameParts))) . time() . '.json';
    }
}

