<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

/**
 * Class GdAvgColorPickerUnitTest.
 */
class GdAvgColorPickerUnitTest extends UnitTestCase
{
    /**
     * @dataProvider testValidImageProvider
     * @param resource $resource
     * @param string $path
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgHex($resource, string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($hex, (new AvgColorPicker)->getImageAvgHexByPath($path));
        $this->assertEquals($hex, (new AvgColorPicker)->getImageAvgHex($path));

        $this->assertEquals($hex, (new AvgColorPicker)->getImageAvgHexByResource($resource));
        $this->assertEquals($hex, (new AvgColorPicker)->getImageAvgHex($resource));
    }

    /**
     * @dataProvider testValidImageProvider
     * @param resource $resource
     * @param string $path
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgRgb($resource, string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($rgb, (new AvgColorPicker)->getImageAvgRgbByPath($path));
        $this->assertEquals($rgb, (new AvgColorPicker)->getImageAvgRgb($path));

        $this->assertEquals($rgb, (new AvgColorPicker)->getImageAvgRgbByResource($resource));
        $this->assertEquals($rgb, (new AvgColorPicker)->getImageAvgRgb($resource));
    }
}
