<?
/*////////////////////////////////////////////////////////////
文件生成 ： 2007-03-17
文件性质 ： 主要统计数据增加处理
编辑： 白月
最后一次更改 ： 2007-04-22  23：30 
处理用户名认证方式
还未解决的问题以及需要处理的问题：
*////////////////////////////////////////////////////////////////
require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
require_once('inc/templates.lang.php');
require_once('inc/fun.inc.php');
require_once("inc/fundatajudge.php");
require_once("inc/config.db.php");
/////////////////////////////////////////////////////////////////////////
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
$action = trim($_GET["action"]);

logString(__FILE__, "action: " . $action);

// logString(__FILE__, "_REQUEST : " . print_r($_REQUEST, 1));

//////////////////////////////////
//////*****************edit***************//////
if($action == "edit")
{
	$id = $_REQUEST ["id"];
	judgeid($id); //////判断ID；
	//*//////////&&&&&限制权限&&&&&////////
	$check_group_passport = new judge_group_passport;  
	///引用判断组权限类方法有：超管专一admin_passport()
	//普通倒序权限normal_asc_passport($gp_tp)//(数字越大越高)当权限小于当前$gp_tp权限，不允许执行！
	//普通倒序权限normal_desc_passport($gp_tp)/(数字越小越高)当权限大于当前$gp_tp权限，不允许执行！
	$check_group_passport -> group_id = $admin_group;
	$check_group_passport -> lang = $templang['nongroup'];
	$check_group_passport -> normal_asc_passport(2);  ///强制
	//*//////////&&&&&限制权限&&&&&////////
	$user_name = trim($_POST["username"]);
	$pass = trim($_POST["pass"]);
	$repass = trim($_POST["repass"]);
	$user_group = trim($_POST["group"]);
	$remark = trim($_POST["remark"]);
	$id = $_POST["id"];
	if(strlen($user_name)< 1 || strlen($pass)< 1 || strlen($repass)< 1 || strlen($user_group)< 1)
	{
		funmessage("javascript:history.go(-1)",$templang['nonname'],$backtime);
		mysql_close($myconn);
		exit;
	}
	//////////////////////////////
	if($admin_name == $user_name)
	{
		funmessage("javascript:history.go(-1)",$templang['editnamet'],$backtime);
		mysql_close($myconn);
		exit;
	}
	///////////////////////////测试为空的时候
	if(!judgeusername($user_name))
	{
		funmessage("javascript:history.go(-1)",$templang['userstandard'],$backtime);
		mysql_close($myconn);
		exit;
	}
	if(judgeteshu($pass))
	{
		funmessage("javascript:history.go(-1)",$templang['passwordstandard'],$backtime);
		mysql_close($myconn);
		exit;
	}
	if(judgeteshu($repass))
	{
		funmessage("javascript:history.go(-1)",$templang['passwordstandard'],$backtime);
		mysql_close($myconn);
		exit;
	}
	if($pass != $repass)
	{
		funmessage("javascript:history.go(-1)",$templang['passtesterror'],$backtime);
		mysql_close($myconn);
		exit;
	}
	/////////////////////////////
	$pass = by_md5($pass,$config_pass_encrypt_time);;
	////////////////密码是否一致
	$strsql = "update {$tablehead}admin set admin_pass = '$pass',admin_name = '$user_name',admin_group = '$user_group',admin_remark = '$remark' where id='$id'";
	//echo "$strsql";
	$result = @mysql_query($strsql,$myconn);
	if($result)
	{
		funmessage("$php_self?main=user_manage",$templang['editsucess'],$backtime);
		exit;
	}
	else
	{
		funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
		exit;
	}
}
//////*****************changepass***************//////
////////////////////////////////当是修改密码的时候
if($action == "changepass")
{
	$id = $_REQUEST ["id"];
	logString(__FILE__, "id: $id");

	judgeid($id); //////判断ID；
	//*//////////&&&&&限制权限&&&&&////////
	$check_group_passport = new judge_group_passport;  
	///引用判断组权限类方法有：超管专一admin_passport()
	//普通倒序权限normal_asc_passport($gp_tp)//(数字越大越高)当权限小于当前$gp_tp权限，不允许执行！
	//普通倒序权限normal_desc_passport($gp_tp)/(数字越小越高)当权限大于当前$gp_tp权限，不允许执行！
	$check_group_passport -> group_id = $admin_group;
	$check_group_passport -> lang = $templang['nongroup'];
	$check_group_passport -> normal_asc_passport(2);  ///强制
	//*//////////&&&&&限制权限&&&&&////////
	$ypass = by_md5(trim($_POST["ypass"]),$config_pass_encrypt_time);
	if($ypass != $admin_pass)
	{
		funmessage("javascript:history.go(-1)",$templang['ypasserror'],$backtime);
		exit;
	}
	///////////////////////判断愿密码正确与否
	$pass = trim($_POST["pass"]);
	$repass = trim($_POST["repass"]);
	if(empty($pass) || empty($repass))
	{
		funmessage("javascript:history.go(-1)",$templang['nonpass'],$backtime);
		exit;
	}
	if(judgeteshu($pass))
	{
		funmessage("javascript:history.go(-1)",$templang['passwordstandard'],$backtime);
		exit;
	}
	if(judgeteshu($repass))
	{
		funmessage("javascript:history.go(-1)",$templang['passwordstandard'],$backtime);
		exit;
	}

	if($pass != $repass)
	{
		funmessage("javascript:history.go(-1)",$templang['passtesterror'],$backtime);
		exit;
	}
	$pass = by_md5($pass,$config_pass_encrypt_time);
	///////////////////////////////////////
	$strsql = "update {$tablehead}admin set admin_pass = '$pass' where admin_name = '$admin_name'";
	$result = @mysql_query($strsql,$myconn);
	if($result)
	{
		setcookie("{$config_cookie_head}_admin_pass","$pass");
		funmessage("$php_self?main=user_manage",$templang['passeditsucess'],$backtime);
		exit;
	}
	else
	{
		funmessage("javascript:history.go(-1)",$templang['passediterror'],$backtime);
		exit;
	}
	//////////////////////////////
}
//////*****************changepass***************//////
////////////////////////////////////////
//////*****************delete***************//////
if($action == "del")
{
	//echo $admin_group;
	//*//////////&&&&&限制权限&&&&&////////
	$check_group_passport = new judge_group_passport;  
	///引用判断组权限类方法有：超管专一admin_passport()
	//普通倒序权限normal_asc_passport($gp_tp)//(数字越大越高)当权限小于当前$gp_tp权限，不允许执行！
	//普通倒序权限normal_desc_passport($gp_tp)/(数字越小越高)当权限大于当前$gp_tp权限，不允许执行！
	$check_group_passport -> group_id = $admin_group;
	$check_group_passport -> lang = $templang['nongroup'];
	$check_group_passport -> normal_asc_passport(2);  ///强制
	//*//////////&&&&&限制权限&&&&&////////
	$id = $_REQUEST["id"];
	judgeid($id); //////判断ID；

	$strsql = "select id from {$tablehead}admin where admin_name = '$admin_name'";
	$result = @mysql_query($strsql,$myconn);
	$rows = @mysql_fetch_array($result) or die("错误");

	if($id == $rows[id])
	{
		funmessage("javascript:history.go(-1)",$templang['delself'],$backtime);
		mysql_close($myconn);
		exit;
	}

	$strsql = "delete from {$tablehead}admin where id = $id";
	$result = mysql_query($strsql);
	if($result)
	{
		funmessage("$php_self?main=user_manage",$templang['updatesucess'],$backtime);
	}
	else
	{
		funmessage("javascript:history.go(-1)",$templang['updateerror'],$backtime);
	}
	///////////////
	exit;	
}
//////*****************delete***************//////
////////////////////////
if($action == "add")
{
	//*//////////&&&&&限制权限&&&&&////////
	$check_group_passport = new judge_group_passport;  
	///引用判断组权限类方法有：超管专一admin_passport()
	//普通倒序权限normal_asc_passport($gp_tp)//(数字越大越高)当权限小于当前$gp_tp权限，不允许执行！
	//普通倒序权限normal_desc_passport($gp_tp)/(数字越小越高)当权限大于当前$gp_tp权限，不允许执行！
	$check_group_passport -> group_id = $admin_group;
	$check_group_passport -> lang = $templang['nongroup'];
	$check_group_passport -> normal_asc_passport(2);  ///强制
	//*//////////&&&&&限制权限&&&&&////////

	/*//////////////////限制权限
	if($admin_group != "2")
	{
		funmessage("javascript:history.go(-1)",$templang['nongroup'],$backtime);
		exit;
	}
	*///////////////////限制权限
	$username = trim($_POST["username"]);
	$pass = trim($_POST["pass"]);
	$repass = trim($_POST["repass"]);
	$group = trim($_POST["group"]);
	$remark = trim($_POST["remark"]);
	$add_time = date("Y-m-d");
	////////////////////////////////////数据获取
	if(strlen($username)< 1 || strlen($pass)< 1 || strlen($repass)< 1 || strlen($group)< 1)
	{
		funmessage("javascript:history.go(-1)",$templang['namepasserror'],$backtime);
		exit;
	}
	if(!judgeusername($username))
	{
		funmessage("javascript:history.go(-1)",$templang['userstandard'],$backtime);
		exit;
	}
	if(judgeteshu($pass))
	{
		funmessage("javascript:history.go(-1)",$templang['passwordstandard'],$backtime);
		exit;
	}
	if(judgeteshu($repass))
	{
		funmessage("javascript:history.go(-1)",$templang['passwordstandard'],$backtime);
		exit;
	}
	if($pass != $repass)
	{
		funmessage("javascript:history.go(-1)",$templang['passtesterror'],$backtime);
		exit;
	}
	$user_pass = by_md5($pass,$config_pass_encrypt_time);;
	//连接数据库！！
	$strsqlselect = "select admin_name from {$tablehead}admin where admin_name='$username'";
	$resultselect = @mysql_query("$strsqlselect",$myconn) or die("错误！");
	$num = mysql_num_rows($resultselect);
	//echo $num;
	/////////检查数据是否存在
	if($num > 0)
	{
		funmessage("javascript:history.go(-1)",$templang['nametong'],$backtime);
		exit;
	}
	/////////检查数据是否存在
	///////////////////////////////////////以上是一些数据检查
	$strsql = "insert into {$tablehead}admin(admin_name,admin_pass,admin_group,admin_remark,add_date) VALUES ('$username','$user_pass','$group','$remark','$add_time')";
	$result = @mysql_query("$strsql",$myconn) or die("数据库请求错误！");
	if($result)
	{
		funmessage("$php_self?main=user_manage",$templang['useraddsucess'],$backtime);
	}else{
		funmessage("javascript:history.go(-1)",$templang['useradderror'],$backtime);
	}
	exit;
}
?>