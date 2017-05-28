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

    /**
     * Get average color of the image by its resource in HEX format.
     *
     * @param resource $imageResource
     * @return string
     */
    public function getImageAvgHexByResource($imageResource): string;

    /**
     * Get average color of the image by its resource in RGB format.
     *
     * @param resource $imageResource
     * @return array
     */
    public function getImageAvgRgbByResource($imageResource): array;

    /**
     * Get average color of the image by its resource or path in HEX format.
     *
     * @param resource|string $image
     * @return string
     */
    public function getImageAvgHex($image): string;

    /**
     * Get average color of the image by its resource or path in RGB format.
     *
     * @param resource|string $image
     * @return array
     */
    public function getImageAvgRgb($image): array;
}
