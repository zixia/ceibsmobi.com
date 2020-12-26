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
if($action == "edit")
{
$id = $_GET["id"];
if(empty($id)&&!ereg("^[0-9]+$",$id))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
$strsql = "select * from {$tablehead}single where id='$id'";
$result = @mysql_query($strsql);
$rowarticle = @mysql_fetch_array($result);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td  height="77" valign="top"><form name="form1" method="post" action="<?=$phpself?>?main=single_manage&action=edit&id=<?=$id ?>">
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
        <tr bgcolor="#AEB6FD">
          <td colspan="2" align="center"> 文章增加</td>
        </tr>
        <tr>
          <td width="14%" height="27" bgcolor="#FFFFFF">项目标题：</td>
          <td width="86%" height="27" bgcolor="#FFFFFF"><b><? echo $rowarticle["single_item"]  ?></b>
           &nbsp;</td>
        </tr>
        
        <tr>
          <td height="350" colspan="2" align="center" bgcolor="#FFFFFF">
		  <?
		  require("fckeditor/fckeditor.php");
		  $sBasePath = "fckeditor/" ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('content') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $rowarticle["single_content"];
$oFCKeditor->Create() ;
$oFCKeditor->width='1000px';
$oFCKeditor->height='1000px'; 


?>		  </td>
        </tr>
        <tr>
          <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="修 改">          </td>
        </tr>
      </table>
        </form>    </td>
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