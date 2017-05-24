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

$imageAvgHexColor = (new AvgColorPicker)->getImageAvgHexByPath('/absolute/path/to/the/image.(jpg|jpeg|png|gif)');

// The `$imageAvgHexColor` variable contains the average color of the given image in HEX format (#fffff).
```

To improve the performance while processing large images you can decrease the accuracy by passing the `$eachNthPixel` argument value. Example, if `$eachNthPixel === 2` the library will process each second pixel of the image. By providing this argument you can improve the performance up to 23x! See the `Performance` section below.

```php
<?php

use Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker;

$eachNthPixel = 2;

$imageAvgHexColor = (new AvgColorPicker)->getImageAvgHexByPath('/absolute/path/to/the/image.(jpg|jpeg|png|gif)', $eachNthPixel);
```

You can use the calculated value to show the average image color in its container before the image is loaded.

```php
<div style="background-color: <?= $imageAvgHexColor ?>; width: <?= $imageWidth ?>; height: <?= $imageHeight ?>;">
    <img src="/url/to/the/image.(jpg|jpeg|png|gif)" alt="">
</div>
```

## Performance

### AvgColorPicker::getImageAvgHexByPath Method

#### Hardware  

```
CPU Model name: Intel(R) Core(TM) i5-3337U CPU @ 1.80GHz
CPU(s): 4
RAM: 6GB
```

#### Software  

```
OS: Kubuntu 17.04 (64-bit)
PHP: 7.0
```

#### Input Image

![Input image](https://raw.githubusercontent.com/tooleks/php-avg-color-picker/master/resources/input.jpg)  

#### Results

| `$eachNthPixel` Argument Value | Execution Time, s | Average Color, HEX |
|:-------------------------------|:------------------|:-------------------|
| 1                              | 0.73312401771545  | #835143            |
| 2                              | 0.18427085876465  | #7e4d3f            |
| 3                              | 0.088268995285034 | #794d40            |
| 4                              | 0.048856973648071 | #7f4d3f            |
| 5                              | 0.031373023986816 | #804f41            |
| 6                              | 0.022485017776489 | #7c4d3e            |

## Tests

Execute the following command to run tests:

```shell
./vendor/bin/phpunit
```
