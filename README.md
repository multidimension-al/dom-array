# Array to DOMDocument Converter

[![Build Status](https://travis-ci.org/multidimension-al/dom-array.svg)](https://travis-ci.org/multidimension-al/dom-array)
[![Latest Stable Version](https://poser.pugx.org/multidimensional/dom-array/v/stable.svg)](https://packagist.org/packages/multidimensional/dom-array)
[![Code Coverage](https://scrutinizer-ci.com/g/multidimension-al/dom-array/badges/coverage.png)](https://scrutinizer-ci.com/g/multidimension-al/dom-array/)
[![Minimum PHP Version](http://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/multidimensional/dom-array/license.svg)](https://packagist.org/packages/multidimensional/dom-array)
[![Total Downloads](https://poser.pugx.org/multidimensional/dom-array/d/total.svg)](https://packagist.org/packages/multidimensional/dom-array)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/multidimension-al/dom-array/badges/quality-score.png)](https://scrutinizer-ci.com/g/multidimension-al/dom-array/)

This library extends the DOMDocument function by adding a ```loadArray``` function that converts PHP arrays to DOMDocument classes that can be used to generate XML, HTML and other types of code. This library does the opposite of our [XML-Array](https://github.com/multidimension-al/xml-array) library which converts XML to a PHP array.

## Requirements

* PHP 5.5+

# Installation

The easiest way to install this library is to use composer. To install, simply include the following in your ```composer.json``` file:

```
"require": {
    "multidimensional/dom-array": "*"
}
```

Or run the following command from a terminal or shell:

```
composer require --prefer-dist multidimensional/dom-array
```

You can also specify version constraints, with more information available [here](https://getcomposer.org/doc/articles/versions.md).

# Usage

This library utilizes PSR-4 autoloading, so make sure you include the library near the top of your class file:

```php
use Multidimensional\DomArray\DOMArray;
```

How to use in your code:

```php
$dom = new DOMArray('1.0', 'utf-8');
$array = ['item' => ['subitem' => 'true', '@id' => '123']];
$dom->loadArray($array);
$xml = $dom->saveXML();

echo $xml;

/*  <?xml version="1.0" encoding="utf-8"?>
 *  <item id="123">
 *    <subitem>true</subitem>
 *  </item>
 */
```

As shown in the example, attributes can be assigned by adding an ```@``` symbol before the attribute name.


# Contributing

We appreciate all help in improving this library by either adding functions or improving existing functionality. If you do want to add to our library, please ensure you use PSR-2 formatting and add unit testing for all added functions.

Feel free to fork and submit a pull request!

# License

    MIT License
    
    Copyright (c) 2017 - 2019 multidimension.al
    
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.