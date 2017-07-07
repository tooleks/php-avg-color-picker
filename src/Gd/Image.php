<?php

namespace Tooleks\Php\AvgColorPicker\Gd;

use Tooleks\Php\AvgColorPicker\ColorConverter;
use Tooleks\Php\AvgColorPicker\Exceptions\InvalidArgumentException;
use Tooleks\Php\AvgColorPicker\Exceptions\InvalidImageDimensionException;
use Tooleks\Php\AvgColorPicker\Exceptions\InvalidMimeTypeException;

/**
 * Class Image.
 *
 * @package Tooleks\Php\AvgColorPicker\Gd
 * @author Oleksandr Tolochko <tooleks@gmail.com>
 */
class Image
{
    /**
     * An image resource.
     *
     * @var resource
     */
    protected $resource;

    /**
     * @var bool
     */
    protected $cleanupOnDestruct;

    /**
     * Image constructor.
     *
     * @param resource $resource
     * @param bool $cleanupOnDestruct
     */
    protected function __construct($resource, bool $cleanupOnDestruct = true)
    {
        $this->assertResource($resource);

        $this->resource = $resource;
        $this->cleanupOnDestruct = $cleanupOnDestruct;
    }

    /**
     * Image destructor.
     */
    public function __destruct()
    {
        if ($this->cleanupOnDestruct) {
            imagedestroy($this->resource);
        }
    }

    /**
     * Assert an image resource.
     *
     * @param $resource
     */
    protected function assertResource($resource)
    {
        if (!is_resource($resource) || get_resource_type($resource) !== 'gd') {
            throw new InvalidArgumentException('Invalid resource type.');
        }

        $width = imagesx($resource);
        $height = imagesy($resource);
        if ($width < 1 || $height < 1) {
            throw new InvalidImageDimensionException(
                sprintf('The resource image dimensions should be at least 1x1px. The resource image with %sx%spx dimensions given.', $width, $height)
            );
        }
    }

    /**
     * Create an image from the resource.
     *
     * @param resource $resource
     * @return $this
     */
    public static function createFromResource($resource)
    {
        return new static($resource, false);
    }

    /**
     * Create an image from the path.
     *
     * @param string $path
     * @return $this
     */
    public static function createFromPath(string $path)
    {
        $createFunctions = [
            'image/png' => 'imagecreatefrompng',
            'image/jpeg' => 'imagecreatefromjpeg',
            'image/gif' => 'imagecreatefromgif',
        ];

        $mimeType = mime_content_type($path);

        if (!array_key_exists($mimeType, $createFunctions)) {
            throw new InvalidMimeTypeException(sprintf('The "%s" mime type is not supported.', $mimeType));
        }

        $resource = $createFunctions[$mimeType]($path);

        return new static($resource);
    }

    /**
     * Get an image width.
     *
     * @return int
     */
    public function getWidth(): int
    {
        return imagesx($this->resource);
    }

    /**
     * Get an image height.
     *
     * @return int
     */
    public function getHeight(): int
    {
        return imagesy($this->resource);
    }

    /**
     * Get an image average color in RGB [255, 255, 255] format.
     *
     * @return array
     */
    public function getAvgRgb(): array
    {
        $resource = imagescale($this->resource, 1, 1);

        $rgba = imagecolorsforindex($resource, imagecolorat($resource, 0, 0));

        imagedestroy($resource);

        return array_slice(array_values($rgba), 0, 3);
    }

    /**
     * Get an image average color in HEX $ffffff format.
     *
     * @return string
     */
    public function getAvgHex(): string
    {
        $rgb = $this->getAvgRgb();

        return (new ColorConverter)->rgb2hex($rgb);
    }
}
