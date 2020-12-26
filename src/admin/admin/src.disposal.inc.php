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
    <td height="219" valign="top"><form action="admin.php?main=src_manage&action=upload" method="post" enctype="multipart/form-data"  name="addsub">
      <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
        <tr bgcolor="#AEB6FD">
          <td colspan="2" align="center" bgcolor="#206CA6"><strong>友 情 链 接  增 加</strong></td>
        </tr>
        <tr>
          <td width="14%" height="27" bgcolor="#FFFFFF">文件地址：</td>
          <td width="86%" height="27" bgcolor="#FFFFFF"><input name="userfile" type="file" size="40">
            &nbsp;&nbsp;*只能上传.jpg .png .gif格式的图片文档！大小为  170 X 70 等比例！ </td>
        </tr>
        <tr>
          <td height="32" bgcolor="#FFFFFF">链接名称：</td>
          <td height="32" bgcolor="#FFFFFF"><input name="title" type="text" size="60">
           &nbsp; *填写链接的公司或单位的名称</td>
        </tr>
        
        <tr>
          <td height="27" bgcolor="#FFFFFF">链接地址：</td>
          <td height="27" bgcolor="#FFFFFF"><input name="srcurl" type="text" id="srcurl" size="60" />
            &nbsp;
*填写链接的公司或单位的网站地址</td>
        </tr>
        <tr>
          <td height="27" bgcolor="#FFFFFF">链接类别：</td>
          <td height="27" bgcolor="#FFFFFF"><select name="srctype" id="select">
           <option value="1" selected="selected"></option>
            <option value="1">政府门户网站链接</option>
            <option value="2">行业网站链接</option>
            <option value="3">水利水电工程网站</option>
            <option value="4">其他网站链接</option>
          </select>
          </td>
        </tr>
        <tr>
          <td height="27" bgcolor="#FFFFFF">是否首页显示：</td>
          <td height="27" bgcolor="#FFFFFF"><input type="checkbox" name="stat" value="1"></td>
        </tr>
        
        
        <tr>
          <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="提 交"></td>
        </tr>
        <tr>
          <td height="32" colspan="2" bgcolor="#FFFFFF">* 请注意，上传图片的时候，请把图片处理为JPG、GIF、PNG格式，并且将图片大小设置为： 170 X 70 等比例！ </td>
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