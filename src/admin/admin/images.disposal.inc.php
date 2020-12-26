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
$action = $_GET["action"];
if($action == "add")
{
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td height="219" valign="top"><form action="admin.php?main=img_manage&action=upload" method="post" enctype="multipart/form-data"  name="addsub">
      <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
        <tr bgcolor="#AEB6FD">
          <td colspan="2" align="center" bgcolor="#206CA6"><strong>图 片 新 闻  增 加</strong></td>
        </tr>
        <tr>
          <td width="14%" height="27" bgcolor="#FFFFFF">文件地址：</td>
          <td width="86%" height="27" bgcolor="#FFFFFF"><input name="userfile" type="file" size="40">
            &nbsp;&nbsp;*只能上传.jpg .png .gif格式的图片文档！ </td>
        </tr>
        <tr>
          <td height="32" bgcolor="#FFFFFF">图片说明：</td>
          <td height="32" bgcolor="#FFFFFF"><input name="title" type="text" size="60">
            &nbsp;&nbsp;（如果不需要可以不用填写！）</td>
        </tr>
        <tr>
          <td height="27" bgcolor="#FFFFFF">图片类别：</td>
          <td height="27" bgcolor="#FFFFFF"><?  
		 $strsqlselet = "select id,type_name from {$tablehead}type where type_class = '5' and type_stat='2'";
         $resultselet = mysql_query($strsqlselet);
		
		   ?>
                <select name="imgtype" id="imgtype">
                  <?   
		  while($rowc = @mysql_fetch_array($resultselet))
		  {
		  ?>
                  <option value="<? echo $rowc[0]  ?>"><? echo $rowc["type_name"] ?></option>
                  <? } ?>
              </select></td>
        </tr>
        <tr>
          <td height="27" bgcolor="#FFFFFF">是否首页显示：</td>
          <td height="27" bgcolor="#FFFFFF"><input type="checkbox" name="stat" value="1"></td>
        </tr>
        <tr>
          <td height="27" colspan="2"><strong>图片新闻内容（如果不需要可以不用填写！）</strong></td>
        </tr>
        <tr>
          <td height="480" colspan="2" align="left" valign="top" bgcolor="#FFFFFF"><?
		  require("fckeditor/fckeditor.php");
		  $sBasePath = "fckeditor/" ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('content') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= '' ;
$oFCKeditor->Create() ;
$oFCKeditor->width='1000px';
$oFCKeditor->height='1000px'; ?></td>
        </tr>
        <tr>
          <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="上  传"></td>
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
if($action == "edit")
{
$id = $_GET["id"];
if(empty($id)&&!ereg("^[0-9]+$",$id))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
$strsqlselet = "select * from {$tablehead}img where id=$id";
//echo $strsqlselet;
$resultselet = mysql_query("$strsqlselet",$myconn);
$rows = mysql_fetch_array($resultselet);
//echo $strsqlselet;
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
        <tr> 
          <td height="735" valign="top"><form action="admin.php?main=img_manage&action=edit&&id=<?=$rows[0]?>" method="post" enctype="multipart/form-data"  name="addsub">
            <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
              <tr bgcolor="#AEB6FD">
                <td colspan="2" align="center" bgcolor="#206CA6"> <strong>图 片 新 闻  编 辑</strong></td>
              </tr>
              <tr>
                <td width="14%" height="27" bgcolor="#FFFFFF">文件预览：</td>
                <td width="86%" height="27" bgcolor="#FFFFFF"><img alt="<?=$rows["img_title"]?>" src="<?=CONFIG_WEB_URL.$rows["img_url"] ?>" width="150" height="100"></td>
              </tr>
              
              <tr>
                <td height="32" bgcolor="#FFFFFF">图片说明：</td>
                <td height="32" bgcolor="#FFFFFF"><input name="title" type="text" size="60" value="<?=$rows["img_title"]?>">
                  &nbsp;&nbsp;（如果不需要可以不用填写！）</td>
              </tr>
              <tr>
                <td height="27" bgcolor="#FFFFFF">图片类别：</td>
                <td height="27" bgcolor="#FFFFFF"><?  
		 $strsqlselet = "select id,type_name from {$tablehead}type where type_class = '$array_type[image]' and type_stat='2'";
         $resultselet = @mysql_query($strsqlselet);
		
		   ?>
                  <select name="imgtype1" id="imgtype">
                  <option value="<? echo $rows["img_typeid"]  ?>" selected="selected"><? echo $rows["img_typename"] ?></option>
                    <? 
					  
		  while($rowc = @mysql_fetch_array($resultselet))
		  {
		  ?>
                    <option value="<?=$rowc[0]  ?>"><? echo $rowc["type_name"] ?></option>
                    <? } ?>
                  </select>
                  <?=$rowc[0]?></td>
              </tr>
              <tr>
                <td height="27" bgcolor="#FFFFFF">是否首页显示：</td>
                <td height="27" bgcolor="#FFFFFF">
				<input type="checkbox" name="stat" value="1" <? 
				if($rows["img_stat"] == "1")
				{ ?>
				checked="checked"
				<? } ?>>
				<input type="hidden" name="id" value="<?=$id?>"></td>
              </tr>
              <tr>
                <td height="27" colspan="2">图片新闻内容（如果不需要可以不用填写！）</td>
              </tr>
              <tr>
                <td height="434" colspan="2" align="center" bgcolor="#FFFFFF"><?
				$content = $rows["img_content"];
		  require("fckeditor/fckeditor.php");
		  $sBasePath = "fckeditor/" ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('content') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value= $content ;
$oFCKeditor->Create() ;
$oFCKeditor->width='1000px';
$oFCKeditor->height='1000px'; ?></td>
              </tr>
              <tr>
                <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="提  交"></td>
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