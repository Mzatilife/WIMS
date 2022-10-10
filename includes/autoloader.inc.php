<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className){

$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$extension = ".class.php";

if(strpos($url, 'includes')!== false){
   $path = "../classes/";
	}else{
 	$path = "classes/";
 	}

include_once  $path . $className . $extension;

 }

?>