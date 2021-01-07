<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件/
$action = $_GET["action"];
if($action == "add")
{
$danwei = trim($_POST["danwei"]);
$ren = trim($_POST["ren"]);
$tel = trim($_POST["tel"]);
$address = trim($_POST["address"]);
$stat = trim($_POST["stat"]);
if(empty($danwei) || empty($ren) || empty($tel) || empty($address))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
$strsqlin = "insert into {$tablehead}contact (contact_name,contact_person,contact_tel,contact_address,contact_stat) VALUES ('$danwei','$ren','$tel','$address','$stat')";
echo "$strsqlin";
$resultin = @mysql_query($strsqlin);
if($resultin)
{
funmessage("$php_self?main=contact_manage",$templang['addsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['adderror'],$backtime);
exit;
}
///////////
}
/////////////////$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if($action == "del")
{
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
$strdel = "delete from {$tablehead}contact where id='$id'";
$resultdel = @mysql_query($strdel,$myconn);
if($resultdel)
{
funmessage("$php_self?main=contact_manage",$templang['delsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['delerror'],$backtime);
exit;
}
///////////
}
/////////////////$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if($action == "list")
{
$list_num = $_POST["idx"];
$id = $_POST["id"];
//////////////////////////判断ID
if(empty($id)&&!ereg("^[0-9]+$",$id))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
if(empty($list_num))
{
funmessage("$php_self?main=contact_manage",$templang['emptytype'],$backtime);
exit;
}
if(!ereg("^[0-9]+$","$list_num"))
{
funmessage("$php_self?main=contact_manage",$templang['listnumerror'],$backtime);
exit;
}
$strtest = "select * from {$tablehead}contact where idx = $list_num";
$result = @mysql_query($strtest);
$num = @mysql_num_rows($result);
if($num >= 1)
{
funmessage("$php_self?main=contact_manage",$templang['listnumtong'],$backtime);
exit;
}
$strsql = "UPDATE {$tablehead}contact SET idx = '$list_num' where id = $id ";
$resut = @mysql_query($strsql);
if($resut)
{
funmessage("$php_self?main=contact_manage",$templang['editsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
exit;
}
exit;/////////////////
}


/////////////////////////////////////////////////
setcookie("refresh","");
//////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
$query1 = "SELECT COUNT(*) AS amount FROM {$tablehead}contact ";
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
$strsql = "SELECT * FROM {$tablehead}contact order by idx LIMIT $startnum,$maxnum";
//echo $strsql;
$resultsql = @mysql_query($strsql,$myconn);
	  ?>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
  <tr bgcolor="#AEB6FD">
    <td width="6%" height="19" align="center" bgcolor="#206CA6"><strong>编号</strong></td>
    <td width="31%" align="center" bgcolor="#206CA6"><strong>单位</strong></td>
    <td width="15%" align="center" bgcolor="#206CA6"><strong>联系人</strong></td>
    <td width="22%" align="center" bgcolor="#206CA6"><strong>联系电话</strong></td>
    <td width="8%" align="center" bgcolor="#206CA6"><strong>操作</strong></td>
    <td width="18%" align="center" bgcolor="#206CA6">排序</td>
  </tr>
  <?
			  while($row = @mysql_fetch_array($resultsql))
			  {
			  ?>
  <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
    <td height="23" align="center"><?=$row[0] ?></td>
    <td><?=$row["contact_name"] ?></td>
    <td align="center"><? echo $row["contact_person"] ?></td>
    <td align="center"><? echo $row["contact_tel"] ?></td>
    <td align="center">[<a href="<?=$php_self?>?main=contact_manage&id=<?=$row[0]?>&action=del">删 除</a>]</td>
    <td align="center"><div id="test">
      <form name="form<?=$row[0]?>" method="post" action="<?=$php_self?>?main=contact_manage&action=list" class="from">
        <table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="45%"><input name="idx" type="text" value="<?=$row[idx] ?>" size="4" maxlength="2">
                  <input type="hidden" name="id" value="<?=$row[0] ?>"></td>
            <td width="55%"><input type="submit" name="Submit" value="提交"></td>
          </tr>
        </table>
      </form>
    </div></td>
  </tr>
  <? } ?>
  <tr>
    <td height="22" colspan="6" align="center"><?php 
         echo "共计 <font color=\"#ff0000\">$sunnum</font> 条记录&nbsp;&nbsp;";
		 echo "每页显示<font color=\"#ff0000\">".$maxnum."</font>条记录&nbsp;&nbsp;";
		 echo "总共<font color=\"#ff0000\">" .$sunpage. "</font>页&nbsp;&nbsp; "; 
         echo "现在是第 <font color=\"#ff0000\">" .$page. "</font>"."/" .$sunpage." 页 <br>"; 
		 
    
        //实现 << < 1 2 3 4 5> >> 分页链接
        $pre = $page - 1;//上一页
        $next = $page + 1;//下一页
        $maxpages = 4;//处理分页时 << < 1 2 3 4 > >>显示4页
        $pagepre = 1;//如果当前页面是4，还要显示前$pagepre页，如<< < 3 /4/ 5 6 > >> 把第3页显示出来
        
        if($page != 1) { echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."'>显示第一页</a> &nbsp;";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=contact_manage&page='.$pre."'>上一页</a> &nbsp;";}else{ echo "&nbsp;显示第一页 &nbsp;";
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
        if($pg == $page) echo "<a href=\"".$_SERVER['PHP_SELF']."?main=contact_manage&page=$pg\"><font color=\"#ff0000\">$pg</font></a> ";
        else echo "<a href=\"".$_SERVER['PHP_SELF']."?main=contact_manage&page=$pg\">$pg</a> ";
        }
        if($page != $sunpage && $sunpage != "0")
        {echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=contact_manage&page='.$next."'>下一页</a>&nbsp; ";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=contact_manage&page='.$sunpage."'>显示最后一页</a> &nbsp;";}else{echo "&nbsp;下一页&nbsp; ";
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