<?php

namespace App\Service;

class ImageSplitter
{
    public function __construct(private readonly string $baseImagesPath)
    {
    }

    public function split(string $imagePath): void
    {
        $width = 250;
        $height = 250;

        $source = imagecreatefrompng($this->baseImagesPath . $imagePath);
        $source_width = imagesx($source);
        $source_height = imagesy($source);

        for ($col = 0; $col < $source_width / $width; $col++) {
            for ($row = 0; $row < $source_height / $height; $row++) {
                $fn = sprintf($this->baseImagesPath . "/images/wally-generated-%02d-%02d.jpg", $col, $row);

                $im = @imagecreatetruecolor($width, $height);
                imagecopyresized($im, $source, 0, 0,
                    $col * $width, $row * $height, $width, $height,
                    $width, $height);
                imagejpeg($im, $fn);
                imagedestroy($im);
            }
        }
    }
}