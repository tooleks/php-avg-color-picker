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

    public function testHex2RgbWithInvalidMinLength()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#00000');
    }

    public function testHex2RgbWithInvalidMaxLength()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#0000000');
    }

    public function testHex2RgbWithInvalidFirstCharacter()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('-000000');
    }

    public function testHex2RgbWithInvalidValues()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#000Q00');
    }

    public function testRgb2Hex()
    {
        $this->assertEquals('#000000', (new ColorConverter)->rgb2hex([0, 0, 0]));

        $this->assertEquals('#ffffff', (new ColorConverter)->rgb2hex([255, 255, 255]));
    }

    public function testRgb2HexWithInvalidRgbMinCount()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([0, 0]);
    }

    public function testRgb2HexWithInvalidRgbMaxCount()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([0, 0, 0, 0]);
    }

    public function testRgb2HexWithInvalidRgbMinValue()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([-1, -1, -1]);
    }

    public function testRgb2HexWithInvalidRgbMaxValue()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([256, 256, 256]);
    }
}
