<?php

use PHPUnit\Framework\TestCase;
use Tooleks\Php\AvgColorPicker\ColorConverter;

/**
 * Class ColorConverterTest.
 */
class ColorConverterTest extends TestCase
{
    public function testHex2Rgb()
    {
        $this->assertEquals([0, 0, 0], (new ColorConverter)->hex2rgb('#000000'));

        $this->assertEquals([255, 255, 255], (new ColorConverter)->hex2rgb('#ffffff'));
    }

    public function testHex2RgbInvalidMinLength()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#00000');
    }

    public function testHex2RgbInvalidMaxLength()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#0000000');
    }

    public function testHex2RgbInvalidFirstCharacter()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('-000000');
    }

    public function testHex2RgbInvalidValues()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->hex2rgb('#000Q00');
    }

    public function testRgb2Hex()
    {
        $this->assertEquals('#000000', (new ColorConverter)->rgb2hex([0, 0, 0]));

        $this->assertEquals('#ffffff', (new ColorConverter)->rgb2hex([255, 255, 255]));
    }

    public function testRgb2HexInvalidRgbMinCount()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([0, 0]);
    }

    public function testRgb2HexInvalidRgbMaxCount()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([0, 0, 0, 0]);
    }

    public function testRgb2HexInvalidRgbMinValue()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([-1, -1, -1]);
    }

    public function testRgb2HexInvalidRgbMaxValue()
    {
        $this->expectException(\RuntimeException::class);

        (new ColorConverter)->rgb2hex([256, 256, 256]);
    }
}
