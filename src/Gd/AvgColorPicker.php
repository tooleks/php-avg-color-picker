<?php

namespace Tooleks\Php\AvgColorPicker\Gd;

use Closure;
use Tooleks\Php\AvgColorPicker\ColorConverter;
use Tooleks\Php\AvgColorPicker\Contracts\AvgColorPicker as AvgColorPickerContract;
use Tooleks\Php\AvgColorPicker\Exceptions\InvalidArgumentException;
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
    public function getImageAvgHexByPath(string $imagePath, int $eachNthPixel = 1): string
    {
        $this->eachNthImagePixel($this->createImageResource($imagePath), $eachNthPixel, function ($imageResource, $xCoordinate, $yCoordinate) use (&$avgHex) {
            $pixelRgb = $this->getImagePixelRgb($imageResource, $xCoordinate, $yCoordinate);
            $avgHex = $avgHex ? $this->calculateAvgRgb($avgHex, $pixelRgb) : $pixelRgb;
        });

        return (new ColorConverter)->rgb2hex($avgHex);
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
     * Apply callback function on each n-th pixel in the image.
     *
     * @param resource $imageResource
     * @param int $nthPixel
     * @param Closure $callback
     * @return void
     */
    private function eachNthImagePixel($imageResource, int $nthPixel, Closure $callback)
    {
        $imageWidth = imagesx($imageResource);
        $imageHeight = imagesy($imageResource);

        if ($imageWidth < 1 || $imageHeight < 1) {
            throw new InvalidImageDimensionException(
                sprintf('The image dimension should be at least 1x1 px. The image with %sx%s px dimension given.', $imageWidth, $imageHeight)
            );
        }

        if ($imageWidth <= $nthPixel || $imageHeight <= $nthPixel) {
            throw new InvalidArgumentException(
                sprintf('The $nthPixel argument value should be lower than an image width (%s px) or height (%s px).', $imageWidth, $imageHeight)
            );
        }

        for ($xCoordinate = 0; $xCoordinate < $imageWidth; $xCoordinate += $nthPixel) {
            for ($yCoordinate = 0; $yCoordinate < $imageHeight; $yCoordinate += $nthPixel) {
                $callback($imageResource, $xCoordinate, $yCoordinate);
            }
        }
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

        return array_values($rgb);
    }

    /**
     * Calculate average color in RGB format.
     *
     * @param array $firstRgb
     * @param array $secondRgb
     * @return array
     */
    private function calculateAvgRgb(array $firstRgb, array $secondRgb): array
    {
        list($firstRed, $firstGreen, $firstBlue) = $firstRgb;
        list($secondRed, $secondGreen, $secondBlue) = $secondRgb;

        return array_map('intval', [
            ($firstRed + $secondRed) / 2,
            ($firstGreen + $secondGreen) / 2,
            ($firstBlue + $secondBlue) / 2,
        ]);
    }
}
