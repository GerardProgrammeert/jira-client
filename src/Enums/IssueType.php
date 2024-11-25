<?php

namespace Beezmaster\JiraClient\Enums;

enum IssueType: string
{
    case BUG = 'Bug';
    case TASK = 'Task';
    case STORY = 'Story';
}

