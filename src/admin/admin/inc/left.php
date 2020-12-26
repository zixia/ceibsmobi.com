<?
@require_once("../../inc/config.inc.php");
?>
<link href="css.css" rel="stylesheet" type="text/css" />
<table width="100" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
  <tr>
    <td align="center" bgcolor="#206CA6"><strong>网 站 管 理</strong></td>
  </tr>
  <!--
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td>版本：V <?=$version?></td>
  </tr>
  -->
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=webset" target="main">网站设置</a><a href="admin_news_type.php"></a></td>
  </tr>
  
  <tr>
    <td width="85" align="center" bgcolor="#206CA6"><strong> 栏 目 选 项</strong></td>
  </tr>
  
  <tr onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=type&action=article" target="main">网站栏目管理</a></td>
  </tr>

<!--
  <tr>
    <td align="center" bgcolor="#206CA6"><strong>单栏目选项</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=single_manage" target="main">单栏目管理</a></td>
  </tr>
-->
  
  <tr>
    <td align="center" bgcolor="#206CA6"><strong>文 章 选 项</strong></td>
  </tr>
  
  <tr onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=article_disposal&action=add" target="main">文章增加</a></td>
  </tr>
  <tr onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=article_manage" target="main">文章管理</a></td>
  </tr>
  
<!--
  <tr> 
    <td align="center" bgcolor="#206CA6"><strong>图 片 选 项</strong></td>
  </tr>
  
  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF"> 
    <td><a href="../../admin.php?main=img_disposal&action=add" target="main">图片新闻增加</a></td>
  </tr>
  
  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF"> 
    <td><a href="../../admin.php?main=img_manage" target="main">图片新闻管理</a></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#206CA6"><strong>下 载 管 理</strong></td>
  </tr>
  <tr onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=down_disposal" target="main">上传文件</a></td>
  </tr>
  <tr onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=down_manage" target="main">下载管理</a></td>
  </tr>
-->
  <tr>
    <td align="center" bgcolor="#206CA6"><strong>成 员 管 理</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=lead_disposal&amp;action=add" target="main">成员增加</a></td>
  </tr>
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=lead_manage" target="main">成员管理</a></td>
  </tr>

<!--
  <tr>
    <td align="center" bgcolor="#206CA6"><strong>通讯录管理</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=contact_disposal" target="main">通讯录增加</a></td>
  </tr>
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=contact_manage" target="main">通讯录管理</a></td>
  </tr>
-->
  <tr>
    <td align="center" bgcolor="#206CA6"><strong>友情链接</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=src_disposal&amp;action=add" target="main">链接增加</a></td>
  </tr>
  <tr bgcolor="#FFFFFF" onmouseover ="this.style.backgroundColor='#F1E6C2'" onmouseout ="this.style.backgroundColor='#ffffff'">
    <td><a href="../../admin.php?main=src_manage" target="main">链接管理</a></td>
  </tr>
  
  <tr> 
    <td align="center" bgcolor="#206CA6"><strong>管 理 选 项</strong></td>
  </tr>

<?
$admin_group = $_COOKIE["{$config_cookie_head}_admin_group"];
// logString(__FILE__, "admin_group: " . $admin_group);
if ($admin_group >= 2) { // 用户管理功能仅超级管理员才能使用 
?>
  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF"> 
    <td><a href="../../admin.php?main=user_manage" target="main">用户管理</a></td>
  </tr>
<? 
} 
?>

  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=login&action=relogin" target="_parent">变更用户</a></td>
  </tr>
  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=user_manage&action=changepass" target="main">修改密码</a></td>
  </tr>
  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td><a href="../../admin.php?main=login_action&action=exit" target="_parent">安全退出</a></td>
  </tr>
</table>

