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
logString(__FILE__, "action: " . $action);

if($action == "add")
{
	///////防刷新
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=article_manage",$templang['nonrefresh'],$backtime);
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
	$articletitle = $_POST["articletitle"];
	$content = mysql_real_escape_string($_POST["content"]);
	$pritype = $_POST["pritype"];
	$sectype = $_POST["sectype"];
	//echo $sectype;
	$adduser = $admin_name;
	$adddate = $nowdate;

	// 允许次级栏目为空
	if (empty($sectype))
	{
		$sectype = 0;
	}
	logString(__FILE__, "sectype: $sectype");

	
	if(empty($articletitle) || strlen($content)< 1 ||empty($pritype))
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}

	//////////////////////////////////////
	$tempTypeId = $sectype;
	if ($tempTypeId == 0)
	{
		$tempTypeId = $pritype;
	}
	
	$strsql = "select type_name,type_class from {$tablehead}type where id = '$tempTypeId'";
	//echo $strsql;
	$result = mysql_query($strsql);
	$row = mysql_fetch_row($result);
	$type_name = $row[0];
	$type_class = $row[1];

	///////////////////////////////////////
	///////////////////////////////////////
	/////////////////////////////当有上传的时候就执行
	$img_stat = 0;
	$setnum = $_POST["setnum"];
	//////////////////////////

	///当有上传的时候就执行
	if(!empty($setnum))
	{
		/////////////////////////////当有上传的时候就执行
		@require_once("inc/config.upload.inc.php");
		$img_stat = 1;   ///当有上传的时候，设置数据库的状态为，有图片
		$i = 0;
		while($_FILES["file"]["name"][$i])
		{
			${intro.$i} = $_POST["intro"."$i"];  
			/////////////////////////////////////////////获取描述
			//echo $i;
			${filename.$i} = $_FILES["file"]["name"][$i]; 
			${tempname.$i} = $_FILES["file"]["tmp_name"][$i];             //文件名
			${filesz.$i} = $_FILES["file"]["size"][$i]; 
			/////////////////////////////////////////////获取默认的文件名作为描述
			if(empty(${intro.$i}))
			{
				$stratpoint = strrpos(${filename.$i},".");         //。在名字字符串开始的位置！
				${intro.$i} = strtolower(substr("${filename.$i}",0,$stratpoint));    //获取文件名
			}
			$allintro .= ${intro.$i}."|";
			/////////////////////////////////////////////获取默认的文件名作为描述
			if(${filesz.$i} == "0")
			{
				funmessage("javascript:history.go(-1)",$templang['upsizeerror'],$backtime);
				exit;
			}

			if(empty(${tempname.$i}) || empty(${filename.$i}))
			{
				funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
				exit;
			}
			$stratpoint = strrpos(${filename.$i},".");             //扩展名在名字字符串开始的位置！
			$lenght = strlen(${filename.$i}) - $stratpoint;         //扩展名长度
			${exname.$i} = strtolower(substr("${filename.$i}",$stratpoint,$lenght));    //获取扩展名
			//echo "";
			if(${"exname$i"} == ".jpeg" || ${"exname$i"} == ".jpg" || ${"exname$i"} == ".gif" || ${"exname$i"} == ".png" || ${"exname$i"} == ".bmp" 
				|| ${"exname$i"} == ".zip"|| ${"exname$i"} == ".rar" 
				|| ${"exname$i"} == ".doc" || ${"exname$i"} == ".xls")   //////////////设置除这些文件以外不上传！！
			{
				$str = "0123456789abcdefghijklmnopqrstuvwxyz";
				for($j=1;$j<=4;$j++)
				{
					${randname.$i} .= $str[rand(0,strlen($str)-1)];
				}
				${newname.$i} = time().${randname.$i}.$i.${exname.$i};

				$imagepath = "$all_up_path"."${newname.$i}";
				//echo "$imagepath"."<br>";
				////////////////////////////////////////////////////
				if(move_uploaded_file("${tempname.$i}","$imagepath"))
				{
					$imgallpath .= "$uppath"."${newname.$i}"."|";
				}else{
					funmessage("javascript:history.go(-1)",$templang['uperror'],$backtime);
					exit;
				}
				///////////////////////////////////////////////
				$i++;
			}else{
				funmessage("javascript:history.go(-1)",$templang['upimageerror'],$backtime);
				exit;
			}
			////////////////////////////////////

		}/////////////////////循环/////

		/////////////////////////////当有上传的时候就执行
	}/////////////////////////////当有上传的时候就执行
	/////////////////////////////当有上传的时候就执行
	$strinto = "insert into {$tablehead}article(art_title,art_content,add_user,art_typeid,art_pritype,art_typename,add_date,art_typeclass,art_imgstat,art_imgurl,art_imgintro) values ('$articletitle','$content','$adduser','$sectype','$pritype','$type_name','$adddate','$type_class','$img_stat','$imgallpath','$allintro')";
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
///////////////////////////////////////////////////////
if($action == "del")
{
	///////防刷新
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=article_manage",$templang['nonrefresh'],$backtime);
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
	//////////////////]
	////////////////////当有附件的时候，删除附件
	$str_fu = "select art_imgstat,art_imgurl from {$tablehead}article where id='$id'";
	$result = mysql_query($str_fu);
	$row = mysql_fetch_row($result);
	if($row[0] == 1) ///当有附件时，删除附件文件
	{
		$img_url = $row[1];
		$arr_url = explode("|",$img_url);
		foreach($arr_url as $del_url)
		{
			$del_path = CONFIG_WEB_ROOT."$del_url";
			@unlink($del_path);
		}
	}
	////////////////////当有附件的时候，删除附件
	//////////////////////////////////////////////
	///////////////////////////////
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
//////////////////////////////////////////////////////
///标记删除和标记恢复
///////////////////////////////////////////////////////
if($action == "mark_del" || $action == "mark_normal")
{
	///////防刷新
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=article_manage",$templang['nonrefresh'],$backtime);
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
	//////////////////]
	if ($action == "mark_del")
	{
		$row_stat = 1;
	}
	else
	{
		$row_stat = 0;
	}
	$strdel = "update {$tablehead}article set row_stat={$row_stat} where id='$id'";
	$resultdel = @mysql_query($strdel,$myconn);
	if($resultdel)
	{
	funmessage("$php_self?main=article_manage",$templang['editsucess'],$backtime);
	exit;
	}else{
	funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
	exit;
	}
	exit;
}
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
		funmessage("$php_self?main=article_manage",$templang['nonrefresh'],$backtime);
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
	$articletitle = $_POST["articletitle"];
	$content = mysql_real_escape_string($_POST["content"]);
	$checkbox = $_POST["checkbox"];
	if($checkbox == "1")  //当钩选需要修改类型时
	{
		$pritype = $_POST["pritype"];
		$sectype = $_POST["sectype"];

		// 允许次级栏目为空
		if (empty($sectype))
		{
			$sectype = 0;
		}
		logString(__FILE__, "sectype: $sectype");

		if(empty($pritype))
		{
			funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
			exit;
		}
	}
	////////////////当钩选需要修改类型时
	$adduser = $admin_name;
	if(empty($articletitle) || strlen($content)< 1)
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}

	if($checkbox == "1")
	{
		//////////////////////////////////////
		$tempTypeId = $sectype;
		if ($tempTypeId == 0)
		{
			$tempTypeId = $pritype;
		}
		
		$strsql = "select type_name,type_class from {$tablehead}type where id = '$tempTypeId'";
		//echo $strsql;
		$result = mysql_query($strsql);
		$row = mysql_fetch_row($result);
		$type_name = $row[0];
		$type_class = $row[1];
		///////////////////////////////////////
		$strup = "UPDATE {$tablehead}article SET art_title='$articletitle',art_content='$content',edit_user='$adduser',add_date='$nowdate',art_typeid ='$sectype',art_pritype='$pritype',art_typename='$type_name', art_typeclass='$type_class' where id =$id";
	}else{
		$strup = "UPDATE {$tablehead}article SET art_title='$articletitle',art_content='$content',edit_user='$adduser' ,add_date='$nowdate' where id =$id";
	}
	$resultup = @mysql_query($strup,$myconn) or die("错误");
	if($resultup)
	{
		funmessage("$php_self?main=article_manage",$templang['editsucess'],$backtime);
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
if ($admin_group <= 1)
{
	$where_clause = ' where row_stat=0 ';
}
$query1 = "SELECT COUNT(*) AS amount FROM {$tablehead}article {$where_clause} ";
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
$strsql = "SELECT * FROM {$tablehead}article {$where_clause} order by id desc LIMIT $startnum,$maxnum";
$resultsql = @mysql_query($strsql,$myconn);
	  ?>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
        <tr bgcolor="#AEB6FD">
          <td width="5%" height="21" align="center" bgcolor="#206CA6"><strong>编号</strong></td>
          <td width="48%" align="center" bgcolor="#206CA6"><strong>文章标题</strong></td>
          <td width="9%" align="center" bgcolor="#206CA6"><strong>添加用户</strong></td>
          <td width="9%" align="center" bgcolor="#206CA6"><strong>新闻类型</strong></td>
          <td width="10%" align="center" bgcolor="#206CA6"><strong>添加时间</strong></td>
          <td width="8%" align="center" bgcolor="#206CA6"><strong>浏览次数</strong></td>
          <td width="11%" align="center" bgcolor="#206CA6"><strong>操作</strong></td>
        </tr>
        <?
			  while($row = @mysql_fetch_array($resultsql))
			  {
			  ?>
        <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
          <td height="26" align="center"><? echo $row[0] ?></td>
          <td><a href="<?=$phpself?>?main=article_disposal&action=edit&id=<?=$row[0]?>" ><? echo $row["art_title"] ?></a></td>
          <td align="center"><? echo $row["add_user"] ?></td>
          <td align="center"><? echo $row["art_typename"] ?></td>
          <td align="center"><? echo $row["add_date"] ?></td>
          <td align="center"><? echo $row["look_time"] ?></td>
          <td align="center">[<a href="<?=$phpself?>?main=article_disposal&action=edit&id=<?=$row[0]?>" >编 辑</a>]
		  <?
			if($row["row_stat"] == 0) // 正常状态，允许删除
			{
				echo "[<a onclick=\"return confirm('是否确认?')\" 
					href=\"{$php_self}?main=article_manage&id={$row[0]}&action=mark_del\">删 除</a>]"; 
			}
			else // 已经标记删除，允许恢复或彻底删除
			{
				echo "[<a onclick=\"return confirm('是否确认?')\" 
					href=\"{$php_self}?main=article_manage&id={$row[0]}&action=mark_normal\">恢 复</a>]<br/>
					[<a onclick=\"return confirm('彻底删除将不可恢复，是否确认?')\" 
					href=\"{$php_self}?main=article_manage&id={$row[0]}&action=del\">彻底删除</a>]";
			}
		  ?>
		  </td>
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
        
        if($page != 1) { echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?main=article_manage&'>显示第一页</a> &nbsp;";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=article_manage&page='.$pre."'>上一页</a> &nbsp;";}else{ echo "&nbsp;显示第一页 &nbsp;";
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
			if($pg == $page) echo "<a href=\"".$_SERVER['PHP_SELF']."?main=article_manage&page=$pg\"><font color=\"#ff0000\">$pg</font></a> ";
			else echo "<a href=\"".$_SERVER['PHP_SELF']."?main=article_manage&page=$pg\">$pg</a> ";
        }
        if($page != $sunpage && $sunpage != "0")
        {echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=article_manage&page='.$next."'>下一页</a>&nbsp; ";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=article_manage&page='.$sunpage."'>显示最后一页</a> &nbsp;";}else{echo "&nbsp;下一页&nbsp; ";
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