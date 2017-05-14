# The PHP Average Color Picker Library

The package provides the library for picking an average color from the given image.

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

$imageAvgHexColor = (new AvgColorPicker)->getImageAvgHexByPath('/absolute/path/to/the/image.(jpg|jpeg|png|gif)');

// The `$imageAvgHexColor` variable contains the average color in HEX format (#fffff) of the given image.
```

You can use this value to show the average image color in its container before the image is loaded:

```php
<div style="width: <?= $imageWidth ?>; height: <?= $imageHeight ?>; background-color: <?= $imageAvgHexColor ?>;">
    <img src="/url/to/the/image.(jpg|jpeg|png|gif)" alt="">
</div>
```

## Tests

Execute the following command to run tests:

```shell
./vendor/bin/phpunit
```
