<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

/**
 * Class GdAvgColorPickerTest.
 */
class GdAvgColorPickerTest extends \PHPUnit\Framework\TestCase
{
    public function testGetImageAvgHexByPathFromGif()
    {
        $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.gif');

        $this->assertEquals('#855346', $avgHex);
    }

    public function testGetImageAvgHexByPathFromJpeg()
    {
        $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg');

        $this->assertEquals('#835143', $avgHex);
    }

    public function testGetImageAvgHexByPathFromPng()
    {
        $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.png');

        $this->assertEquals('#835143', $avgHex);
    }

    public function testGetImageAvgHexByPathFromInvalidPath()
    {
        $this->expectException(\RuntimeException::class);

        (new AvgColorPicker)->getImageAvgHexByPath('invalid/path');
    }

    public function testGetImageAvgHexByPathFromInvalidImage()
    {
        $this->expectException(\RuntimeException::class);

        (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/invalid_image.jpg');
    }
}
