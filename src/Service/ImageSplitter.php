<?php

declare(strict_types=1);

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

        $source = imagecreatefrompng($this->baseImagesPath.$imagePath);
        $source_width = imagesx($source);
        $source_height = imagesy($source);

        for ($col = 0; $col < $source_width / $width; ++$col) {
            for ($row = 0; $row < $source_height / $height; ++$row) {
                $fn = sprintf($this->baseImagesPath.'/images/wally-generated-%02d-%02d.jpg', $col, $row);

                $im = @imagecreatetruecolor($width, $height);
                imagecopyresized($im, $source, 0, 0,
                    $col * $width, $row * $height, $width, $height,
                    $width, $height);
                imagejpeg($im, $fn);
                imagedestroy($im);
            }
        }
    }

    /**
     * Build an array of splitted images names from the original image path.
     *
     * @param string $imagePath The original image path
     *
     * @todo Link $imagePath to the glob function with a pattern
     *
     * @return array The array of splitted images names
     */
    public function getSplittedImages(string $imagePath): array
    {
        $splitted_images = [];
        $generated_name = 'wally-generated-';

        $images = glob($this->baseImagesPath.'/images/'.$generated_name.'*.jpg') ?: [];
        $images = array_map(fn ($image) => basename($image), $images);
        sort($images);

        foreach ($images as $image) {
            $image_name = $image;
            $image_col = (int) substr($image_name, \strlen($generated_name), 2);
            $image_row = (int) substr($image_name, \strlen($generated_name) + 3, 2);

            $splitted_images[] = [
                'name' => $image_name,
                'col' => $image_col,
                'row' => $image_row,
            ];
        }

        return $splitted_images;
    }
}
