<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
@require_once("inc/config.upload.inc.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件/

////////////////////////////////////////////////
$action = $_GET["action"];
/////////////////////////////////////////////////
if($action == "upload")
{
///////防刷新
if(!empty($_COOKIE["refresh"]))
{
funmessage("$php_self?main=down_manage",$templang['nonrefresh'],$backtime);
exit;
}
setcookie("refresh","1",time()+$refreshtime);
///////防刷新
///////////////////限制权限
if($admin_group < 1)
{
funmessage("javascript:history.go(-1)",$templang['nongroup'],$backtime);
exit;
}
///////////////////限制权限
/////////////////////////上传！！！！
set_time_limit(60);
$filename = $_FILES["userfile"]['name'];                 //文件名
$content = $_POST["content"];
$down_title = trim($_POST["title"]);
$url = trim($_POST["url"]);
$down_typeid = $_POST["downtype"];
$nowdate = date("Y-m-d");
if(empty($down_title))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
//////
if(empty($filename) && empty($url) )
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
if(!empty($filename) && !empty($url))
{
funmessage("javascript:history.go(-1)",$templang['urlfiletong'],$backtime);
exit;
}
/////////////////////////////////////////////当文件域中没有资料，而输入路径栏有数据的时候
////////////////////查询类型中文名称
//////////////////////////////////////
$strsql = "select type_name from {$tablehead}type where id = '$down_typeid'";
//echo $strsql;
$result = mysql_query($strsql);
$row = mysql_fetch_row($result);
$down_typename = $row[0];
////////////////////查询类型中文名称
//////////////////////////////////////////////////
if(empty($filename) && !empty($url))
{
$strimg = "insert into {$tablehead}down(down_title,down_url,down_content,add_date,add_user,down_typeid,down_typename) VALUES ('$down_title','$url','$content','$nowdate','$admin_name','$down_typeid','$down_typename')";
$result = @mysql_query($strimg) or die("数据库请求出错！请检查");
if($result)
{
funmessage("$php_self?main=down_manage",$templang['upsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['uperror'],$backtime);
exit;
}
exit;
}
///////////////////////////////////////////////////////////////////////////////////////上传文件
$exname = strtolower(strrchr("$filename","."));    //获取扩展名
//////////////////////////////////////////////////////////////////////////
if($exname != ".zip" && $exname != ".rar" && $exname != ".doc" && $exname != ".xls" && $exname != ".ppt")   //////////////设置除这些文件以外不上传！！
{
funmessage("javascript:history.go(-1)",$templang['upfileerror'],$backtime);
exit;
}
///////新文件名
///*获取随机数6位
$randstr = "1234567890abcdefghijklmnopqrstuvwxyz";
for($i=1;$i<=6;$i++)
{
$randnum = rand(0,strlen($randstr)-1);
$randname .= $randstr[$randnum];
}
////*////
$newname = time()."$randname"."$exname";
/////////////////////循环/////
////上传
$tempname = $_FILES["userfile"]['tmp_name'];
////移动
if(move_uploaded_file("$tempname","$all_up_path$newname"))
{
////////////////////
$strimg = "insert into {$tablehead}down(down_title,down_url,down_content,add_date,add_user,down_typeid,down_typename) VALUES ('$down_title','$uppath$newname','$content','$nowdate','$admin_name','$down_typeid','$down_typename')";
$result = @mysql_query($strimg) or die("数据库请求出错！请检查");
if($result)
{
funmessage("$php_self?main=down_manage",$templang['upsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['uperror'],$backtime);
exit;
}
//////////////
}
else
{
funmessage("javascript:history.go(-1)",$templang['uperror'],$backtime);
exit;
}
/////////////////循环/////
//////////////////////////
exit;
}
//////////////////////////////////////////
///////////////



/////////////////////////////////////////////
/////////////////////////////////////////////
if($action == "del")
{
///////防刷新
if(!empty($_COOKIE["refresh"]))
{
funmessage("$php_self?main=down_manage",$templang['nonrefresh'],$backtime);
exit;
}
setcookie("refresh","1",time()+$refreshtime);
///////防刷新
///////////////////限制权限
if($admin_group < 1)
{
funmessage("javascript:history.go(-1)",$templang['nongroup'],$backtime);
exit;
}
///////////////////限制权限
$id = $_GET["id"];
//////////////////////////判断ID
if(empty($id)&&!ereg("^[0-9]+$",$id))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
//////////////////
//////////////////////////////以下是删除服务器中的文件！
$strselect = "select down_url from {$tablehead}down where id='$id'";
$result = @mysql_query($strselect);
$row = @mysql_fetch_array($result);
$imgurl = $row["down_url"];
$filename = basename($imgurl);
//echo "$allpath$filename";
unlink("$all_up_path$filename");
////////////////////////////////////////这里不做是否删除的判断了。这样更简便，其实个人觉得删除与否无所谓
$strdel = "delete from {$tablehead}down where id='$id'";
$resultdel = @mysql_query($strdel,$myconn);
if($resultdel)
{
funmessage("$php_self?main=down_manage",$templang['delsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['delerror'],$backtime);
exit;
}
///////////////
exit;
}
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////
setcookie("refresh","");
//////////////////////////////////////////////////////
//////////////////////////////ACTION完成/////////////////////////////////////////////////

$query1 = "SELECT id AS amount FROM {$tablehead}down ";
$result1 = @mysql_query($query1, $myconn) or die(mysql_error());
$sunnum = @mysql_num_rows($result1);
$maxnum = 10;  //这里设置每页显示数量。
$sunpage = ceil($sunnum/$maxnum);
if(!isset($_GET["page"]) || !intval($_GET['page']) || $_GET['page'] > $sunpage) 
{
$page = 1;
}
else
{
$page = $_GET["page"];
}
$startnum = ($page - 1) * $maxnum; //从数据集第$startnum条开始取，注意数据集是从0开始的
$strsql = "SELECT * FROM {$tablehead}down order by id desc LIMIT $startnum,$maxnum";
$resultsql = @mysql_query($strsql,$myconn);
	  ?>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" align="left" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
  <tr>
    <td width="4%" height="19" align="center" bgcolor="#206CA6"><strong>编号</strong></td>
    <td width="40%" align="center" bgcolor="#206CA6"><strong>下载标题</strong></td>
    <td width="9%" align="center" bgcolor="#206CA6"><strong>添加用户</strong></td>
    <td width="9%" align="center" bgcolor="#206CA6"><strong>添加时间</strong></td>
    <td width="8%" align="center" bgcolor="#206CA6"><strong>所属项目</strong></td>
    <td width="8%" align="center" bgcolor="#206CA6"><strong>浏览次数</strong></td>
    <td width="9%" align="center" bgcolor="#206CA6"><strong>下载</strong></td>
    <td width="13%" align="center" bgcolor="#206CA6"><strong>操作</strong></td>
  </tr>
  <?
			  while($row = @mysql_fetch_array($resultsql))
			  {
			  ?>
  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td height="27" align="center"><? echo $row[0] ?></td>
    <td><a href="../show_download.php?id=<?=$row[0]?>" target="_blank"> <? echo $row["down_title"] ?></a></td>
    <td align="center"><? echo $row["add_user"] ?></td>
    <td align="center"><? echo $row["add_date"] ?></td>
    <td align="center"><? echo $row["down_typename"] ?></td>
    <td align="center"><? echo $row["look_time"] ?></td>
    <td align="center"><a href="<? echo CONFIG_WEB_URL.$row["down_url"] ?>" target="_blank">下载</a></td>
    <td align="center">[<a href="<?=$php_self?>?main=down_manage&id=<? echo $row[0]?>&action=del">删 除</a>]</td>
  </tr>
  <? } ?>
  <tr>
    <td height="22" colspan="8" align="center"><?php 
         echo "共计 <font color=\"#ff0000\">$sunnum</font> 条记录&nbsp;&nbsp;";
		 echo "每页显示<font color=\"#ff0000\">".$maxnum."</font>条记录&nbsp;&nbsp;";
		 echo "总共<font color=\"#ff0000\">" .$sunpage. "</font>页&nbsp;&nbsp; "; 
         echo "现在是第 <font color=\"#ff0000\">" .$page. "</font>"."/" .$sunpage." 页 <br>"; 
		//实现 << < 1 2 3 4 5> >> 分页链接
        $pre = $page - 1;//上一页
        $next = $page + 1;//下一页
        $maxpages = 4;//处理分页时 << < 1 2 3 4 > >>显示4页
        $pagepre = 1;//如果当前页面是4，还要显示前$pagepre页，如<< < 3 /4/ 5 6 > >> 把第3页显示出来
        
        if($page != 1) { echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?main=down_manage&'>显示第一页</a> &nbsp;";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=down_manage&page='.$pre."'>上一页</a> &nbsp;";}else{ echo "&nbsp;显示第一页 &nbsp;";
        echo "&nbsp;上一页 &nbsp;";}
        
        if($maxpages>=$sunpage) //如果总记录不足以显示4页
        {$pgstart = 1;$pgend = $sunpage;}//就不所以的页面打印处理
        elseif(($page-$pagepre-1+$maxpages)>$sunpage)//就好像总页数是6，当前是5，则要把之前的3 4 显示出来，而不仅仅是4
        {$pgstart = $sunpage - $maxpages + 1;$pgend = $sunpage;}
        else{
        $pgstart=(($page<=$pagepre)?1:($page-$pagepre));//当前页面是1时，只会是1 2 3 4 > >>而不会是 0 1 2 3 > >>
        $pgend=(($pgstart==1)?$maxpages:($pgstart+$maxpages-1));
        }
        
        for($pg=$pgstart;$pg<=$pgend;$pg++){ //跳转菜单
        if($pg == $page) echo "<a href=\"".$_SERVER['PHP_SELF']."?main=down_manage&page=$pg\"><font color=\"#ff0000\">$pg</font></a> ";
        else echo "<a href=\"".$_SERVER['PHP_SELF']."?main=down_manage&page=$pg\">$pg</a> ";
        }
        if($page != $sunpage && $sunpage != "0")
        {echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=down_manage&page='.$next."'>下一页</a>&nbsp; ";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=down_manage&page='.$sunpage."'>显示最后一页</a> &nbsp;";}else{echo "&nbsp;下一页&nbsp; ";
        echo "&nbsp;显示最后一页 &nbsp;";}
        ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php")
?></td>
  </tr>
</table>
