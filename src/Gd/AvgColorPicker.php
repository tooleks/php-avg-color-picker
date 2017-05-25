<?php

namespace Tooleks\Php\AvgColorPicker\Gd;

use Tooleks\Php\AvgColorPicker\ColorConverter;
use Tooleks\Php\AvgColorPicker\Contracts\AvgColorPicker as AvgColorPickerContract;
use Tooleks\Php\AvgColorPicker\Exceptions\InvalidImageDimensionException;
use Tooleks\Php\AvgColorPicker\Exceptions\InvalidMimeTypeException;

/**
 * Class AvgColorPicker.
 *
 * @package Tooleks\Php\AvgColorPicker\Gd
 */
class AvgColorPicker implements AvgColorPickerContract
{
    /**
     * @inheritdoc
     */
    public function getImageAvgHexByPath(string $imagePath): string
    {
        $imageResource = $this->createImageResource($imagePath);

        $this->assertImage($imageResource);

        $avgRgb = $this->calculateImageAvgRgb($imageResource);

        return (new ColorConverter)->rgb2hex($avgRgb);
    }

    /**
     * @inheritdoc
     */
    public function getImageAvgRgbByPath(string $imagePath): array
    {
        $imageResource = $this->createImageResource($imagePath);

        $this->assertImage($imageResource);

        $avgRgb = $this->calculateImageAvgRgb($imageResource);

        return $avgRgb;
    }

    /**
     * Create image resource.
     *
     * @param string $imagePath
     * @throws InvalidMimeTypeException
     * @return resource
     */
    private function createImageResource(string $imagePath)
    {
        $imageCreateFunctions = [
            'image/png' => 'imagecreatefrompng',
            'image/jpeg' => 'imagecreatefromjpeg',
            'image/gif' => 'imagecreatefromgif',
        ];

        $imageMimeType = mime_content_type($imagePath);

        if (!array_key_exists($imageMimeType, $imageCreateFunctions)) {
            throw new InvalidMimeTypeException(sprintf('The "%s" mime type is not supported.', $imageMimeType));
        }

        return $imageCreateFunctions[$imageMimeType]($imagePath);
    }

    /**
     * Assert image.
     *
     * @param resource $imageResource
     * @throws InvalidImageDimensionException
     * @return void
     */
    private function assertImage($imageResource)
    {
        if (imagesx($imageResource) < 1 || imagesy($imageResource) < 1) {
            throw new InvalidImageDimensionException(
                sprintf('The image dimensions should be at least 1x1px. The image with %sx%spx dimensions given.', $imageWidth, $imageHeight)
            );
        }
    }

    /**
     * Calculate image average color in RGB format.
     *
     * @param resource $imageResource
     * @return array
     */
    private function calculateImageAvgRgb($imageResource): array
    {
        $scaledImageResource = imagescale($imageResource, 1, 1);

        $avgRgb = imagecolorsforindex($scaledImageResource, imagecolorat($scaledImageResource, 0, 0));

        return array_slice(array_values($avgRgb), 0, 3);
    }
}
