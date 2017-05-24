<?php

namespace Tooleks\Php\AvgColorPicker\Contracts;

/**
 * Interface AvgColorPicker.
 *
 * @package Tooleks\Php\AvgColorPicker\Contracts
 * @author Oleksandr Tolochko <tooleks@gmail.com>
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

    /**
     * Get average color of the image by its path in RGB format.
     *
     * @param string $imagePath
     * @return array
     */
    public function getImageAvgRgbByPath(string $imagePath): array;
}
