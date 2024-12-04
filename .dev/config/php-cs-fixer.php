<?php

$config = new PhpCsFixer\Config();
$rules = [
    '@PSR12' => true,
    'single_line_empty_body' => false,
];

return $config->setRules($rules)->setLineEnding("\n");
