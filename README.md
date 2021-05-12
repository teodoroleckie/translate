### Fast, powerful, scalable and customizable php translator library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tleckie/translate.svg?style=flat-square)](https://packagist.org/packages/tleckie/translate)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/teodoroleckie/translate/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/teodoroleckie/translate/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/teodoroleckie/translate/badges/build.png?b=main)](https://scrutinizer-ci.com/g/teodoroleckie/translate/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/teodoroleckie/translate/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)
[![Total Downloads](https://img.shields.io/packagist/dt/tleckie/translate.svg?style=flat-square)](https://packagist.org/packages/tleckie/translate)

You can install the package via composer:

```bash
composer require tleckie/translate
```

### Usage

Create an instance of the Translator class to which you will assign a loader. 
The loader must have the directory in which the translation files are stored, 
it must also indicate the extension of the translation files.


```php
use Tleckie\Translate\Loader\ArrayLoader;
use Tleckie\Translate\Translator;

$trans = new Translator(
    new ArrayLoader('./translations/','php'),
    'es_ES'
);

$trans->trans('hello');

```
Your translations file should look like this:

```php
<?php

return [
  'hello' => "Hola! Bienvenido a mi sitio web!"
];
```

The name of the file that stores the translation should look like this:

```bash
/translations/es_ES.php
```
The trans() method takes multiple arguments. The first is the key of the translation 
array, it is the value that will be searched for in its corresponding file.

The second argument (optional) is an array of values to be replaced in the translated value. 
If you want to add values to your translated text you must indicate it with "%s".
Note that the number of arguments must match the number of "%s".

```php
use Tleckie\Translate\Loader\ArrayLoader;
use Tleckie\Translate\Translator;

$trans = new Translator(
    new ArrayLoader('./translations/','php'),
    'es_ES'
);

$trans->trans('hello',['John']);

```

Your translations file should look like this:

```php
<?php

return [
  'hello' => "Hola %s! Bienvenido a mi sitio web!"
];
```

Even if you configure your translator to load a specific language, 
you can also change the language at any time if you need.

```php
use Tleckie\Translate\Loader\ArrayLoader;
use Tleckie\Translate\Translator;

$trans = new Translator(
    new ArrayLoader('./translations/','php'),
    'es_ES'
);

$trans->trans('hello',['John'],null, 'en_GB');

```

You can create your translation files by specifying the language and country defined 
by the provided locale. You can also decide whether to use the same language for different countries.
Regional configuration example:
"en_US" and "en_GB"
In this case, you just need to create a file that has the following name:

```bash
/translations/en.php
```

In that case the following calls will have the same result and will load the translations from the same file.
```php
use Tleckie\Translate\Loader\ArrayLoader;
use Tleckie\Translate\Translator;

$trans = new Translator(
    new ArrayLoader('./translations/','php'),
    'es_ES'
);

$trans->trans('hello',['John'],null, 'en_GB');
$trans->trans('hello',['John'],null, 'en_US');
```

You can also implement your own loader to connect to your preferred data source. 
You simply have to implement the LoaderInterface interface.


That's all! I hope this helps you ;)