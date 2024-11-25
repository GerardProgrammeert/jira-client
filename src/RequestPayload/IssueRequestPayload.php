<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\RequestPayload;

use Beezmaster\JiraClient\Enums\IssueType;
use Beezmaster\JiraClient\RequestPayload\AbstractRequestPayload;

final class IssueRequestPayload extends AbstractRequestPayload
{
    public function __construct(
        private string $summary,
        private string $description,
        private string $project,
        private issueType $issueType,
    )
    {
    }

    /**
     *@return array<string, array<string, mixed>>
     */
    public function toArray(): array
    {
        return [
            'fields' => [
                'project' => [
                    'key' => $this->project,
                ],
                'summary' => $this->summary,
                'issuetype' => ['name' => $this->issueType->value],
                'description' => [
                    'type' => 'doc',
                    'version' => 1,
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => $this->description,
                                ]
                            ]
                        ]
                    ],
                ],
            ]
        ];
    }
    /**
     * @param array<string, string | IssueType>
     */
    static function hydrate(array $data): AbstractRequestPayload
    {
        return new static (...$data);
    }
}
