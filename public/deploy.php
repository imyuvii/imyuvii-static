<?php
/**
 * Created by PhpStorm.
 * User: Yuvraj Jhala <png625@gmail.com>
 * Date: 20/10/18
 * Time: 5:23 PM
 */
$path = __DIR__ . '/..';
exec("cd $path && sudo git pull origin master", $output,$error);

print('<pre>');
print_r($output);