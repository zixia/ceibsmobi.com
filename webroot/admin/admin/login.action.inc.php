<?
/*////////////////////////////////////////////////////////////
文件生成 ： 2007-03-17
文件性质 ： 登陆处理
编辑： 白月
最后一次更改 ： 2007-04-17  10：30 
还未解决的问题以及需要处理的问题：
*////////////////////////////////////////////////////////////////
$action = $_GET["action"];
//////////////////////////////////////////////////////
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');

///////////////////////////当是安全退出的时候
if($action == "exit")
{
setcookie("{$config_cookie_head}_admin_name","");
setcookie("{$config_cookie_head}_admin_pass","");
setcookie("{$config_cookie_head}_admin_group","");
funmessage("admin.php",$templang['exitsucess'],$backtime);
exit;
}
///////////////////////////当是安全退出的时候
////////////////////重新登陆/////////////
if($action == "relogin")
{
setcookie("{$config_cookie_head}_admin_name","");
setcookie("{$config_cookie_head}_admin_pass","");
setcookie("{$config_cookie_head}_admin_group","");
/////////////////////////////////////先清除COOKIE
$username = trim($_POST["username"]);
$pass = trim($_POST["pass"]);
if(strlen($username)< 1 || strlen($pass)< 1)
{
funmessage("javascript:history.go(-1)",$templang['emptytype'],$backtime);
exit;
}
$user_pass = by_md5($pass,$config_pass_encrypt_time);
//连接数据库！！
@require_once('inc/config.db.php');
$strsql = "select admin_name,admin_pass,admin_group from {$tablehead}admin where admin_name = '$username' and admin_pass = '$user_pass'";
$result = @mysql_query("$strsql",$myconn) or die("数据库请求错误！");
$row = @mysql_num_rows($result);
$rows = @mysql_fetch_array($result);

$group = $rows["admin_group"];
if($row < 1)
{
funmessage("$php_self?main=login",$templang['namepasserror'],$backtime);
exit;
}
else
{
setcookie("{$config_cookie_head}_admin_name","$username");
setcookie("{$config_cookie_head}_admin_pass","$user_pass");
setcookie("{$config_cookie_head}_admin_group","$group");
funmessage("admin.php",$templang['loginsucess'],$backtime);
exit;
}
}

if($actin == "")
{


//////////////////////////////////////////////
$username = trim($_POST["username"]);
$pass = $_POST["pass"];
if(strlen($username)< 1 || strlen($pass)< 1)
{
funmessage("javascript:history.go(-1)",$templang['emptytype'],$backtime);
exit;
}
$user_pass = by_md5($pass,$config_pass_encrypt_time);
//连接数据库！！
//echo $user_pass;
@require_once('inc/config.db.php');
$strsql = "select admin_name,admin_pass,admin_group from {$tablehead}admin where admin_name = '$username' and admin_pass = '$user_pass'";
//echo $strsql;
$result = mysql_query("$strsql",$myconn) or die("数据库请求错误！");
$row = @mysql_num_rows($result);
$rows = @mysql_fetch_array($result);

$group = $rows["admin_group"];
if($row < 1)
{
funmessage("$php_self?main=login",$templang['namepasserror'],$backtime);
exit;
}
else
{
setcookie("{$config_cookie_head}_admin_name","$username");
setcookie("{$config_cookie_head}_admin_pass","$user_pass");
setcookie("{$config_cookie_head}_admin_group","$group");
funmessage("admin.php",$templang['loginsucess'],$backtime);
exit;
}
}
/*
$cookiename = $_COOKIE["adminname"];
$cookiepass = $_COOKIE["adminpass"];
if(empty($cookiename) || empty($cookiepass))
{
noncookie();
exit;
}
*/
?>