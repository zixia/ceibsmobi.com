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
$point = $_GET["point"];
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
////////******************************************/////////////
///////////////////////point == 1//////////////////////////////
////////******************************************/////////////
if($point == 1)
{
$db_server = trim($_POST["dbserver"]);
$db_name = trim($_POST["dbname"]);
$table_head = trim($_POST["tablehead"]);
$de_lang = trim($_POST["lang"]);
//////////////
	if(empty($db_server) || empty($db_name) || empty($table_head) || empty($de_lang))
	{
		funmessage("$php_self?main=webset",$templang['emptytype'],$backtime);
	}
/////开始进行数据处理
$fp = fopen('inc/config.inc.php', 'r');
		$configfile = fread($fp, filesize('inc/config.inc.php'));
		fclose($fp);
		//////开始替换
		$configfile = preg_replace("/[$]dbhost\s*\=\s*[\"'].*?[\"']/is", "\$dbhost = '$db_server'", $configfile);
		$configfile = preg_replace("/[$]dbname\s*\=\s*[\"'].*?[\"']/is", "\$dbname = '$db_name'", $configfile);
		$configfile = preg_replace("/[$]tabhead\s*\=\s*[\"'].*?[\"']/is", "\$tablehead = '$table_head'", $configfile);
		$configfile = preg_replace("/[$]DefaultLang\s*\=\s*[\"'].*?[\"']/is", "\$DefaultLang = '$de_lang'", $configfile);
		
		
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
}
////////******************************************/////////////
///////////////////////point == 2//////////////////////////////
////////******************************************/////////////
		///////////////////////////////////////////////
		if($point == 2)
		{
			$temp_config_company_name = trim($_POST["companyname"]);
			$temp_config_company_tel = trim($_POST["tel"]);
			$temp_config_company_linkman = trim($_POST["linkman"]);
			$temp_config_company_address = trim($_POST["address"]);
			$temp_config_company_postid = trim($_POST["postid"]);
			$temp_config_company_qq = trim($_POST["qq"]);
			$temp_config_company_msn = trim($_POST["msn"]);
			$temp_config_company_email = trim($_POST["email"]);
			$temp_config_web_title = trim($_POST["webtitle"]);
			/////////////////////////
			$fp = fopen('inc/config.inc.php', 'r');
			$configfile = fread($fp, filesize('inc/config.inc.php'));
			fclose($fp);
	/////////////////////////////开始替换
	$configfile = preg_replace("/[$]config_web_title\s*\=\s*[\"'].*?[\"']/is", "\$config_web_title = '$temp_config_web_title'", $configfile);
	$configfile = preg_replace("/[$]config_company_email\s*\=\s*[\"'].*?[\"']/is", "\$config_company_email = '$temp_config_company_email'", $configfile);
	$configfile = preg_replace("/[$]config_company_name\s*\=\s*[\"'].*?[\"']/is", "\$config_company_name = '$temp_config_company_name'", $configfile);
	$configfile = preg_replace("/[$]config_company_tel\s*\=\s*[\"'].*?[\"']/is", "\$config_company_tel = '$temp_config_company_tel'", $configfile);
	$configfile = preg_replace("/[$]config_company_linkman\s*\=\s*[\"'].*?[\"']/is", "\$config_company_linkman = '$temp_config_company_linkman'", $configfile);
	$configfile = preg_replace("/[$]config_company_address\s*\=\s*[\"'].*?[\"']/is", "\$config_company_address = '$temp_config_company_address'", $configfile);
	$configfile = preg_replace("/[$]config_company_postid\s*\=\s*[\"'].*?[\"']/is", "\$config_company_postid = '$temp_config_company_postid'", $configfile);
	$configfile = preg_replace("/[$]config_company_qq\s*\=\s*[\"'].*?[\"']/is", "\$config_company_qq = '$temp_config_company_qq'", $configfile);
	$configfile = preg_replace("/[$]config_company_msn\s*\=\s*[\"'].*?[\"']/is", "\$config_company_msn = '$temp_config_company_msn'", $configfile);
	///////////*************************///////////////////////
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
	}
