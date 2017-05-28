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
    public function testGetImageWidth(string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($width, Image::createFromPath($path)->getWidth());
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     */
    public function testGetImageHeight(string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($height, Image::createFromPath($path)->getHeight());
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgHexFromPath(string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($hex, Image::createFromPath($path)->getAvgHex());
    }

    /**
     * @dataProvider testValidImagePathProvider
     * @param string $path
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgRgbFromPath(string $path, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($rgb, Image::createFromPath($path)->getAvgRgb());
    }

    /**
     * @dataProvider testValidImageResourceProvider
     * @param resource $resource
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgHexFromResource($resource, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($hex, Image::createFromResource($resource)->getAvgHex());
    }

    /**
     * @dataProvider testValidImageResourceProvider
     * @param resource $resource
     * @param int $width
     * @param int $height
     * @param string $hex
     * @param array $rgb
     */
    public function testGetImageAvgRgbFromResource($resource, int $width, int $height, string $hex, array $rgb)
    {
        $this->assertEquals($rgb, Image::createFromResource($resource)->getAvgRgb());
    }
}
