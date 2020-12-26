<?
header("Content-type:image/png");
$text = $_GET["text"];
require_once("config.inc.php");
$createimgurl = "../images/type_title.png";
$im = imagecreatefrompng("$createimgurl");
$color3 = imagecolorallocate($im, 8,80,56);
$text = iconv("GB2312","UTF-8",$text);
$ttfurl = "../images/JDJHCU.TTF";
imagettftext($im,11,0,33,17,$color3,"$ttfurl","$text");
imagepng($im);
?>