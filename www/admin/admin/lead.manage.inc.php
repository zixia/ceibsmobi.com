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

$action = $_GET["action"];
logString(__FILE__, "action: " . $action);

if($action == "upload")
{
	logString(__FILE__, "upload begin");

	///////防刷新
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=lead_manage",$templang['nonrefresh'],$backtime);
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
	$content = mysql_real_escape_string($_POST["content"]);
	
	$lead_type = trim($_POST["type"]);
	if(empty($lead_type))
	{
		$lead_type = 0;
	}
	
	$lead_name = trim($_POST["name"]);
	$lead_work = trim($_POST["work"]);
	$lead_class = trim($_POST["class"]);
	
	$stat = trim($_POST["stat"]);
	if(empty($stat))
	{
		$stat = 0;
	}

	////////////////////////////////////////////
	if(empty($lead_work) || empty($lead_name) || empty($content))
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
		$strimg = "insert into {$tablehead}lead(lead_type,lead_name,lead_img,lead_work,lead_class,lead_content,add_date,add_user,stat) VALUES ('$lead_type','$lead_name','$sqlpath','$lead_work','$lead_class','$content','$nowdate','$admin_name','$stat')";
		$result = @mysql_query($strimg) or die("数据库请求出错！请检查");
		if($result)
		{
			funmessage("$php_self?main=lead_manage",$templang['upsucess'],$backtime);
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
		funmessage("$php_self?main=lead_manage",$templang['nonrefresh'],$backtime);
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
	$strselect = "select lead_img from {$tablehead}lead where id='$id'";
	$result = @mysql_query($strselect);
	$row = @mysql_fetch_array($result);
	$imgurl = $row["lead_img"];
	$filepath = CONFIG_WEB_ROOT."$imgurl";
	//echo "$allpath$filename";
	unlink("$filepath");
	////////////////////////////////////////这里不做是否删除的判断了。这样更简便，其实个人觉得删除与否无所谓

	/////////////////////删除数据库中的图片的记录！
	$strdel = "delete from {$tablehead}lead where id='$id'";
	$resultdel = @mysql_query($strdel,$myconn);
	if($resultdel)
	{
		funmessage("$php_self?main=lead_manage",$templang['delsucess'],$backtime);
		exit;
	}else{
		funmessage("javascript:history.go(-1)",$templang['delerror'],$backtime);
		exit;
	}
}
// 标记删除和标记恢复
if($action == "mark_del" || $action == "mark_normal")
{
	///////防刷新
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=lead_manage",$templang['nonrefresh'],$backtime);
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
	if ($action == "mark_del")
	{
		$row_stat = 1;
	}
	else
	{
		$row_stat = 0;
	}
	$strdel = "update {$tablehead}lead set row_stat={$row_stat} where id='$id'";
	$resultdel = @mysql_query($strdel,$myconn);
	if($resultdel)
	{
		funmessage("$php_self?main=lead_manage",$templang['editsucess'],$backtime);
		exit;
	}else{
		funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
		exit;
	}
}
if($action == "edit")
{
	logString(__FILE__, "edit begin");

	///////防刷新
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=lead_manage",$templang['nonrefresh'],$backtime);
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

	/////////////////////////上传！！！！
	set_time_limit(60);
	$content = mysql_real_escape_string($_POST["content"]);

	$lead_type = trim($_POST["type"]);
	if(empty($lead_type))
	{
		$lead_type = 0;
	}

	$lead_name = trim($_POST["name"]);
	$lead_work = trim($_POST["work"]);
	$lead_class = trim($_POST["class"]);

	$stat = trim($_POST["stat"]);
	if(empty($stat))
	{
		$stat = 0;
	}

//	logString(__FILE__, "content: " . $content . ", lead_name: " . $lead_name . ", lead_work: " . $lead_work . ", lead_class: " . $lead_class);

	////////////////////////////////////////////
	if(empty($lead_work) || empty($lead_name) || empty($content))
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}
	
	$hasFile = isset($_FILES["userfile"]) && strlen($_FILES["userfile"]['name']) > 0;
	logString(__FILE__, "hasFile: " . $hasFile);
	
	$fileUpdateSql = "";
	
	if ($hasFile)
	{
		////
		$filename = $_FILES["userfile"]['name'];               //文件名
		logString(__FILE__, "filename: " . $filename);
		
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
		
		logString(__FILE__, "alluppath: $alluppath");
		
		$alluppath = "$all_up_path"."$newname";
		$sqlpath = "$uppath"."$newname";
		////////在上传文件后，加5个随机数
		//上传获取临时文件名与移动
		$tempname = $_FILES["userfile"]['tmp_name'];
		move_uploaded_file("$tempname","$alluppath");
		
		logString(__FILE__, "sqlpath: $sqlpath, alluppath: $alluppath");
		
		$fileUpdateSql = ",lead_img='$sqlpath'";
	}
	
	$sqlUpdate = "update {$tablehead}lead set lead_type='$lead_type',lead_name='$lead_name',lead_work='$lead_work',lead_class='$lead_class',stat='$stat',lead_content='$content'"
		.$fileUpdateSql." where id = $id";
	logString(__FILE__, "sqlUpdate: " . $sqlUpdate);
	
	$result = @mysql_query($sqlUpdate) or die("数据库请求出错！请检查");
	if($result)
	{
		funmessage("$php_self?main=lead_manage",$templang['editsucess'],$backtime);
		mysql_close($myconn);
		exit;
	}else{
		funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
		mysql_close($myconn);
		exit;
	}
	//////////////////////////
}
///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
/////////////////////////////////////////////////
setcookie("refresh","");
//////////////////////////////////////////////////////
///////////////文章处理///////////////文章处理///////////////文章处理///////////////文章处理
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css"><table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
<tr> 
          <td height="139" valign="top">
		  <?
