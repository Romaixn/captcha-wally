<?php

declare(strict_types=1);

namespace App\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use Symfony\Component\HttpFoundation\Response;

use function Symfony\Component\String\u;

/**
 * @implements Rule<New_>
 */
final class NoNewInControllerRule implements Rule
{
    public function getNodeType(): string
    {
        return New_::class;
    }

    /**
     * @param New_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        // Only in controllers
        if (!$this->isInControllerNamespace($scope)) {
            return [];
        }

        // Trait are allowed
        if ($scope->isInTrait()) {
            return [];
        }

        if (!$node->class instanceof FullyQualified) {
            return [];
        }

        $classString = $node->class->toCodeString();

        // Exceptions are allowed
        if (is_a($classString, \Throwable::class, true)) {
            return [];
        }

        // Responses are allowed
        if (is_a($classString, Response::class, true)) {
            return [];
        }

        return [sprintf("You can't instanciate a %s object manually in controllers, create a service please.", $classString)];
    }

    /**
     * Check that the class belongs to the controller namespace.
     */
    private function isInControllerNamespace(Scope $scope): bool
    {
        return u($scope->getNamespace())->startsWith('App\Controller');
    }
}
