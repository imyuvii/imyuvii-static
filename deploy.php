<?php
/**
 * Created by PhpStorm.
 * User: Yuvraj Jhala <png625@gmail.com>
 * Date: 20/10/18
 * Time: 5:23 PM
 */
exec("(/var/www/base.sh) 2>&1", $output, $result);

if($result != 0){
    //if $result is different to 0 -> something wrong and display errors
    print_r([$output,$result]);
}else{
    //if $result == 0 -> Should be OK and continue with your code here
    echo 1;
}