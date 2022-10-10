<?php
spl_autoload_register(function($class){
include_once '../classes'.DIRECTORY_SEPARATOR.$class.'.class.php';
});