////////******************************************/////////////
///////////////////////point == 3//////////////////////////////
////////******************************************/////////////
	if($point == 3)
	{
     $temp_config_key_words = trim($_POST["webkeywords"]);
	 $temp_config_key_description = trim($_POST["webdescription"]);
	 $temp_config_append_title = trim($_POST["appendtitle"]);
	 $temp_config_page_static = trim($_POST["pagestatic"]);
	 /////////////////////////
	$fp = fopen('inc/config.inc.php', 'r');
	$configfile = fread($fp, filesize('inc/config.inc.php'));
	fclose($fp);
	/////////////////////////////开始替换
	$configfile = preg_replace("/[$]config_key_words\s*\=\s*[\"'].*?[\"']/is", "\$config_key_words = '$temp_config_key_words'", $configfile);
	$configfile = preg_replace("/[$]config_key_description\s*\=\s*[\"'].*?[\"']/is", "\$config_key_description = '$temp_config_key_description'", $configfile);
	$configfile = preg_replace("/[$]config_append_title\s*\=\s*[\"'].*?[\"']/is", "\$config_append_title = '$temp_config_append_title'", $configfile);
	$configfile = preg_replace("/[$]config_page_static\s*\=\s*[\"'].*?[\"']/is", "\$config_page_static = '$temp_config_page_static'", $configfile);
///////////*************************///////////////////////
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
	}
