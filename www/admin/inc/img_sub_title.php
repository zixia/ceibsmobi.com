<?
header("Content-type:image/png");
$text = $_GET["text"];
require_once("config.inc.php");
$createimgurl = "../images/sub_title.png";
$im = imagecreatefrompng("$createimgurl");
$color2 = imagecolorallocate($im, 8,55,56);
$text = iconv("GB2312","UTF-8",$text);
$ttfurl = "../images/JDJHCU.TTF";
imagettftext($im,11,0,60,23,$color2,"$ttfurl","$text");
imagepng($im);
?>