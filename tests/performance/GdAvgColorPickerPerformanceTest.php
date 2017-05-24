<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

/**
 * Class GdAvgColorPickerPerformanceTest.
 */
class GdAvgColorPickerPerformanceTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass()
    {
        file_put_contents(__DIR__ . '/' . static::class . 'Results.csv', '');
    }

    public function storeResult(int $eachNthPixel, float $execTime, string $avgHex)
    {
        file_put_contents(
            __DIR__ . '/' . static::class . 'Results.csv',
            implode(',', [$eachNthPixel, $execTime, $avgHex]) . PHP_EOL,
            FILE_APPEND
        );
    }

    public function measureExecTime(\Closure $callback): float
    {
        $startTime = microtime(true);

        $callback();

        $endTime = microtime(true);

        return $endTime - $startTime;
    }

    public function testGetImageAvgHexByPathEachPx()
    {
        $execTime = $this->measureExecTime(function () use (&$avgHex) {
            $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg');
        });

        $this->storeResult(1, $execTime, $avgHex);
    }

    public function testGetImageAvgHexByPathEachSecondPx()
    {
        $execTime = $this->measureExecTime(function () use (&$avgHex) {
            $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg', 2);
        });

        $this->storeResult(2, $execTime, $avgHex);
    }

    public function testGetImageAvgHexByPathEachThirdPx()
    {
        $execTime = $this->measureExecTime(function () use (&$avgHex) {
            $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg', 3);
        });

        $this->storeResult(3, $execTime, $avgHex);
    }

    public function testGetImageAvgHexByPathEachFourthPx()
    {
        $execTime = $this->measureExecTime(function () use (&$avgHex) {
            $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg', 4);
        });

        $this->storeResult(4, $execTime, $avgHex);
    }

    public function testGetImageAvgHexByPathEachFifthPx()
    {
        $execTime = $this->measureExecTime(function () use (&$avgHex) {
            $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg', 5);
        });

        $this->storeResult(5, $execTime, $avgHex);
    }

    public function testGetImageAvgHexByPathEachSixthPx()
    {
        $execTime = $this->measureExecTime(function () use (&$avgHex) {
            $avgHex = (new AvgColorPicker)->getImageAvgHexByPath(__DIR__ . '/../samples/valid_image.jpg', 6);
        });

        $this->storeResult(6, $execTime, $avgHex);
    }
}
