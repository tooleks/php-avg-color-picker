<?php

/**
 * Class UnitTestCase.
 */
abstract class UnitTestCase extends \PHPUnit\Framework\TestCase
{
    public function testValidColorsProvider()
    {
        return [
            ['#000000', [0, 0, 0]],
            ['#ffffff', [255, 255, 255]],
        ];
    }

    public function testInvalidHexProvider()
    {
        return [
            ['#00000'],
            ['#0000000'],
            ['-000000'],
            ['#000QK0'],
        ];
    }

    public function testInvalidRgbProvider()
    {
        return [
            [[0, 0]],
            [[0, 0, 0, 0]],
            [[-1, -1, -1]],
            [[256, 256, 256]],
        ];
    }

    public function testValidImageProvider()
    {
        return [
            [
                'resource' => imagecreatefromgif(__DIR__ . '/../samples/valid_image.gif'),
                'path' => __DIR__ . '/../samples/valid_image.gif',
                'width' => 400,
                'height' => 225,
                'avg_hex' => '#754635',
                'avg_rgb' => [117, 70, 53],
            ],
            [
                'resource' => imagecreatefromjpeg(__DIR__ . '/../samples/valid_image.jpg'),
                'path' => __DIR__ . '/../samples/valid_image.jpg',
                'width' => 400,
                'height' => 225,
                'avg_hex' => '#6d4635',
                'avg_rgb' => [109, 70, 53],
            ],
            [
                'resource' => imagecreatefrompng(__DIR__ . '/../samples/valid_image.png'),
                'path' => __DIR__ . '/../samples/valid_image.png',
                'width' => 400,
                'height' => 225,
                'avg_hex' => '#6d4635',
                'avg_rgb' => [109, 70, 53],
            ],
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
