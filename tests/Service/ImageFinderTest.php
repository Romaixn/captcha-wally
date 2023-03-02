<?php

namespace App\Tests\Service;

use App\Service\ImageFinder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImageFinderTest extends KernelTestCase
{
    public function testFindImageSuccessfull(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $imageFinder = static::getContainer()->get(ImageFinder::class);

        $imageUrl = $imageFinder->getImageUrl('wally-1.png');

        $this->assertStringContainsString('public/build/images/captcha/wally-1.png', $imageUrl);
        $this->assertFileExists($imageUrl);
        $this->assertFileIsReadable($imageUrl);
    }

    public function testFindUnknownImage(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $imageFinder = static::getContainer()->get(ImageFinder::class);

        $imageUrl = $imageFinder->getImageUrl('unknown.png');

        $this->assertStringContainsString('public/build/images/captcha/unknown.png', $imageUrl);
        $this->assertFileDoesNotExist($imageUrl);
    }
}
