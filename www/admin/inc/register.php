<?
///认证文件！！
$regdatebytimepass = '2019-09-10';
$nowdate = date("Y-m-d");
if($regdatebytimepass < $nowdate)
{
funmessageother("$php_self?main=intro",$templang['olddate'],10);
exit;
}
?>