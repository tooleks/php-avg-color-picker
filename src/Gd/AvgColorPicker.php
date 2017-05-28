<?php

namespace Tooleks\Php\AvgColorPicker\Gd;

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
        $image = Image::createFromPath($imagePath);

        $hex = $image->getAvgHex();

        unset($image);

        return $hex;
    }

    /**
     * @inheritdoc
     */
    public function getImageAvgRgbByPath(string $imagePath): array
    {
        $image = Image::createFromPath($imagePath);

        $rgb = $image->getAvgRgb();

        unset($image);

        return $rgb;
    }
}
