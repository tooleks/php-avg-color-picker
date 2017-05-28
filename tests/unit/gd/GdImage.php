<?php

use Tooleks\Php\AvgColorPicker\Exceptions\InvalidArgumentException;
use Tooleks\Php\AvgColorPicker\Exceptions\InvalidMimeTypeException;
use Tooleks\Php\AvgColorPicker\Gd\Image;

/**
 * Class GdImage.
 */
class GdImage extends UnitTestCase
{
    /**
     * @dataProvider testInvalidMimeTypeImagePathProvider
     * @param string $path
     */
    public function testCreateFromInvalidImagePath(string $path)
    {
        $this->expectException(InvalidMimeTypeException::class);

        Image::createFromPath($path);
    }

    /**
     * @dataProvider testImageInvalidPathProvider
     * @param string $path
     */
    public function testCreateFromImageInvalidPath(string $path)
    {
        $this->expectException(\PHPUnit_Framework_Error_Warning::class);

        Image::createFromPath($path);
    }

    /**
     * @dataProvider testInvalidImageResourceProvider
     * @param resource $resource
     */
    public function testCreateFromInvalidImageResource($resource)
    {
        $this->expectException(InvalidArgumentException::class);

        Image::createFromResource($resource);
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     */
    public function testCreateFromValidImagePath(string $path)
    {
        $image = Image::createFromPath($path);

        $this->assertInstanceOf(Image::class, $image);
    }

    /**
     * @dataProvider testValidImageResourceProvider
     * @param resource $resource
     */
    public function testCreateFromValidImageResource($resource)
    {
        $image = Image::createFromResource($resource);

        $this->assertInstanceOf(Image::class, $image);
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     */
    public function testGetImageWidth(string $path)
    {
        $width = Image::createFromPath($path)->getWidth();

        $this->assertEquals(400, $width);
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     */
    public function testGetImageHeight(string $path)
    {
        $height = Image::createFromPath($path)->getHeight();

        $this->assertEquals(225, $height);
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     */
    public function testGetImageAvgHex(string $path)
    {
        $hex = Image::createFromPath($path)->getAvgHex();

        $this->assertTrue($hex === '#734534' || $hex === '#6b4534');
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     */
    public function testGetImageAvgRgb(string $path)
    {
        $rgb = Image::createFromPath($path)->getAvgRgb();

        $this->assertTrue(!array_diff($rgb, [115, 69, 52]) || !array_diff($rgb, [107, 69, 52]));
    }
}
