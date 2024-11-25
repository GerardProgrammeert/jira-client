<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use Beezmaster\JiraClient\Middleware\ResponseLoggingMiddleware;
use GuzzleHttp\Client;
use Beezmaster\JiraClient\AbstractJiraClient;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Str;
use Storage;
use GuzzleHttp\Psr7\Request;

class JiraClientFactory {

    public static function create(): JiraClient
    {
        $client = new Client(self::settings());

        return new JiraClient($client);
    }

    private static function settings(): array
    {
        return [
            'auth' => [config('jira.user_name'), config('jira.api_key')],
            'base_uri' => config('jira.base_api_url'),
            'handler' => self::getStack(),
        ];
    }

    private static function getStack(): HandlerStack
    {
        $stack = HandlerStack::create();

        //setHandler
        $handler = app()->environment() === 'testing' ? new FakeHandler() : new CurlHandler();
        $stack->setHandler($handler);

        //logging
        if (config('jira.log_request')) {
            $logRequestMiddleware = Middleware::mapRequest(function (Request $request) {
                $fileName = self::getRequestFileName($request);
                Storage::put('/jira-client/requests/' . $fileName, $request->getBody()->getContents());

                return $request;
            });
            $stack->push($logRequestMiddleware);
        }

        if (config('jira.log_response')) {
            $logResponseMiddleware = ResponseLoggingMiddleware::logResponse();
            $stack->push($logRequestMiddleware);
        }

        return $stack;
    }

    private static function getRequestFileName(Request $request): string
    {
        $parts = [];
        $parts['method'] = $request->getMethod();
        $parts['endpoint'] = Str::of($request->getUri(), '/rest/api/3/')->replace('/','_');
        $parts['suffix'] = time();
        $fileName = Str::studly(Str::lower(implode('_',$parts))) . '.json';

        return $fileName;
    }
}
