# The PHP Average Color Picker Library

The package provides the library for picking an average color from the given image. Currently it supports `image/png`, `image/jpeg`, `image/gif` image MIME types.

## Example

### Input - The Image Path

[The Image Path](https://github.com/tooleks/php-avg-color-picker/tree/master/resources/input.jpg)  
![Input](https://raw.githubusercontent.com/tooleks/php-avg-color-picker/master/resources/input.jpg)

### Output - The Image Average Color

[The Image Average Color](https://github.com/tooleks/php-avg-color-picker/tree/master/resources/output.jpg)  
![Output](https://raw.githubusercontent.com/tooleks/php-avg-color-picker/master/resources/output.jpg)

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
<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

$imageAvgRgbColor = (new AvgColorPicker)->getImageAvgRgbByPath($imagePath);
// or
$imageAvgRgbColor = (new AvgColorPicker)->getImageAvgRgbByResource($gdImageResource);
// or
$imageAvgRgbColor = (new AvgColorPicker)->getImageAvgRgb($imagePath);
// or
$imageAvgRgbColor = (new AvgColorPicker)->getImageAvgRgb($gdImageResource);

// The `$imageAvgRgbColor` variable contains the average color of the given image in RGB format (array)[255, 255, 255].
```

```php
<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

$imageAvgHexColor = (new AvgColorPicker)->getImageAvgHexByPath($imagePath);
// or
$imageAvgHexColor = (new AvgColorPicker)->getImageAvgHexByResource($gdImageResource);
// or
$imageAvgHexColor = (new AvgColorPicker)->getImageAvgHex($imagePath);
// or
$imageAvgHexColor = (new AvgColorPicker)->getImageAvgHex($gdImageResource);

// The `$imageAvgHexColor` variable contains the average color of the given image in HEX format (string)"#fffff".
```

You can use the calculated value to show the average image color in its container before the image is loaded.

```php
<div style="background-color: <?= $imageAvgHexColor ?>; width: <?= $imageWidth ?>; height: <?= $imageHeight ?>;">
    <img src="/url/to/the/image.(jpg|jpeg|png|gif)" alt="">
</div>
```

## Tests

Execute the following command to run tests:

```shell
./vendor/bin/phpunit
```
