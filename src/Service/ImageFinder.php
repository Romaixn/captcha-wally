<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

final class ImageFinder
{
    private PathPackage $pathPackage;

    public function __construct(string $baseImagesPath)
    {
        $this->pathPackage = new PathPackage($baseImagesPath, new EmptyVersionStrategy());
    }

    public function getImageUrl(string $name): string
    {
        return $this->pathPackage->getUrl($name);
    }
}
