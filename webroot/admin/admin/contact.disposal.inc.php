<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件/

$strsqlselet = "select id,type_name from {$tablehead}type where type_id = '1' order by id";
$resultselet = @mysql_query("$strsqlselet",$myconn);
 ?>
 <link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<form action="<?=$php_self?>?main=contact_manage&action=add" method="post"  name="addsub">
            <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
              <tr bgcolor="#AEB6FD">
                <td colspan="2" align="center" bgcolor="#206CA6"> <strong>通 讯 录 增 加</strong></td>
              </tr>
              <tr>
                <td width="14%" height="27" bgcolor="#FFFFFF">姓名/单位名称：</td>
                <td width="86%" height="27" bgcolor="#FFFFFF"><input name="danwei" type="text" size="40">                  &nbsp;&nbsp;</td>
              </tr>
              
              <tr>
                <td height="32" bgcolor="#FFFFFF">联系人：</td>
                <td height="32" bgcolor="#FFFFFF"><input type="text" name="ren"></td>
              </tr>
              <tr>
                <td height="27" bgcolor="#FFFFFF">联系电话：</td>
                <td height="27" bgcolor="#FFFFFF"><input type="text" name="tel"></td>
              </tr>
              <tr>
                <td height="27" bgcolor="#FFFFFF">联系地址：</td>
                <td height="27" bgcolor="#FFFFFF"><input name="address" type="text" id="address" /></td>
              </tr>
              <tr>
                <td height="27" bgcolor="#FFFFFF">是否首页显示：</td>
                <td height="27" bgcolor="#FFFFFF"><input type="checkbox" name="stat" value="1"></td>
              </tr>
              
              
              <tr>
                <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="提  交"></td>
              </tr>
            </table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php")
?></td>
  </tr>
</table>