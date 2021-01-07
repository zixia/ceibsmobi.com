<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
$nowtime = date(Y年m月d日H时i分);
@require_once("inc/config.db.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件/

/////////////文章处理

$action = $_GET["action"];
/*
if($action == "add")
{
///////////////////限制权限
if($admin_group != "2")
{
funmessage("javascript:history.go(-1)",$templang['nongroup'],$backtime);
exit;
}
///////////////////限制权限
$articletitle = $_POST["articletitle"];
$content = $_POST["content"];
$articletype = $_POST["articletype"];
$adduser = $admin_name;
$adddate = $nowdate;
if(empty($articletitle) || strlen($content)< 1 || strlen($articletype)< 1)
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
//////////////////////////////////////
$strinto = "insert into {$tablehead}article(art_title,art_content,add_user,art_type,add_date) values ('$articletitle','$content','$adduser','$articletype','$adddate')";
//echo "$strinto";
$resultinto = @mysql_query($strinto,$myconn);
if($resultinto)
{
funmessage("$php_self?main=article_manage",$templang['addsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['adderror'],$backtime);
exit;
}
}
//////////////////////////////////////////////////////
///$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
///////////////////////////////////////////////////
/*
if($action == "del")
{
///////////////////限制权限
if($admin_group != "2")
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
$type_id = "1";
$strdel = "delete from {$tablehead}article where id='$id'";
$resultdel = @mysql_query($strdel,$myconn);
if($resultdel)
{
funmessage("$php_self?main=article_manage",$templang['delsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['delerror'],$backtime);
exit;
}
exit;
}
*/
/*///////////////////////////////////////////////////////////////////////////////////////////////////
//////%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
///                                    编辑文章
//////%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
*/////////////////////////////////////////////////////////////////////////////////////////////////
if($action == "edit")
{
///////防刷新
if(!empty($_COOKIE["refresh"]))
{
funmessage("$php_self?main=single_manage",$templang['nonrefresh'],$backtime);
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
////////////////////////////////////////////////////////
$strsql = "select single_item from {$tablehead}single where id = '$id'";
$ressql = mysql_query($strsql);
$rowsql = mysql_fetch_row($ressql);
$single_name = $rowsql[0];
$strid = "select id from {$tablehead}type where type_name = '$single_name'";
$resid = mysql_query($strid);
$rowid = mysql_fetch_row($resid);
$single_type_id = $rowid[0];
////////////////////////////////////////////////////////
$content = $_POST["content"];
$adduser = $admin_name;
if(strlen($content)< 1)
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
$strup = "UPDATE {$tablehead}single SET type_id='$single_type_id',single_content='$content',single_user='$adduser',single_date='$nowdate' where id =$id";
//echo $strup;
$resultup = @mysql_query($strup,$myconn) or die("错误");
if($resultup)
{
funmessage("$php_self?main=single_manage",$templang['editsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
exit;
}
////////////////
exit;
}
///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
/////////////////////////////////////////////////
setcookie("refresh","");
//////////////////////////////////////////////////////
///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
?>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td height="77" valign="top"><?
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
$query1 = "SELECT COUNT(*) AS amount FROM {$tablehead}single ";
$result1 = @mysql_query($query1, $myconn) or die(mysql_error());
$row1 = @mysql_fetch_array($result1);
$sunnum = $row1['amount'];
$maxnum = 20;  //这里设置每页显示数量。
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
$strsql = "SELECT * FROM {$tablehead}single order by id desc LIMIT $startnum,$maxnum";
$resultsql = @mysql_query($strsql,$myconn);
	  ?>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
        <tr bgcolor="#AEB6FD">
          <td width="5%" height="22" align="center" bgcolor="#206CA6"><strong>编号</strong></td>
          <td width="45%" align="center" bgcolor="#206CA6"><strong>项目名称</strong></td>
          <td width="10%" align="center" bgcolor="#206CA6"><strong>修改用户</strong></td>
          <td width="12%" align="center" bgcolor="#206CA6"><strong>最后修改时间</strong></td>
          <td width="9%" align="center" bgcolor="#206CA6"><strong>是否增加</strong></td>
          <td width="9%" align="center" bgcolor="#206CA6"><strong>编辑次数</strong></td>
          <td width="10%" align="center" bgcolor="#206CA6"><strong>操作</strong></td>
        </tr>
        <?
			  while($row = @mysql_fetch_array($resultsql))
			  {
			  ?>
        <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
          <td height="26" align="center"><? echo $row[0] ?></td>
          <td><? echo $row["single_item"] ?></td>
          <td align="center"><? echo $row["single_user"] ?></td>
          <td align="center"><? echo $row["single_date"] ?></td>
          <td align="center"><? if(empty($row["single_content"]))
		  {
		  echo "未添加内容";
		  }else{
		  echo "已添加内容";
		  }
		  
		  
		   ?></td>
          <td align="center"><? echo $row["edit_time"] ?></td>
          <td align="center">[<a href="<?=$phpself?>?main=single_disposal&action=edit&id=<?=$row[0]?>" >编 辑</a>]</td>
        </tr>
        <? } ?>
        <tr>
          <td height="22" colspan="7" align="center"><?php 
         echo "共计 <font color=\"#ff0000\">$sunnum</font> 条记录&nbsp;&nbsp;";
		 echo "每页显示<font color=\"#ff0000\">".$maxnum."</font>条记录&nbsp;&nbsp;";
		 echo "总共<font color=\"#ff0000\">" .$sunpage. "</font>页&nbsp;&nbsp; "; 
         echo "现在是第 <font color=\"#ff0000\">" .$page. "</font>"."/" .$sunpage." 页 <br>"; 
		//实现 << < 1 2 3 4 5> >> 分页链接
        $pre = $page - 1;//上一页
        $next = $page + 1;//下一页
        $maxpages = 4;//处理分页时 << < 1 2 3 4 > >>显示4页
        $pagepre = 1;//如果当前页面是4，还要显示前$pagepre页，如<< < 3 /4/ 5 6 > >> 把第3页显示出来
        
        if($page != 1) { echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?main=art_manage&'>显示第一页</a> &nbsp;";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=art_manage&page='.$pre."'>上一页</a> &nbsp;";}else{ echo "&nbsp;显示第一页 &nbsp;";
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
        if($pg == $page) echo "<a href=\"".$_SERVER['PHP_SELF']."?main=art_manage&page=$pg\"><font color=\"#ff0000\">$pg</font></a> ";
        else echo "<a href=\"".$_SERVER['PHP_SELF']."?main=art_manage&page=$pg\">$pg</a> ";
        }
        if($page != $sunpage && $sunpage != "0")
        {echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=art_manage&page='.$next."'>下一页</a>&nbsp; ";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=art_manage&page='.$sunpage."'>显示最后一页</a> &nbsp;";}else{echo "&nbsp;下一页&nbsp; ";
        echo "&nbsp;显示最后一页 &nbsp;";}
        ?></td>
        </tr>
    </table></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php")
?></td>
  </tr>
</table>