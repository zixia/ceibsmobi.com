<?
function getip()
{
if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])
{
$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
}
elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])
{
$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
}
elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"])
{
$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
}
elseif (getenv("HTTP_X_FORWARDED_FOR"))
{
$ip = getenv("HTTP_X_FORWARDED_FOR");
}
elseif (getenv("HTTP_CLIENT_IP"))
{
$ip = getenv("HTTP_CLIENT_IP");
}
elseif (getenv("REMOTE_ADDR"))
{
$ip = getenv("REMOTE_ADDR");
}
else
{
$ip = "Unknown";
}
return $ip ;
}
//////////////////////////////////////////////
///////////////////////////////////////////////////////
$ip = getip();
$khip = $_COOKIE["khipaaa"];
if($ip != $khip)
{
//echo "€11";
$filepath = "inc/counts.txt";
setcookie("khipaaa","$ip",time()+300);
$fp = fopen("$filepath",r);
$count = fread($fp,filesize("$filepath"));
fclose($fp);
$count += 1;
$fp = fopen("$filepath",w);
fwrite($fp,$count);
fclose($fp);
}
?>