<?php

namespace Tooleks\Php\AvgColorPicker\Gd;

use Closure;
use RuntimeException;
use Tooleks\Php\AvgColorPicker\ColorConverter;
use Tooleks\Php\AvgColorPicker\Contracts\AvgColorPicker as AvgColorPickerContract;

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
        $avgHex = [];

        $this->eachImagePixel($this->createImageResource($imagePath), function ($imageResource, $xCoordinate, $yCoordinate) use (&$avgHex) {
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
        if (!file_exists($imagePath)) {
            throw new RuntimeException(sprintf('The "%s" file not exist.', $imagePath));
        }

        $imageCreateFunctions = [
            'image/png' => 'imagecreatefrompng',
            'image/jpeg' => 'imagecreatefromjpeg',
            'image/gif' => 'imagecreatefromgif',
        ];

        $imageMimeType = mime_content_type($imagePath);

        if (!array_key_exists($imageMimeType, $imageCreateFunctions)) {
            throw new RuntimeException(sprintf('The "%s" mime type not supported.', $imageMimeType));
        }

        return call_user_func($imageCreateFunctions[$imageMimeType], $imagePath);
    }

    /**
     * Apply callback function on each pixel in the image.
     *
     * @param $imageResource
     * @param Closure $callback
     * @return void
     */
    private function eachImagePixel($imageResource, Closure $callback)
    {
        $imageWidth = imagesx($imageResource);
        $imageHeight = imagesy($imageResource);

        for ($xCoordinate = 0; $xCoordinate < $imageWidth; $xCoordinate++) {
            for ($yCoordinate = 0; $yCoordinate < $imageHeight; $yCoordinate++) {
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
