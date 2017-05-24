<?php

use Tooleks\Php\AvgColorPicker\Exceptions\InvalidArgumentException;
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
        $this->expectException(\PHPUnit_Framework_Error_Warning::class);

        (new AvgColorPicker)->getImageAvgHexByPath('invalid/path');
    }

    public function testGetImageAvgHexByPathFromInvalidImage()
    {
        $this->expectException(InvalidMimeTypeException::class);

        (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/invalid_image.jpg');
    }

    public function testGetImageAvgHexByPathWithEachNthPixelArgument()
    {
        $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.png', 20);

        $this->assertEquals('#9d6553', $avgHex);
    }

    public function testGetImageAvgHexByPathWithInvalidEachNthPixelArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.png', 500);
    }
}
