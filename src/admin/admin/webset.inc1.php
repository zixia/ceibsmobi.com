<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
//@require_once("inc/register.php");
@require_once("inc/config.db.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
//echo CONFIG_WEB_ROOT;
$act = $_GET["act"];
if($act == "sub")
{
///////////////////限制权限
if($admin_group != "2")
{
funmessage("javascript:history.go(-1)",$templang['nongroup'],$backtime);
exit;
}
///////////////////限制权限
///////////////////////////////////////////////////////////////
if(!is_writable("inc/config.inc.php"))
{
funmessage("index.php",$templang['nonconfig'],2);
exit;
}
/////////////////////////////////////////////////////////////////////

$db_server = trim($_POST["dbserver"]);
$db_name = trim($_POST["dbname"]);
$table_head = trim($_POST["tablehead"]);
$de_lang = trim($_POST["lang"]);
$config_web_title1 = trim($_POST["webtitle"]);
$register_by = trim($_POST["registerby"]);

/////开始进行数据处理
$fp = fopen('inc/config.inc.php', 'r');
		$configfile = fread($fp, filesize('inc/config.inc.php'));
		fclose($fp);
		//////开始替换
		$configfile = preg_replace("/[$]dbhost\s*\=\s*[\"'].*?[\"']/is", "\$dbhost = '$db_server'", $configfile);
		$configfile = preg_replace("/[$]dbname\s*\=\s*[\"'].*?[\"']/is", "\$dbname = '$db_name'", $configfile);
		$configfile = preg_replace("/[$]tabhead\s*\=\s*[\"'].*?[\"']/is", "\$tablehead = '$table_head'", $configfile);
		$configfile = preg_replace("/[$]DefaultLang\s*\=\s*[\"'].*?[\"']/is", "\$DefaultLang = '$de_lang'", $configfile);
		$configfile = preg_replace("/[$]web_title\s*\=\s*[\"'].*?[\"']/is", "\$config_web_title = '$config_web_title1'", $configfile);
		
		$fp = fopen('inc/config.inc.php', 'w');
		$sucess = fwrite($fp, trim($configfile));
		fclose($fp);
		if($sucess)
		{
		funmessage("$php_self?main=webset",$templang['websetsucess'],$backtime);
		exit;
		}else{
		funmessage("$php_self?main=webset",$templang['webseterror'],10);
		exit;
		}
		///////////////////////////////////////////////
exit;
}
?>
<title><? echo "$config_web_title  -  首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
   <tr>
    <td width="90%" height="15" valign="top">
      <form id="form1" name="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>?main=webset&act=sub">
        <table width="99%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF" class="tableborder">
          <tr>
            <td height="23" colspan="2" bgcolor="#0083B5">数据库连接设置</td>
      </tr>
          <tr>
            <td width="20%" bgcolor="#FFFFFF">数据库服务器：</td>
        <td width="80%" bgcolor="#FFFFFF"><input name="dbserver" type="text" id="dbserver" value="<?=$dbhost ?>" /></td>
      </tr>
          
          
          <tr>
            <td bgcolor="#FFFFFF">数据库名称：</td>
        <td bgcolor="#FFFFFF"><input name="dbname" type="text" value="<?=$dbname ?>" /></td>
      </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="Submit" value="提  交" /></td>
      </tr>
          <tr>
            <td colspan="2" bgcolor="#0083B5">数据库设置</td>
      </tr>
          <tr>
            <td bgcolor="#FFFFFF">表名前缀：</td>
        <td bgcolor="#FFFFFF"><input name="tablehead" type="text" value="<?=$tablehead ?>" /></td>
      </tr>
          <tr>
            <td bgcolor="#FFFFFF">默认字符集：</td>
        <td bgcolor="#FFFFFF"><input name="lang" type="text" value="<?=$DefaultLang ?>" /></td>
      </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit2" type="submit" class="Submit" value="提  交" /></td>
      </tr>
          <tr>
            <td colspan="2" bgcolor="#0083B5">网站基本设置</td>
      </tr>
          <tr>
            <td bgcolor="#FFFFFF">网站标题：</td>
        <td bgcolor="#FFFFFF"><input name="webtitle" type="text" class="inputtxt" value="<?=$config_web_title ?>" size="60" maxlength="40" />     </td>
      </tr>
          
          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit22" type="submit" class="Submit" value="提  交" /></td>
      </tr>
          <tr>
            <td bgcolor="#FFFFFF">注册时间至：</td>
        <td bgcolor="#FFFFFF"><?=$regdatebytimepass ?></td>
      </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
        </table>
  </form>      </td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php")
?></td>
  </tr>
</table>
