<?php

declare(strict_types=1);

namespace App\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

use function Symfony\Component\String\u;

/**
 * @implements Rule<Class_>
 */
abstract class AbstractControllerRule implements Rule
{
    /**
     * Restricts on class nodes only. One rule, one node and check.
     */
    public function getNodeType(): string
    {
        return Class_::class;
    }

    abstract public function processNode(Node $node, Scope $scope): array;

    protected function isInControllerNamespace(Scope $scope): bool
    {
        return u($scope->getNamespace())->startsWith('App\Controller');
    }
}
