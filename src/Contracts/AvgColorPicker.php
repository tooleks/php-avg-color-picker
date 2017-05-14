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
     * Get average color of the image by its path in HEX format.
     *
     * @param string $imagePath
     * @return string
     */
    public function getImageAvgHexByPath(string $imagePath): string;
}
