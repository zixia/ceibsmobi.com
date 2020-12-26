<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
$nowtime = date(Y年m月d日H时i分);
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<?
$action = $_GET["action"];
logString(__FILE__, "action: " . $action);

if($action == "add")
{
	?>
	<table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
	  <tr>
		<td height="219" valign="top"><form action="admin.php?main=lead_manage&action=upload" method="post" enctype="multipart/form-data"  name="addsub">
		  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
			<tr bgcolor="#AEB6FD">
			  <td colspan="2" align="center" bgcolor="#206CA6"><strong>增 加 成 员 信 息</strong></td>
			</tr>
			<tr>
			  <td height="32" bgcolor="#FFFFFF">类型：</td>
			  <td height="32" bgcolor="#FFFFFF">
			  <select name="type">
				<option selected="selected" value="0">会员</option>
				<option value="1">顾问</option>
			  </select>
				&nbsp;&nbsp;*填写类型</td>
			</tr>
			<tr>
			  <td height="32" bgcolor="#FFFFFF">姓名：</td>
			  <td height="32" bgcolor="#FFFFFF"><input name="name" type="text" id="name" >
				&nbsp;&nbsp;*填写姓名</td>
			</tr>
			<tr>
			  <td height="27" bgcolor="#FFFFFF">职务：</td>
			  <td height="27" bgcolor="#FFFFFF"><input name="work" type="text" id="work" size="60" />
				&nbsp;*填写单位和职务</td>
			</tr>
			<tr>
			  <td height="27" bgcolor="#FFFFFF">班级：</td>
			  <td height="27" bgcolor="#FFFFFF"><input name="class" type="text" id="work" size="60" />
				&nbsp;填写班级</td>
			</tr>
			<tr>
			  <td width="14%" height="27" bgcolor="#FFFFFF">相片地址：</td>
			  <td width="86%" height="27" bgcolor="#FFFFFF"><input name="userfile" type="file" size="40">
				&nbsp;&nbsp;*只能上传.jpg .png .gif格式的图片文档！ </td>
			</tr>
			<tr>
			  <td width="14%" height="27" bgcolor="#FFFFFF">是否有效：</td>
			  <td width="86%" height="27" bgcolor="#FFFFFF"><input type="checkbox" name="stat" value="1" checked="1"></td>
			</tr>
			
			<tr>
			  <td height="27" colspan="2"><strong>介绍（如果不需要可以不用填写！）</strong></td>
			</tr>
			<tr>
			  <td height="350" colspan="2" align="left" valign="top" bgcolor="#FFFFFF"><?
			  require("fckeditor/fckeditor.php");
			  $sBasePath = "fckeditor/" ;
	//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

	$oFCKeditor = new FCKeditor('content') ;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= '' ;
	$oFCKeditor->Create() ;
	?></td>
			</tr>
			<tr>
			  <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="确  定"></td>
			</tr>
			<tr>
			  <td height="32" colspan="2" bgcolor="#FFFFFF">* 请注意，上传图片的时候，请把图片处理为JPG、GIF、PNG格式，并且将图片大小设置为： 800 X 600 等比例！ </td>
			</tr>
		  </table>
		</form></td>
	  </tr>
	</table>
	<?
} elseif($action == "edit")
{
	$id = $_GET["id"];
	if(empty($id)&&!ereg("^[0-9]+$",$id))
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}
	$strsql = "select * from {$tablehead}lead where id='$id'";
	$result = @mysql_query($strsql);
	$rowdata = @mysql_fetch_array($result);
	?>
	<table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
	  <tr>
		<td height="219" valign="top">
		<form action="admin.php?main=lead_manage&action=edit&id=<?=$id ?>" method="post" enctype="multipart/form-data"  name="editsub">
		  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
			<tr bgcolor="#AEB6FD">
			  <td colspan="2" align="center" bgcolor="#206CA6"><strong>修 改 成 员 信 息</strong></td>
			</tr>
			<tr>
			  <td height="32" bgcolor="#FFFFFF">类型：</td>
			  <td height="32" bgcolor="#FFFFFF">
			  <select name="type">
				<option <? if($rowdata["lead_type"]==0) echo 'selected="selected"'; ?> value="0">会员</option>
				<option <? if($rowdata["lead_type"]==1) echo 'selected="selected"'; ?> value="1">顾问</option>
			  </select>
				&nbsp;&nbsp;*填写类型</td>
			</tr>
			<tr>
			  <td height="32" bgcolor="#FFFFFF">姓名：</td>
			  <td height="32" bgcolor="#FFFFFF"><input name="name" type="text" id="name" value="<?=$rowdata["lead_name"]?>">
				&nbsp;&nbsp;*填写姓名</td>
			</tr>
			<tr>
			  <td height="27" bgcolor="#FFFFFF">职务：</td>
			  <td height="27" bgcolor="#FFFFFF"><input name="work" type="text" id="work" size="60" value="<?=$rowdata["lead_work"]?>">
				&nbsp;*填写单位和职务</td>
			</tr>
			<tr>
			  <td height="27" bgcolor="#FFFFFF">班级：</td>
			  <td height="27" bgcolor="#FFFFFF"><input name="class" type="text" id="work" size="60" value="<?=$rowdata["lead_class"]?>">
				&nbsp;填写班级</td>
			</tr>
			<tr>
			  <td width="14%" height="27" bgcolor="#FFFFFF">相片地址：</td>
			  <td width="86%" height="27" bgcolor="#FFFFFF"><input name="userfile" type="file" size="40"><?=$rowdata["lead_img"] ?>
				&nbsp;&nbsp;*只能上传.jpg .png .gif格式的图片文档！ </td>
			</tr>
			<tr>
			  <td width="14%" height="27" bgcolor="#FFFFFF">是否有效：</td>
			  <td width="86%" height="27" bgcolor="#FFFFFF"><input type="checkbox" name="stat" value="1" 
				<?
					if ($rowdata["stat"] == 1) 
					{
						echo ' checked="1"';
					} 
				?> >
			  </td>
			</tr>
			
			<tr>
			  <td height="27" colspan="2"><strong>介绍（如果不需要可以不用填写！）</strong></td>
			</tr>
			<tr>
			  <td height="350" colspan="2" align="left" valign="top" bgcolor="#FFFFFF"><?
			  require("fckeditor/fckeditor.php");
			  $sBasePath = "fckeditor/" ;
	//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

	$oFCKeditor = new FCKeditor('content') ;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= $rowdata["lead_content"] ;
	$oFCKeditor->Create() ;
	?></td>
			</tr>
			<tr>
			  <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="确  定"></td>
			</tr>
			<tr>
			  <td height="32" colspan="2" bgcolor="#FFFFFF">* 请注意，上传图片的时候，请把图片处理为JPG、GIF、PNG格式，并且将图片大小设置为： 800 X 600 等比例！ </td>
			</tr>
		  </table>
		</form></td>
	  </tr>
	</table>
	<?
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php")
?></td>
  </tr>
</table>