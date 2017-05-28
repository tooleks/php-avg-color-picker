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
     */
    public function testGetImageAvgHexByPath(string $path)
    {
        $hex = (new AvgColorPicker)->getImageAvgHexByPath($path);

        $this->assertTrue($hex === '#734534' || $hex === '#6b4534');
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     */
    public function testGetImageAvgRgbByPath(string $path)
    {
        $rgb = (new AvgColorPicker)->getImageAvgRgbByPath($path);

        $this->assertTrue(!array_diff($rgb, [115, 69, 52]) || !array_diff($rgb, [107, 69, 52]));
    }
}
