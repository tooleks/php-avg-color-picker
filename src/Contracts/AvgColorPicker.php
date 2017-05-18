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
     * @param int $eachNthPixel
     * @return string
     */
    public function getImageAvgHexByPath(string $imagePath, int $eachNthPixel): string;
}
