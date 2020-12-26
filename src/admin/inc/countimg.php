<?
header("Content-type:image/png");
$im = imagecreate(100,25);
$black = imagecolorallocate($im,250,250,250);
$color1 = imagecolorallocate($im,255,0,0);
$filepath1 = "counts.txt";
$fp = fopen("$filepath1",r);
$str = fread($fp,filesize("$filepath1"));
fclose($fp);
$strmaxlen = 12;
$strlen = strlen($str);
$templen = $strmaxlen-$strlen;
$blen = ceil($templen/2);
imagettftext($im,16,0,6*($blen-1),25,$color1,"../images/ALGERINN.TTF","$str");
imagepng($im);
?>