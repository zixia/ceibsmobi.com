<?
include_once('config.inc.php');
$myconn = mysql_connect("$dbhost","$dbuser","$dbpass") or die("数据库连接失败！请检查！");
$select = mysql_select_db("$dbname",$myconn) or die("没有设置的数据库！请检查！");
$mysqlinfo = mysql_get_server_info($myconn);
$mysqlinfo = substr($mysqlinfo,0,2);
if($mysqlinfo > 4.0)
{
@mysql_query("SET NAMES '$DefaultLangDb'") or die("你设置的数据库字符集不正确！请检查！");
}
?>
