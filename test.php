<?php


 	include_once('encrypt.php');
 	
 	//require 'sms.php';
 	
 	$whoA = '-wOXj2uD5azJ08GvmJiUbXcha2_MBsIgbCK-QAr2y_c';
 	
 	$sKey = 'iWfAQq7c4a';
 	
 	//$sKey = generateRandomString();

	$converter = new Encryption;
 	
 	//$who = encode($whoA,$sKey);
 	
 	$who = $converter->decode($whoA,$sKey);
 	
 	
 	echo $who;
 	
 	
 	
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


	




?>