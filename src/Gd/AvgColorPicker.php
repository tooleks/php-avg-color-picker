<?php

namespace Tooleks\Php\AvgColorPicker\Gd;

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

    /**
     * @inheritdoc
     */
    public function getImageAvgHexByResource($imageResource): string
    {
        $image = Image::createFromResource($imageResource);

        $hex = $image->getAvgHex();

        unset($image);

        return $hex;
    }

    /**
     * @inheritdoc
     */
    public function getImageAvgRgbByResource($imageResource): array
    {
        $image = Image::createFromResource($imageResource);

        $rgb = $image->getAvgRgb();

        unset($image);

        return $rgb;
    }

    /**
     * @inheritdoc
     */
    public function getImageAvgHex($image): string
    {
        return is_resource($image) ? $this->getImageAvgHexByResource($image) : $this->getImageAvgHexByPath($image);
    }

    /**
     * @inheritdoc
     */
    public function getImageAvgRgb($image): array
    {
        return is_resource($image) ? $this->getImageAvgRgbByResource($image) : $this->getImageAvgRgbByPath($image);
    }
}
