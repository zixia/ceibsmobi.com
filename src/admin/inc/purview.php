<?
header("Content-Type:text/html;text/html; charset=$DefaultLang");

$admin_name = $_COOKIE["{$config_cookie_head}_admin_name"];
$admin_pass = $_COOKIE["{$config_cookie_head}_admin_pass"];
$admin_group = $_COOKIE["{$config_cookie_head}_admin_group"];

// logString(__FILE__, "_REQUEST : " . print_r($_REQUEST, 1));

///////////////////////////////////////////////////
$strsql = "select id,admin_name,admin_pass,add_date from {$tablehead}admin where admin_name = '$admin_name' and admin_pass='$admin_pass' and admin_group='$admin_group'";
//echo $strsql;
$result = @mysql_query($strsql,$myconn);
$num = @mysql_num_rows($result);
if($num != "1")
{
	funmessage("admin.php?main=login",$templang['nonlogin'],$backtime);
	exit;
}
///////////认证权限操作类！！！
class judge_group_passport
{
	var $gropu_id;
	var $lang;
	function admin_passport()
	{
		if($this->group_id != 2)
		{
			funmessage("javascript:history.go(-1)",$this->lang,$backtime);
			exit;
		}
	}
	//////超管专一
	//////普通权限设定，(权限为数字越大越高时)当权限小于当前$gp_tp权限，不允许执行！
	function normal_asc_passport($gp_tp)
	{
		if($this->group_id < $gp_tp)
		{
			funmessage("javascript:history.go(-1)",$this->lang,$backtime);
			exit;
		}
	}
	//////普通权限设定，(权限为数字越小越高时)当权限大于当前$gp_tp权限，不允许执行！
	function normal_desc_passport($gp_tp)
	{
		if($this->group_id > $gp_tp)
		{
			funmessage("javascript:history.go(-1)",$this->lang,$backtime);
			exit;
		}
	}
	
}
?>