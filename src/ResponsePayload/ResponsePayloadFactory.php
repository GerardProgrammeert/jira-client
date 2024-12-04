<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\ResponsePayload;

use Beezmaster\JiraClient\Helpers\ApiHelper;
use Beezmaster\JiraClient\Request;
use RuntimeException;

class ResponsePayloadFactory
{
    public static function create(Request $request, $response)
    {
        $namespace = 'Beezmaster\\JiraClient\\ResponsePayload\\';
        $className = 'ResponsePayload';
        $endpoint = ApiHelper::getEndpoint($request);
        $FQC = $namespace . $endpoint . $className;

        if (class_exists($FQC) && method_exists($FQC, 'hydrate')) {
            return $FQC::hydrate(self::json_decode($response->getBody()->getContents()));
        }

        throw new RuntimeException('Class ' . $FQC . ' not found');
    }

    /*@todo find oud why getContent returns a single quoted string*/
    private static function json_decode(string $content): array
    {
        $validJson = str_replace("'", '"', $content);

        return json_decode($validJson, true);
    }
}
