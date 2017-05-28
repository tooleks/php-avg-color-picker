<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

/**
 * Class GdAvgColorPickerUnitTest.
 */
class GdAvgColorPickerUnitTest extends UnitTestCase
{
    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgHexByPath(string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($hex, (new AvgColorPicker)->getImageAvgHexByPath($path));
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgRgbByPath(string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($rgb, (new AvgColorPicker)->getImageAvgRgbByPath($path));
    }
}
