<?php

use Tooleks\Php\AvgColorPicker\ColorConverter;

/**
 * Class ColorConverterUnitTest.
 */
class ColorConverterUnitTest extends UnitTestCase
{
    /**
     * @dataProvider testValidColorsProvider
     * @param string $hex
     * @param array $rgb
     */
    public function testHex2Rgb(string $hex, array $rgb)
    {
        $this->assertEquals($rgb, (new ColorConverter)->hex2rgb($hex));
    }

    /**
     * @dataProvider testValidColorsProvider
     * @param string $hex
     * @param array $rgb
     */
    public function testRgb2Hex(string $hex, array $rgb)
    {
        $this->assertEquals($hex, (new ColorConverter)->rgb2hex($rgb));
    }

    /**
     * @dataProvider testInvalidHexProvider
     * @param string $hex
     */
    public function testHex2RgbFromInvalidValue(string $hex)
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb($hex);
    }

    /**
     * @dataProvider testInvalidRgbProvider
     * @param array $rgb
     */
    public function testRgb2HexFromInvalidValue(array $rgb)
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex($rgb);
    }
}
