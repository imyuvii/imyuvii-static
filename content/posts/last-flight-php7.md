---
title: "Last flight to PHP7"
date: 2017-03-24T13:56:12-05:00
showDate: true
draft: false
tags: ["php","php7"]
---
Eleven years after its 5.0 release, a new major version is finally coming our way!. PHP7 is out, and it’s time to get your code ready. I’ve already started migrating from [5.6 to 7](http://php.net/manual/en/migration70.php), Here is the official document for Migration PHP 5.6 to 7.

But how will this impact your current PHP codebase? What really changed? How safe is it to update? This post will answer these questions and give you a taste of what’s to come with PHP7

#### Performance
The most easily recognizable advantage of the new PHPNG engine is the significant performance improvement. Benchmarks for PHP7 consistently show speeds twice as fast as PHP 5.6 and many times even faster! Although these results are not guaranteed for your project, the benchmarks were tested against major projects, WordPress, so these numbers don’t come from abstract performance tests.

![PHP7 Performance](/posts/images/php7-performance.jpg)

#### New features
##### Scalar type declarations
Scalar type declarations come in two flavours: coercive (default) and strict. The following types for parameters can now be enforced (either coercively or strictly): strings (string), integers (int), floating-point numbers (float), and booleans (bool). They augment the other types introduced in PHP 5: class names, interfaces, array and callable.

```php
<?php
// Coercive mode
function sumOfInts(int ...$ints)
{
    return array_sum($ints);
}
var_dump(sumOfInts(2, '3', 4.1));
```

above example will output:

`int(9)`

##### Return type declarations
Return type declarations specify the type of the value that will be returned from a function.

```php
function arraysSum(array ...$arrays): array
{
    return array_map(function(array $array): int {
        return array_sum($array);
    }, $arrays);
}
print_r(arraysSum([1,2,3], [4,5,6], [7,8,9]));
```

The above example will output:
```
Array
(
    [0] => 6
    [1] => 15
    [2] => 24
)
```

##### Spaceship operator
The spaceship operator is used for comparing two expressions. It returns -1, 0 or 1 when $a is respectively less than, equal to, or greater than $b.

```php 
// Integers
echo 1 <=> 1; // 0
echo 1 <=> 2; // -1
echo 2 <=> 1; // 1
// Floats
echo 1.5 <=> 1.5; // 0
echo 1.5 <=> 2.5; // -1
echo 2.5 <=> 1.5; // 1
 
// Strings
echo "a" <=> "a"; // 0
echo "a" <=> "b"; // -1
echo "b" <=> "a"; // 1
```

##### Constant arrays using _define()_
Array constants can now be defined with define(). In PHP 5.6, they could only be defined with const.

```php
define('FRAMEWORK', [
    'Laravel',
    'Yii',
    'Zend'
]);
echo FRAMEWORK[1];
```

##### Unicode code point escape syntax
```php
echo "\u{aa}";
echo "\u{0000aa}";
echo "\u{9999}";
```

Above example will output:

```sh
ª
ª (same as before but with optional leading 0's)
香
```

##### Filtered _unserialize()_
This feature seeks to provide better security when unserializing objects on untrusted data. It prevents possible code injections by enabling the developer to whitelist classes that can be unserialized.

```php
<?php 
// converts all objects into __PHP_Incomplete_Class object $data = unserialize($foo, ["allowed_classes" => false]);
// converts all objects into __PHP_Incomplete_Class object except those of MyClass and MyClass2
$data = unserialize($foo, ["allowed_classes" => ["MyClass", "MyClass2"]]);
// default behaviour (same as omitting the second argument) that accepts all classes
$data = unserialize($foo, ["allowed_classes" => true]);
```

##### Session options
session_start() now accepts an array of options that override the session configuration directives normally set in php.ini.

These options have also been expanded to support session.lazy_write, which is on by default and causes PHP to only overwrite any session file if the session data has changed, and read_and_close, which is an option that can only be passed to session_start() to indicate that the session data should be read and then the session should immediately be closed unchanged.

For example, to set session.cache_limiter to private and immediately close the session after reading it:

```php 
session_start([
    'cache_limiter' => 'private',
    'read_and_close' => true,
]);
```

##### Other Features
- Class member access on cloning has been added, e.g. (clone $foo)->bar().
- CSPRNG Functions.
- preg_replace_callback_array().
- preg_replace_callback_array().

#### Conclusion

There are quite a few other features added in PHP 7, like unicode support for emoji and international characters.

`echo "\u{1F60D}"; // outputs ?`

But this should give you a taste of what’s changing in PHP.

Another big area that could cause trouble, are features that have been removed. This should really only be an issue if you’re working with an older code base, because the features that have been removed are primarily ones that have been deprecated for a long time. If you’ve been putting off making these necessary changes, the huge advantage in speed with PHP7 should help convince you, or management, to take the time needed to update your code.

For more on deprecated feature check out the [php wiki](https://wiki.php.net/rfc/remove_deprecated_functionality_in_php7).