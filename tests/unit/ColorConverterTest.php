<?php

use Tooleks\Php\AvgColorPicker\ColorConverter;

/**
 * Class ColorConverterTest.
 */
class ColorConverterTest extends \PHPUnit\Framework\TestCase
{
    public function testHex2Rgb()
    {
        $this->assertEquals([0, 0, 0], (new ColorConverter)->hex2rgb('#000000'));

        $this->assertEquals([255, 255, 255], (new ColorConverter)->hex2rgb('#ffffff'));
    }

    public function testHex2RgbFromInvalidHexMinLength()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#00000');
    }

    public function testHex2RgbFromInvalidHexMaxLength()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#0000000');
    }

    public function testHex2RgbFromInvalidHexFirstCharacter()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('-000000');
    }

    public function testHex2RgbFromInvalidHexDigits()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#000QK0');
    }

    public function testRgb2Hex()
    {
        $this->assertEquals('#000000', (new ColorConverter)->rgb2hex([0, 0, 0]));

        $this->assertEquals('#ffffff', (new ColorConverter)->rgb2hex([255, 255, 255]));
    }

    public function testRgb2HexFromInvalidRgbMinCount()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([0, 0]);
    }

    public function testRgb2HexFromInvalidRgbMaxCount()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([0, 0, 0, 0]);
    }

    public function testRgb2HexFromInvalidRgbMinValue()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([-1, -1, -1]);
    }

    public function testRgb2HexFromInvalidRgbMaxValue()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([256, 256, 256]);
    }
}
