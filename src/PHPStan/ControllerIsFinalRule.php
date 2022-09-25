<?php

declare(strict_types=1);

namespace App\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;

final class ControllerIsFinalRule extends AbstractControllerRule
{
    /**
     * @param Class_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$this->isInControllerNamespace($scope)) {
            return [];
        }

        // Skip abstract controllers
        if ($node->isAbstract()) {
            return [];
        }

        if (!$node->isFinal()) {
            return ['ADR n°1: A Symfony controller should be final.'];
        }

        return [];
    }
}