@require_once("inc/config.db.php");
if ($admin_group <= 1)
{
	$where_clause = ' where row_stat=0 ';
}
$query1 = "SELECT COUNT(*) AS amount FROM {$tablehead}lead {$where_clause} ";
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
$strsql = "SELECT * FROM {$tablehead}lead {$where_clause} order by id desc LIMIT $startnum,$maxnum";
$resultsql = @mysql_query($strsql,$myconn);
	  ?>
		  
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
            <tr bgcolor="#AEB6FD">
              <td width="5%" height="20" align="center" bgcolor="#206CA6"><strong>编号</strong></td>
              <td width="5%" align="center" bgcolor="#206CA6"><strong>类型</strong></td>
              <td width="5%" align="center" bgcolor="#206CA6"><strong>姓名</strong></td>
              <td width="20%" align="center" bgcolor="#206CA6"><strong>职务</strong></td>
              <td width="15%" align="center" bgcolor="#206CA6"><strong>班级</strong></td>
              <td width="12%" align="center" bgcolor="#206CA6"><strong>添加时间</strong></td>
              <!-- <td width="8%" align="center" bgcolor="#206CA6"><strong>浏览次数</strong></td> -->
              <td width="8%" align="center" bgcolor="#206CA6"><strong>是否有效</strong></td>
              <td width="15%" align="center" bgcolor="#206CA6"><strong>照片预览</strong></td>
              <td width="15%" align="center" bgcolor="#206CA6"><strong>操作</strong></td>
            </tr>
            <?
			  while($row = @mysql_fetch_array($resultsql))
			  {
			  ?>
				<tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
				  <td height="35" align="center"><? echo $row[0] ?></td>
				  <td align="center"><? if($row["lead_type"]==0) echo '会员'; else echo '<font color="red">顾问</font>'; ?></td>
				  <td><a href="<?=$phpself?>?main=lead_disposal&action=edit&id=<?=$row[0]?>"> <? echo $row["lead_name"] ?></a></td>
				  <td align="center"><? echo $row["lead_work"] ?></td>
				  <td align="center"><? echo $row["lead_class"] ?></td>
				  <td align="center"><? echo $row["add_date"] ?></td>
				  <!-- <td align="center"><? echo $row["look_time"] ?></td> -->
				  <td align="center">
				  <?
					if ($row["stat"] == 1)
					{
						echo '是';
					}
					else
					{
						echo '<font color="red">否</font>';
					}
				  ?>
				  </td>
				  <td align="center"><a href="<?=CONFIG_WEB_URL.$row["lead_img"] ?>" target="_blank"><img border="0" alt="<?=$row["lead_name"] ?>" src="<?=CONFIG_WEB_URL.$row["lead_img"] ?>" height="100" width="80" /></a></td>
				  <td align="center">
				  <?
					if($row["row_stat"] == 0) // 正常状态，允许删除
					{
						echo "[<a onclick=\"return confirm('是否确认?')\" 
							href=\"{$php_self}?main=lead_manage&action=mark_del&id={$row[0]}\">删 除</a>]";
					}
					else // 已经标记删除，允许恢复或彻底删除
					{
						echo "[<a onclick=\"return confirm('是否确认?')\" 
							href=\"{$php_self}?main=lead_manage&action=mark_normal&id={$row[0]}\">恢 复</a>]
							[<a onclick=\"return confirm('彻底删除将不可恢复，是否确认?')\" 
							href=\"{$php_self}?main=lead_manage&action=del&id={$row[0]}\">彻底删除</a>]";
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
        
        if($page != 1) { echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?main=lead_manage'>显示第一页</a> &nbsp;";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=lead_manage&page='.$pre."'>上一页</a> &nbsp;";}else{ echo "&nbsp;显示第一页 &nbsp;";
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
        if($pg == $page) echo "<a href=\"".$_SERVER['PHP_SELF']."?main=lead_manage&page=$pg\"><font color=\"#ff0000\">$pg</font></a> ";
        else echo "<a href=\"".$_SERVER['PHP_SELF']."?main=lead_manage&page=$pg\">$pg</a> ";
        }
        if($page != $sunpage && $sunpage != "0")
        {echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=lead_manage&page='.$next."'>下一页</a>&nbsp; ";
        echo "&nbsp;<a href='".$_SERVER['PHP_SELF'].'?main=lead_manage&page='.$sunpage."'>显示最后一页</a> &nbsp;";}else{echo "&nbsp;下一页&nbsp; ";
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