<?php

/**
 * Class UnitTestCase.
 */
abstract class UnitTestCase extends \PHPUnit\Framework\TestCase
{
    public function testValidImagePathProvider()
    {
        return [
            [__DIR__ . '/../samples/valid_image.gif'],
            [__DIR__ . '/../samples/valid_image.jpg'],
            [__DIR__ . '/../samples/valid_image.png'],
        ];
    }

    public function testValidImageResourceProvider()
    {
        return [
            [imagecreatefromgif(__DIR__ . '/../samples/valid_image.gif')],
            [imagecreatefromjpeg(__DIR__ . '/../samples/valid_image.jpg')],
            [imagecreatefrompng(__DIR__ . '/../samples/valid_image.png')],
        ];
    }

    public function testInvalidImageResourceProvider()
    {
        return [
            ['invalid_resource'],
        ];
    }

    public function testInvalidMimeTypeImagePathProvider()
    {
        return [
            [__DIR__ . '/../samples/invalid_image.jpg'],
        ];
    }

    public function testImageInvalidPathProvider()
    {
        return [
            ['invalid/path'],
        ];
    }
}
