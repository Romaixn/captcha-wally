<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Asset\Packages;

final class ImageFinder
{
    public function __construct(private readonly Packages $assetsHelper)
    {
    }

    public function getAssetUrl(string $path): string
    {
        return $this->assetsHelper->getUrl($path);
    }
}
