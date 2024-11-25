<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient;

use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class FakeHandler
{
    public function __invoke(RequestInterface $request): PromiseInterface
    {
        $json = "{'id':'10063','key':'SCRUM-64','self':'https://gwjvanhattem.atlassian.net/rest/api/3/issue/10063'}";

        return new FulfilledPromise(
            new Response(200, [], $json)
        );
    }
}
