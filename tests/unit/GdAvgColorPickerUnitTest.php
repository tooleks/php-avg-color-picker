<?php

use Tooleks\Php\AvgColorPicker\Exceptions\InvalidMimeTypeException;
use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

/**
 * Class GdAvgColorPickerUnitTest.
 */
class GdAvgColorPickerUnitTest extends \PHPUnit\Framework\TestCase
{
    public function testGetImageAvgHexByPathFromGif()
    {
        $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.gif');

        $this->assertEquals('#754635', $avgHex);
    }

    public function testGetImageAvgHexByPathFromJpeg()
    {
        $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg');

        $this->assertEquals('#6d4635', $avgHex);
    }

    public function testGetImageAvgHexByPathFromPng()
    {
        $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.png');

        $this->assertEquals('#6d4635', $avgHex);
    }

    public function testGetImageAvgHexByPathFromInvalidPath()
    {
        $this->expectException(\PHPUnit_Framework_Error_Warning::class);

        (new AvgColorPicker)->getImageAvgHexByPath('invalid/path');
    }

    public function testGetImageAvgHexByPathFromInvalidImage()
    {
        $this->expectException(InvalidMimeTypeException::class);

        (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/invalid_image.jpg');
    }

    public function testGetImageAvgRgbByPathFromGif()
    {
        $avgRgb = (new AvgColorPicker)->getImageAvgRgbByPath(__DIR__ . '/../samples/valid_image.gif');

        $this->assertEquals([117, 70, 53], $avgRgb);
    }

    public function testGetImageAvgRgbByPathFromJpeg()
    {
        $avgRgb = (new AvgColorPicker)->getImageAvgRgbByPath(__DIR__ . '/../samples/valid_image.jpg');

        $this->assertEquals([109, 70, 53], $avgRgb);
    }

    public function testGetImageAvgRgbByPathFromPng()
    {
        $avgRgb = (new AvgColorPicker)->getImageAvgRgbByPath(__DIR__ . '/../samples/valid_image.png');

        $this->assertEquals([109, 70, 53], $avgRgb);
    }

    public function testGetImageAvgRgbByPathFromInvalidPath()
    {
        $this->expectException(\PHPUnit_Framework_Error_Warning::class);

        (new AvgColorPicker)->getImageAvgRgbByPath('invalid/path');
    }

    public function testGetImageAvgRgbByPathFromInvalidImage()
    {
        $this->expectException(InvalidMimeTypeException::class);

        (new AvgColorPicker)->getImageAvgRgbByPath(__DIR__ . '/../samples/invalid_image.jpg');
    }
}
