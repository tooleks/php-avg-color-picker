<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

/**
 * Class AvgColorPickerTest.
 */
class AvgColorPickerTest extends TestCase
{
    public function testGetImageAvgHexColorByPathFromGif()
    {
        $hex = (new AvgColorPicker)->getImageAvgHexColorByPath(__DIR__ . '/../../samples/valid_image.gif');

        $this->assertEquals('#855346', $hex);
    }

    public function testGetImageAvgHexColorByPathFromJpeg()
    {
        $hex = (new AvgColorPicker)->getImageAvgHexColorByPath(__DIR__ . '/../../samples/valid_image.jpg');

        $this->assertEquals('#835143', $hex);
    }

    public function testGetImageAvgHexColorByPathFromPng()
    {
        $hex = (new AvgColorPicker)->getImageAvgHexColorByPath(__DIR__ . '/../../samples/valid_image.png');

        $this->assertEquals('#835143', $hex);
    }

    public function testGetImageAvgHexColorByPathFromInvalidPath()
    {
        $this->expectException(\RuntimeException::class);

        (new AvgColorPicker)->getImageAvgHexColorByPath('invalid/path');
    }

    public function testGetImageAvgHexColorByPathFromInvalidImage()
    {
        $this->expectException(\RuntimeException::class);

        (new AvgColorPicker)->getImageAvgHexColorByPath(__DIR__ . '/../../samples/invalid_image.jpg');
    }
}
