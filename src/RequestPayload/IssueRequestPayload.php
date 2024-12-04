<?php

declare(strict_types=1);

namespace Beezmaster\JiraClient\RequestPayload;

use Beezmaster\JiraClient\Enums\IssueType;

final class IssueRequestPayload extends AbstractRequestPayload
{
    public function __construct(
        private readonly string $summary,
        private readonly string $description,
        private readonly string $project,
        private readonly issueType $issueType,
    ) {
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function toArray(): array
    {
        return [
            'fields' => [
                'project'     => [
                    'key' => $this->project,
                ],
                'summary'     => $this->summary,
                'issuetype'   => ['name' => $this->issueType->value],
                'description' => [
                    'type'    => 'doc',
                    'version' => 1,
                    'content' => [
                        [
                            'type'    => 'paragraph',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => $this->description,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param array<string, string | IssueType>
     */
    public static function hydrate(array $data): AbstractRequestPayload
    {
        return new static(...$data);
    }
}
