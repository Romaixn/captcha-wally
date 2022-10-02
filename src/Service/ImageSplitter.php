<?php

declare(strict_types=1);

namespace App\Service;

class ImageSplitter
{
    public function __construct(private readonly string $baseImagesPath)
    {
    }

	/**
	 * Split an image by a given number of rows and columns
	 * Images are saved in the public/build/images folder
	 *
	 * @param string $imagePath The path to the image to split
	 * @param integer $cols The number of columns
	 * @param integer $rows The number of rows
	 *
	 * @return void
	 */
    public function split(string $imagePath, int $cols = 4, int $rows = 4): void
    {
        $source_image = imagecreatefrompng($this->baseImagesPath.$imagePath);
        $source_image_width = imagesx($source_image);
        $source_image_height = imagesy($source_image);
		$split_width = (int) round( $source_image_width / $cols );
		$split_height = (int) round( $source_image_height / $rows );

        for ($col = 0; $col < $cols; ++$col) {
            for ($row = 0; $row < $rows; ++$row) {
                $filename = sprintf($this->baseImagesPath.'/images/wally-generated-%02d-%02d.jpg', $col, $row);

                $image = @imagecreatetruecolor($split_width, $split_height);
                imagecopyresized($image, $source_image, 0, 0,
                    $col * $split_width, $row * $split_height, $split_width, $split_height,
                    $split_width, $split_height);
                imagejpeg($image, $filename);
                imagedestroy($image);
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
