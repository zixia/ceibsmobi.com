<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
@require_once("inc/config.upload.inc.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件

///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
///
///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
$action = $_GET["action"];
if($action == "upload")
{
///////防刷新
if(!empty($_COOKIE["refresh"]))
{
funmessage("$php_self?main=src_manage",$templang['nonrefresh'],$backtime);
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
$src_url = $_POST["srcurl"];
$src_title = trim($_POST["title"]);
$stat = trim($_POST["stat"]);
$src_type = $_POST["srctype"];
if(empty($stat))
{
$stat = 2;
}
//////////////////////////////////////
///////////////////////////////////////
////////////////////////////////////////////
if(empty($src_title) || empty($src_url) || empty($src_type))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
////
$filename = $_FILES["userfile"]['name'];               //文件名
//////
$stratpoint = strrpos($filename,".");             //扩展名在名字字符串开始的位置！
$lenght = strlen($filename) - $stratpoint;         //扩展名长度
$extname = strtolower(substr($filename,$stratpoint,$lenght));    //获取扩展名
//echo $exname;

if(empty($filename))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
exit;
}
/////
if($extname != ".jpeg" && $extname != ".jpg" && $extname != ".gif" && $extname != ".png")   //////////////设置除这些文件以外不上传！！
{
funmessage("javascript:history.go(-1)",$templang['upimageerror'],$backtime);
exit;
}
////////在上传文件后，加5个随机数
$strport = "1234567890abcdefghijklmnopqrstuvwxyz";
for($i=0;$i<6;$i++)
{
$newname1 .= $strport[rand(0,strlen($strport)-1)];
}
$newname = time().$newname1."$extname";
$alluppath = "$all_up_path"."$newname";
$sqlpath = "$uppath"."$newname";
////////在上传文件后，加5个随机数
//上传获取临时文件名与移动
$tempname = $_FILES["userfile"]['tmp_name'];
if(move_uploaded_file("$tempname","$alluppath"))
{
$strimg = "insert into {$tablehead}src(src_title,src_url,src_img,src_type,add_date,add_user,src_stat) VALUES ('$src_title','$src_url','$sqlpath','$src_type','$nowdate','$admin_name','$stat')";
//echo $strimg;
$result = @mysql_query($strimg) or die("数据库请求出错！请检查");
if($result)
{
funmessage("$php_self?main=src_manage",$templang['upsucess'],$backtime);
mysql_close($myconn);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['uperror'],$backtime);
mysql_close($myconn);
exit;
}
//////////////
}else{
funmessage("javascript:history.go(-1)",$templang['uperror'],$backtime);
exit;
}
//////////////////////////
}
/////////////////////////////////////////////////////////////%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
///                                    删除
//////%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
////////////////////////////////////////////////////////
if($action == "del")
{
///////防刷新
if(!empty($_COOKIE["refresh"]))
{
funmessage("$php_self?main=src_manage",$templang['nonrefresh'],$backtime);
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
//////////////////////////////以下是删除服务器中的图片！
$id = $_GET["id"];
/////判断ID
if(empty($id)&&!ereg("^[0-9]+$",$id))
{
funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
mysql_close();
exit;
}
/////判断ID
$strselect = "select src_img from {$tablehead}src where id='$id'";
$result = @mysql_query($strselect);
$row = @mysql_fetch_array($result);
$imgurl = $row["src_img"];
$filepath = CONFIG_WEB_ROOT."$imgurl";
//echo "$allpath$filename";
unlink("$filepath");
////////////////////////////////////////这里不做是否删除的判断了。这样更简便，其实个人觉得删除与否无所谓

/////////////////////删除数据库中的图片的记录！
$strdel = "delete from {$tablehead}src where id='$id'";
$resultdel = @mysql_query($strdel,$myconn);
if($resultdel)
{
funmessage("$php_self?main=src_manage",$templang['delsucess'],$backtime);
exit;
}else{
funmessage("javascript:history.go(-1)",$templang['delerror'],$backtime);
exit;
}
}

///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
/////////////////////////////////////////////////
setcookie("refresh","");
//////////////////////////////////////////////////////
///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
<tr> 
          <td height="139" valign="top">
		  <?
@require_once("inc/config.db.php");
$query1 = "SELECT COUNT(*) AS amount FROM {$tablehead}src ";
$result1 = @mysql_query($query1, $myconn) or die(mysql_error());
$row1 = @mysql_fetch_array($result1);
$sunnum = $row1['amount'];
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
$strsql = "SELECT * FROM {$tablehead}src order by id desc LIMIT $startnum,$maxnum";
$resultsql = @mysql_query($strsql,$myconn);
	  ?>
		  
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
            <tr bgcolor="#AEB6FD">
              <td width="4%" height="20" align="center" bgcolor="#206CA6"><strong>编号</strong></td>
              <td width="23%" align="center" bgcolor="#206CA6"><strong>链接名称</strong></td>
              <td width="9%" align="center" bgcolor="#206CA6"><strong>添加者</strong></td>
              <td width="11%" align="center" bgcolor="#206CA6"><strong>添加时间</strong></td>
              <td width="29%" align="center" bgcolor="#206CA6"><strong>链接地址</strong></td>
              <td width="15%" align="center" bgcolor="#206CA6"><strong>图片预览</strong></td>
              <td width="9%" align="center" bgcolor="#206CA6"><strong>操作</strong></td>
            </tr>
            <?
			  while($row = @mysql_fetch_array($resultsql))
			  {
			  ?>
            <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
              <td height="35" align="center"><? echo $row[0] ?></td>
              <td><a href="<? echo $row["src_img"] ?>" target="_blank"> <? echo $row["src_title"] ?></a></td>
              <td align="center"><?=$row["add_user"] ?></td>
              <td align="center"><?=$row["add_date"] ?></td>
              <td align="left"><a href="<?=$row["src_url"] ?>" target="_blank"><?=$row["src_url"]?></a></td>
              <td align="center"><a href="<?=CONFIG_WEB_URL.$row["src_img"] ?>" target="_blank"><img border="0" alt="<?=$row["src_title"] ?>" src="<?=CONFIG_WEB_URL.$row["src_img"] ?>" height="38" width="89" ></a></td>
              <td align="center">[<a onclick="return confirm('是否确认?')" href="<?=$php_self?>?main=src_manage&action=del&id=<?=$row[0]?>">删 除</a>]</td>
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
        
        if($page != 1) { echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."'>显示第一页</a> &nbsp;";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?page='.$pre."'>上一页</a> &nbsp;";}else{ echo "&nbsp;显示第一页 &nbsp;";
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
        if($pg == $page) echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$pg\"><font color=\"#ff0000\">$pg</font></a> ";
        else echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$pg\">$pg</a> ";
        }
        if($page != $sunpage && $sunpage != "0")
        {echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?page='.$next."'>下一页</a>&nbsp; ";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?page='.$sunpage."'>显示最后一页</a> &nbsp;";}else{echo "&nbsp;下一页&nbsp; ";
        echo "&nbsp;显示最后一页 &nbsp;";}
        ?></td>
            </tr>
    </table></td>
        </tr>
    </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php");
?></td>
  </tr>
</table>