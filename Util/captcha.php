<?php
session_start();
$random_alpha = md5(rand()); 

// php rand()function generates random interger
$captcha_code = substr($random_alpha, 0, 5);

$_SESSION["captcha_code"] = $captcha_code;

$target_layer = imagecreatetruecolor(89,30);
//imagecreatetruecolor() returns an image identifier representing a black image of the specified size.
$captcha_background = imagecolorallocate($target_layer, 152, 226, 238);//imagecolorallocate() must be called to create each color that is to be used in the image represented by image.
imagefill($target_layer,0,0,$captcha_background);
//for text color
$captcha_text_color = imagecolorallocate($target_layer, 0, 0, 0);
imagestring($target_layer, 8, 9, 5, $captcha_code, $captcha_text_color);//Draws a string at the given coordinates.
header("Content-type:jpeg");//// Output the image
imagejpeg($target_layer);


?>