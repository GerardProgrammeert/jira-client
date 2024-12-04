<?php

declare(strict_types=1);

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Config\RectorConfig;
use Rector\EarlyReturn\Rector\Foreach_\ChangeNestedForeachIfsToEarlyContinueRector;
use Rector\EarlyReturn\Rector\If_\ChangeIfElseValueAssignToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\EarlyReturn\Rector\Return_\PreparedValueToEarlyReturnRector;
use Rector\EarlyReturn\Rector\StmtsAwareInterface\ReturnEarlyIfVariableRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\ValueObject\PhpVersion;

$root = dirname(__DIR__, 2);
$paths = [
    $root . '/src',
];

$ignoreRules = [
    // Change closure to arrow function
    ClosureToArrowFunctionRector::class, //https://wiki.php.net/rfc/arrow_functions_v2
    // Change mixed docs type to mixed typed
    MixedTypeRector::class,
];
$extraRules = [
    // https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#earlyreturn
    ChangeIfElseValueAssignToEarlyReturnRector::class,
    ChangeNestedForeachIfsToEarlyContinueRector::class,
    PreparedValueToEarlyReturnRector::class,
    RemoveAlwaysElseRector::class,
    ReturnEarlyIfVariableRector::class,
];

return RectorConfig::configure()
    ->withPaths($paths)
    ->withPhpSets(php81: true)
    ->withPreparedSets(deadCode: true, privatization: true)
    ->withRules($extraRules)
    ->withSkip($ignoreRules)
    ->withSkipPath('*/vendor/*')
    ->withSkipPath('*/ResponsePayload/*') // Response (Model) ValueObjects cannot be strictly typed, because of type juggling!
    ->withParallel(timeoutSeconds: 240, maxNumberOfProcess: 4)
    ->withPhpVersion(PhpVersion::PHP_82)
    ->withCache(
        cacheDirectory: '/tmp/rector',      // specify a path that works locally as well as on CI job runners
        cacheClass: FileCacheStorage::class // ensure file system caching is used instead of in-memory
    );
;
