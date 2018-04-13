<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 13.04.2018
 * Time: 10:31
 */
<?php
function my_autoloader($class) {
    require( __DIR__ ."/$class.php");
}
spl_autoload_register('my_autoloader');


