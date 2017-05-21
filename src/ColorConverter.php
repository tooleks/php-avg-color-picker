<?php

namespace Tooleks\Php\AvgColorPicker;

use RuntimeException;

/**
 * Class ColorConverter.
 *
 * @package Tooleks\Php\AvgColorPicker
 * @author Oleksandr Tolochko <tooleks@gmail.com>
 */
class ColorConverter
{
    /**
     * Convert color in HEX to RGB format.
     *
     * Example: HEX (string) #000000 -> RGB (array) [0, 0, 0]
     *
     * Note: The method accepts only fully specified HEX values (Example: #000000).
     *
     * @param string $hex
     * @return array
     * @throws RuntimeException
     */
    public function hex2rgb(string $hex): array
    {
        $this->assertHex($hex);

        return sscanf($hex, "#%02x%02x%02x");
    }

    /**
     * Assert HEX format.
     *
     * Note: The method accepts only fully specified HEX values (Example: #000000).
     *
     * @param string $hex
     * @return void
     * @throws RuntimeException
     */
    public function assertHex(string $hex)
    {
        // Assert HEX value length.
        if (mb_strlen($hex) !== 7) {
            throw new RuntimeException(sprintf('Invalid HEX value %s.', $hex));
        }

        // Assert HEX value first character.
        if (mb_substr($hex, 0, 1) !== '#') {
            throw new RuntimeException(sprintf('Invalid HEX value %s.', $hex));
        }

        for ($i = 1; $i < mb_strlen($hex); $i++) {
            // Assert HEX digit value.
            if (!ctype_xdigit($hex[$i])) {
                throw new RuntimeException(sprintf('Invalid HEX value %s.', $hex));
            }
        }
    }

    /**
     * Convert color in RGB to HEX format.
     *
     * Example: RGB (array) [0, 0, 0] -> HEX (string) #000000
     *
     * @param array $rgb
     * @return string
     * @throws RuntimeException
     */
    public function rgb2hex(array $rgb): string
    {
        $this->assertRgb($rgb);

        list($red, $green, $blue) = $rgb;

        return sprintf('#%02x%02x%02x', $red, $green, $blue);
    }

    /**
     * Assert RGB format.
     *
     * @param array $rgb
     * @return void
     * @throws RuntimeException
     */
    public function assertRgb(array $rgb)
    {
        // Assert RGB values count.
        if (count($rgb) !== 3) {
            throw new RuntimeException(sprintf('Invalid RGB value [%s].', implode(', ', $rgb)));
        }

        foreach ($rgb as $value) {
            // Assert RGB value.
            if ($value < 0 || $value > 255) {
                throw new RuntimeException(sprintf('Invalid RGB value [%s].', implode(', ', $rgb)));
            }
        }
    }
}