////////******************************************/////////////
///////////////////////point == 3结束//////////////////////////////
////////******************************************/////////////
//act==sub
}///act==sub
//act==sub
?>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<script language="javascript">
function subtest()
{
	var truthBeTold = window.confirm("Waring:此修改会影响系统正常的运行！是否要修改？");
if (truthBeTold){
return true;
}else{
return false;
}
}
</script>
  <!--DWLayoutTable-->
   <tr>
    <td width="90%" height="15" valign="top">
      <table width="99%" border="0" align="center" cellpadding="4" cellspacing="1" class="tableborder">
      <form id="form1" name="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>?main=webset&act=sub&point=1">
          <tr>
            <td height="23" colspan="2" bgcolor="#4C4C4C"><img src="<?=$Default_Img_Folder?>/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;">数 据 库 相 关 设 置</span></td>
          </tr>
          <tr>
            <td height="23" colspan="2" bgcolor="#0083B5">&nbsp;<img src="<?=$Default_Img_Folder?>/sj.gif" /> 数据库连接信息</td>
      </tr>
          <tr>
            <td width="20%" bgcolor="#FFFFFF">数据库服务器：</td>
        <td width="80%" bgcolor="#FFFFFF"><b><span class="bluetext"><?=$dbhost ?></span></b></td>
      </tr>
          
          
          <tr>
            <td bgcolor="#FFFFFF">数据库名称：</td>
        <td bgcolor="#FFFFFF"><b><span class="bluetext"><?=$dbname ?></span></b></td>
      </tr>
          <tr>
            <td bgcolor="#FFFFFF">表名前缀：</td>
            <td bgcolor="#FFFFFF"><b><span class="bluetext"><?=$tablehead ?></span></b></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">默认字符集：</td>
            <td bgcolor="#FFFFFF"><b><span class="bluetext"><?=$DefaultLang ?></span></b></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#0083B5">&nbsp;<img src="<?=$Default_Img_Folder?>/sj.gif" />服务器信息</td>
      </tr>
          <tr>
            <td bgcolor="#FFFFFF">PHP版本：</td>
        <td bgcolor="#FFFFFF"><span class="redtextb">PHP <?=PHP_VERSION?></span></td>
      </tr>
          <tr>
            <td bgcolor="#FFFFFF">MYSQL数据库版本：</td>
            <td bgcolor="#FFFFFF"><span class="redtextb"><?=mysql_get_server_info($myconn)?></span></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">当前操作系统：</td>
            <td bgcolor="#FFFFFF"><span class="redtextb"><?=PHP_OS; ?></span></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">当前WEB服务器：</td>
            <td bgcolor="#FFFFFF"><span class="redtextb"><?=$_SERVER['SERVER_SOFTWARE']; ?></span></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">附件大小：</td>
            <td bgcolor="#FFFFFF"><span class="redtextb"><?=get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件"; ?></span></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">执行时间：</td>
            <td bgcolor="#FFFFFF"><span class="redtextb"><?=get_cfg_var("max_execution_time")."秒"; ?></span></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">ZEND 版本：</td>
            <td bgcolor="#FFFFFF"><span class="redtextb"><?=zend_version();?></span></td>
          </tr>
          </form>
          <form id="form2" name="form2" method="post" action="<?=$_SERVER['PHP_SELF']?>?main=webset&act=sub&point=2">
          <tr>
            <td colspan="2" bgcolor="#4c4c4c"><img src="images/tb.gif" style="top:3px; position:relative;" width="14" height="14" /><span class="graytext" style="margin-left:8px;">网 站 信 息 设 置</span></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#0083B5">&nbsp;<img src="<?=$Default_Img_Folder?>/sj.gif" /> 系统基本信息设置</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">系统链接地址:</td>
            <td bgcolor="#FFFFFF"><input name="weburl" type="text" id="textfield4" size="60" readonly="readonly" value="<?=CONFIG_WEB_URL?>" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">公司名称:</td>
            <td bgcolor="#FFFFFF"><input name="companyname" type="text" id="textfield5" value="<?=$config_company_name ?>" size="60" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">系统标题：</td>
            <td bgcolor="#FFFFFF"><input name="webtitle" type="text" class="inputtxt" value="<?=$config_web_title ?>" size="60" maxlength="40" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">联系电话:</td>
            <td bgcolor="#FFFFFF"><input name="tel" type="text" id="textfield6" value="<?=$config_company_tel ?>" size="60" /> 
              <span class="redtext">* 多个以空格隔开 例：028-87888888 13988888888</span></td>
          </tr>
		  <!--
          <tr>
            <td bgcolor="#FFFFFF">联系人</td>
            <td bgcolor="#FFFFFF"><input name="linkman" type="text" id="textfield7" value="<?=$config_company_linkman ?>" size="60" /> </td>
          </tr>
		  -->
          <tr>
            <td bgcolor="#FFFFFF">联系地址</td>
            <td bgcolor="#FFFFFF"><input name="address" type="text" id="textfield8" value="<?=$config_company_address ?>" size="60" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">邮政编码</td>
            <td bgcolor="#FFFFFF"><input name="postid" type="text" id="textfield9" value="<?=$config_company_postid ?>" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Email:</td>
            <td bgcolor="#FFFFFF"><input name="email" type="text" id="textfield10" value="<?=$config_company_email ?>" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">MSN:</td>
            <td bgcolor="#FFFFFF"><input name="msn" type="text" id="textfield11" value="<?=$config_company_msn ?>" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">QQ:</td>
            <td bgcolor="#FFFFFF"><input name="qq" type="text" id="textfield12" value="<?=$config_company_qq ?>" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="提 交" /></td>
          </tr>
          </form>
           <form id="form3" name="form3" method="post" action="<?=$_SERVER['PHP_SELF']?>?main=webset&act=sub&point=3">
          
          <tr>
            <td colspan="2" bgcolor="#0083B5">&nbsp;<img src="<?=$Default_Img_Folder?>/sj.gif" /> 搜索引擎优化设置(如果是管理系统，此功能可以不设置！)</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><strong>Meta Keywords:</strong></td>
            <td bgcolor="#FFFFFF"><input name="webkeywords" type="text" id="textfield" size="60" value="<?=$config_key_words?>" /></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#EFFBFE">Key words 项出现在页面头部的 Meta 标签中，用于记录本页面的关键字，多个关键字间请用半角逗号 &quot;,&quot;   隔开</td>
            </tr>
          <tr>
            <td bgcolor="#FFFFFF"><strong>Meta Description:</strong></td>
            <td bgcolor="#FFFFFF"><input name="webdescription" type="text" id="textfield2" size="60" value="<?=$config_key_description?>" /></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#EFFBFE">Description 出现在页面头部的 Meta 标签中，用于记录本页面的概要与描述</td>
            </tr>
          <tr>
            <td bgcolor="#FFFFFF"><strong>标题附加字:</strong></td>
            <td bgcolor="#FFFFFF"><input name="appendtitle" type="text" id="textfield3" size="60" value="<?=$config_append_title?>"/></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#EFFBFE">网页标题通常是搜索引擎关注的重点，本附加字设置将出现在标题中网站名称的后面，如果有多个关键字，建议用   &quot;|&quot;、&quot;,&quot;(不含引号) 等符号分隔</td>
            </tr>
          <tr>
            <td bgcolor="#FFFFFF">文章静态:</td>
            <td bgcolor="#FFFFFF"><input name="pagestatic" type="radio" id="radio" value="1" checked="checked" />
            不启用<br />
            <input type="radio" name="pagestatic"  value="2" />
            启用</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#EFFBFE">将文章内容模拟成静态页面，以便搜索引擎获取其中的内容。默认为不启用。</td>
            </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="button2" id="button2" value="提 交" /></td>
      </tr>
      </form>
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
