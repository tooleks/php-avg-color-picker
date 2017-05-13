# The PHP Average Color Picker Library

The package provides the library for picking `average` color from the given image.

## Example

### Input

![Input](https://github.com/tooleks/php-avg-color-picker/tree/master/resources/input.jpg)

### Output

![Output](https://github.com/tooleks/php-avg-color-picker/tree/master/resources/output.jpg)

## Requirements

"php": "^7.0",
"ext-mbstring": "\*",
"ext-gd": "\*"

## Installation

### Package Installation

Execute the following command to get the latest version of the package:

```shell
composer require tooleks/php-avg-color-picker
```

## Usage Examples

```php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

$hexColor = (new AvgColorPicker)->getImageAvgHexColorByPath('/absolute/path/to/image.(jpg|jpeg|png|gif)');

echo $hexColor; // Prints average HEX color of the image (Example: #fffff).

```

## Tests

Execute the following command to run tests:

```shell
./vendor/bin/phpunit
```
