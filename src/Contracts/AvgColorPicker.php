<?php

namespace Tooleks\Php\AvgColorPicker\Contracts;

/**
 * Interface AvgColorPicker.
 *
 * @package Tooleks\Php\AvgColorPicker\Contracts
 */
interface AvgColorPicker
{
    /**
     * Get average hex color code of the image by its path.
     *
     * @param string $imagePath
     * @return string
     */
    public function getImageAvgHexColorByPath(string $imagePath) : string;
}
