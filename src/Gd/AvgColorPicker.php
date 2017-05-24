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
     * @return void
     */
    private function assertImage($imageResource)
    {
        $imageWidth = imagesx($imageResource);
        $imageHeight = imagesy($imageResource);

        if ($imageWidth < 1 || $imageHeight < 1) {
            throw new InvalidImageDimensionException(
                sprintf('The image dimension should be at least 1x1 px. The image with %sx%s px dimension given.', $imageWidth, $imageHeight)
            );
        }
    }

    /**
     * Calculate image average color in RGB format.
     *
     * @param resource $imageResource
     * @return array
     */
    private function calculateImageAvgRgb($imageResource)
    {
        $scaledImageResource = imagescale($imageResource, 1, 1);

        return $this->getImagePixelRgb($scaledImageResource, 0, 0);
    }

    /**
     * Get image pixel color in RGB format.
     *
     * @param resource $imageResource
     * @param int $xCoordinate
     * @param int $yCoordinate
     * @return array
     */
    private function getImagePixelRgb($imageResource, int $xCoordinate, int $yCoordinate): array
    {
        $rgb = imagecolorsforindex($imageResource, imagecolorat($imageResource, $xCoordinate, $yCoordinate));

        return array_slice(array_values($rgb), 0, 3);
    }
}
