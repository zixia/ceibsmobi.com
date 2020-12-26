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
logString(__FILE__, "action: " . $action);

$id = $_GET["id"];
$type_name = $_POST["typename"];
if(empty($action))
{
	funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
	exit;
}
/////////////////////////////////////////
if($action == "check")
{
	$id = $_POST["id"];
	$checkbox = $_POST["checkbox"];
	if(empty($checkbox))
	{
		$checkbox = '0';
	}
	$strsql = "UPDATE {$tablehead}type SET type_check='$checkbox' where id = $id ";
	//echo $strsql;
	$resut = @mysql_query($strsql);
	if($resut)
	{
		funmessage("$php_self?main=type&action=article",$templang['editsucess'],$backtime);
		exit;
	}else{
		funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
		exit;
	}
	exit;/////////////////
}
//////////////////////////////////////
if($action == "list")
{
	$list_num = $_POST["idx"];
	$id = $_POST["id"];
	$type_stat = $_GET["stat"];
	$type_shu = $_POST["typeshu"];
	//////////////////////////判断ID
	if(empty($id)&&!ereg("^[0-9]+$",$id))
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}
	if(empty($list_num))
	{
		funmessage("$php_self?main=type&action=article",$templang['emptytype'],$backtime);
		exit;
	}
	if(!ereg("^[0-9]+$","$list_num"))
	{
		funmessage("$php_self?main=type&action=article",$templang['listnumerror'],$backtime);
		exit;
	}
	$strtest = "select id from {$tablehead}type where type_list = $list_num and type_stat = $type_stat and type_shu = $type_shu";
	//echo $strtest;
	$result = @mysql_query($strtest);
	$num = @mysql_num_rows($result);
	if($num >= 1)
	{
		funmessage("$php_self?main=type&action=article",$templang['listnumtong'],$backtime);
		exit;
	}
	$strsql = "UPDATE {$tablehead}type SET type_list = '$list_num' where id = $id ";
	//echo $strsql;
	$resut = @mysql_query($strsql);
	if($resut)
	{
		funmessage("$php_self?main=type&action=article",$templang['editsucess'],$backtime);
		exit;
	}else{
		funmessage("javascript:history.go(-1)",$templang['editerror'],$backtime);
		exit;
	}
	exit;/////////////////
}


/////////////////////////////
if($action == 'artadd')
{
	///////防刷新
	//echo $refreshtime;
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=type&action=article",$templang['nonrefresh'],$backtime);
		exit;
	}

	setcookie("refresh","1",time()+$refreshtime);
	///////防刷新
	///////////////////限制权限
	if($admin_group != "2")
	{
		funmessage("javascript:history.go(-1)",$templang['nongroup'],$backtime);
		exit;
	}
	///////////////////限制权限
	$type_name = $_POST["typename"];
	$type_hypotaxis = $_POST["hypotaxis" ];
	$type_class = $_POST["radio"];
	if($type_class == "5")
	{
		$type_url = $_POST["arturl"];
	}
	if(empty($type_hypotaxis))
	{
		$type_stat = 1;
		$type_shu = 0;
	}else{
		$type_stat = 2;
		$type_shu = $_POST["primarytype"];
	////
	if(empty($type_shu))
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}
	////
	}
	////当选择了是添加子栏目的时候，需要获取主栏目的信息

	if(empty($type_name))
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}
	//////当为主栏目时，可以不选择栏目类型
	//////当为主栏目时，可以不选择栏目类型
	if($type_hypotaxis != "")
	{
		if(empty($type_class))
		{
			funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
			exit;
		}
		$strinto = "insert into {$tablehead}type(type_name,type_stat,type_shu,type_class,type_remark) values ('$type_name','$type_stat','$type_shu','$type_class','$type_url')";
	}else{
		$strinto = "insert into {$tablehead}type(type_name,type_stat,type_shu,type_remark) values ('$type_name','$type_stat','$type_shu','$type_url')";
	}
	//echo $strinto;
	//////当为主栏目时，可以不选择栏目类型
	//////当为主栏目时，可以不选择栏目类型
	//////////////
	//echo $strinto;
	if($type_class == "1")///当选择的是单一的文章时，需要将数据增加到另外的表中。
	{
		$strsingle = "insert into {$tablehead}single(single_item) values ('$type_name')";
		//echo $strsingle;
		$ressingle = mysql_query($strsingle)or die("qqq");
	}
	$resultinto = @mysql_query($strinto,$myconn);
	if($resultinto)
	{
		funmessage("$php_self?main=type&action=article",$templang['addsucess'],$backtime);
		mysql_close();
		exit;
	}else{
		funmessage("$php_self?main=type&action=article",$templang['adderror'],$backtime);
		mysql_close();
		exit;
	}
}


///////////////////////////////////////////////////
if($action == 'artdel')
{
	///////防刷新
	if(!empty($_COOKIE["refresh"]))
	{
		funmessage("$php_self?main=type&action=article",$templang['nonrefresh'],$backtime);
		exit;
	}
	setcookie("refresh","1",time()+$refreshtime);
	///////防刷新
	///////////////////限制权限
	if($admin_group != "2")
	{
		funmessage("javascript:history.go(-1)",$templang['nongroup'],$backtime);
		exit;
	}
	///////////////////限制权限
	/////////////////////存在子栏目时，主栏目不能删除
	$strsql = "select id from {$tablehead}type where type_shu = '$id' and type_stat=2";
	$result = mysql_query($strsql);
	$num = mysql_num_rows($result);
	if($num > 0)
	{
		funmessage("$php_self?main=type&action=article",$templang['deltypeerror'],$backtime);
		exit;
	}
	$strsql = "select type_class,type_name from {$tablehead}type where id='$id'";
	$result = mysql_query($strsql);
	$row = mysql_fetch_row($result);
	$type_class = $row[0];
	$type_name = $row[1];
	////////////////////////存在子栏目时，主栏目不能删除
	$strdel = "delete from {$tablehead}type where id='$id'";
	$resultdel = @mysql_query($strdel,$myconn);
	if($type_class == "1")///当为单一文章模式删除时，还需要删除另外表的数据
	{
		$strsingledel = $strdel = "delete from {$tablehead}single where single_item ='$type_name'";
		$result = mysql_query($strsingledel);
	}
	if($resultdel)
	{
		funmessage("$php_self?main=type&action=article",$templang['delsucess'],$backtime);
		exit;
	}else{
		funmessage("$php_self?main=type&action=article",$templang['delerror'],$backtime);
		exit;
	}
}
/////////////////////////////////////////////////
setcookie("refresh","");
//////////////////////////////////////////////////////
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<?
///////////////////////////////////////////////////////////////////////////下面是界面
if($action == "article")
{
$strsqlselet = "select id,type_name,type_list,type_check,type_shu from {$tablehead}type where type_stat=1 order by type_list";
$resultselet = @mysql_query("$strsqlselet",$myconn);
 ?>    
     <table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
        <tr> 
          <td height="219" valign="top"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" bordercolordark="#FFFFFF" bordercolorlight="#000000" class="tableborder">
            <tr>
              <td height="26" bgcolor="#206CA6"><div id="padding-left"><strong>网站栏目管理</strong></div></td>
            </tr>
            <?
			    while($rows = mysql_fetch_array($resultselet))
				{
			  ?>
            <tr>
              <td height="19">
              <div>
              <div id="padding-left" style="width:221px; float:left; padding:8px;">★ <b><? echo $rows["type_name"]; ?></b>
                  <?="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
              </div>
              <div id="test" style="width:130px; float:left;">
      <form name="form<?=$rows[0]?>" method="post" action="<?=$php_self?>?main=type&action=list&stat=1" style="margin:0px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="58%"><input name="idx" type="text" value="<?=$rows["type_list"] ?>" size="4" maxlength="2">
                  <input type="hidden" name="id" value="<?=$rows[0] ?>">
                  </td>
            <td width="42%"><input type="submit" name="Submit2" value="提交" /></td>
          </tr>
        </table>
      </form>
    </div>
              <div id="test3" style="width:230px; float:left;">
                <form action="<?=$php_self?>?main=type&action=check" method="post" name="form<?=$rows[0]?>" id="form<?=$rows[0]?>" style="margin:0px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="14%">&nbsp;</td>
                      <td width="86%">是否在首页显示
                        <input type="hidden" name="id" value="<?=$rows[0] ?>" />
                        <input type="checkbox" name="checkbox" value="1" <? if($rows["type_check"] == "1"){ echo 'checked="checked"';  }?> />
                          <input type="submit" name="Submit3" value="提交" /></td>
                    </tr>
                  </table>
                </form>
              </div>
              <div style="float:left; padding:8px;">
              [<a onclick="return confirm('是否确认?')" href="<?=$phpself?>?main=type&action=artdel&id=<?=$rows[0]?>" >删 除</a>]</div>
              
              </div>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">
			  <table>
			  <? 
		  $dp_lishu = $rows[0];
		  $strsql2 = "select * from {$tablehead}type where type_stat=2 and type_shu='$dp_lishu' order by type_list";
		  $result2 = @mysql_query("$strsql2",$myconn) or die(mysql_error());
		  while($rows2 = @mysql_fetch_array($result2))
		  {
		  ?>
				<tr>
				<td>
                  <div style="width:100%;">
                  <div style="float:left; width:184px; margin-left:20px;"> ☆ <b>
                    <?=$rows2["type_name"] ?>
                  </b><? echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?> </div>
                  <div id="test2" style="width:130px; float:left; margin-left:40px;">
                    <form action="<?=$php_self?>?main=type&action=list&stat=2" method="post" name="form<?=$rows2[0]?>" id="form<?=$rows2[0]?>" style="margin:0px;">
                      <table width="99%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="54%"><input name="idx" type="text" id="idx" style="margin:0px;" value="<?=$rows2["type_list"] ?>" size="4" maxlength="2" />
                            <input style="margin:0px;" type="hidden" name="id" value="<?=$rows2[0] ?>" /><input type="hidden" name="typeshu" value="<?=$dp_lishu ?>" /></td>
                          <td width="46%"><input name="Submit" type="submit" id="Submit" value="提交" /></td>
                        </tr>
                      </table>
                    </form>
                  </div>
                   <div id="test4" style="width:230px; float:left;">
                     <form action="<?=$php_self?>?main=type&action=check" method="post" name="form<?=$rows[0]?>" id="form<?=$rows[0]?>2" style="margin:0px;">
                       <table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td width="14%">&nbsp;</td>
                           <td width="86%">是否在首页显示
                             <input style="margin:0px;" type="hidden" name="id" value="<?=$rows2[0] ?>" />
                             <input type="checkbox" name="checkbox" <? if($rows2["type_check"] == "1"){ echo 'checked="checked"';  }?> value="1" />
                               <input type="submit" name="Submit4" value="提交" /></td>
                         </tr>
                       </table>
                     </form>
                   </div>
                   <div style="float:left; padding:8px;">
                  [<a onclick="return confirm('是否确认?')" href="<?=$phpself?>?main=type&action=artdel&id=<?=$rows2[0]?>" >删 除</a>]
                  </div>
                  </div>
				  </td>
				  </tr>
              <? } ?>
			  </table>
			  </td>
            </tr>
            <? } ?>
            <tr>
              <td height="19" align="center"></td>
            </tr>
          </table>
          <form name="addsub" method="post" action="<?=$phpself?>?main=type&action=artadd">
            <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
              <tr bgcolor="#AEB6FD">
                <td colspan="2" align="center" bgcolor="#206CA6"> <strong>增加栏目</strong></td>
              </tr>
              <tr>
                <td width="13%" height="27" bgcolor="#FFFFFF">栏目名称：</td>
                <td width="87%" height="27" bgcolor="#FFFFFF"><input name="typename" type="text" size="24" maxlength="20"></td>
              </tr>
              
              <tr>
				<script language="JavaScript" src="inc/hypotaxis.js" type="text/javascript">
				</script>
				<!-- 目前只支持文章类 -->
				<td>
				<input type="hidden" name="radio" value="3">
				</td>
				<!--
                <td height="32" bgcolor="#FFFFFF">栏目类型：</td>
                <td height="32" bgcolor="#FFFFFF">
                 <script language="javascript">
				function bbsurl()
				{
				document.getElementById("arturl").innerHTML = '<input name="arturl" type="text"  size="50" />';
				}
				function othercheck()
				{
				document.getElementById("arturl").innerHTML = '';
				}
				</script>
                <input type="radio" name="radio"  value="1" onclick="othercheck()" />
				单一文章
				<input type="radio" name="radio" value="2" onclick="othercheck()" />
                新闻
                <input type="radio" name="radio" value="3" onclick="othercheck()" />
                文章类
                  
                  <input type="radio" name="radio"  value="4" onclick="othercheck()" />
                  下载
                  <input type="radio" name="radio"  value="5" onclick="othercheck()" />
                  图片
                  <input type="radio" name="radio"  value="6"   onclick="bbsurl()" />
                  论坛栏目</td>
              </tr>
              <tr>
                <td height="32" colspan="2" bgcolor="#FFFFFF"><p>* 单一文章，指只有一页的文章，比如，企业介绍等只需要一张页面就可以介绍的。<br />
                  * 新闻，一个栏目指有多个文章的，比如，企业新闻。<br />
                * 下载，指下载栏目。<br />
                * 图片，指图片栏目。<br />
                * 论坛栏目，指下载栏目指定论坛栏目的地址。</p>                  </td>
				-->
              </tr>
              <tr>
                <td height="32" bgcolor="#FFFFFF">是否子栏目：</td>
                <td height="32" bgcolor="#FFFFFF">
                    <input type="checkbox" name="hypotaxis" id="checkbox" value="1" onclick="getCustomerInfo()" />
                  如果是子栏目，请钩选此框，并在出现的列表中选择主栏目</td>
              </tr>
              <tr>
                <td height="32" bgcolor="#FFFFFF">属于：</td>
                <td height="32" bgcolor="#FFFFFF"><div id="shuyu"></div></td>
              </tr>
			  <!--
              <tr>
                <td height="32" bgcolor="#FFFFFF">连接URL：</td>
                <td height="32" bgcolor="#FFFFFF">
                <div id="arturl"></div>                </td>
              </tr>
			  -->
              <tr>
                <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="增   加"></td>
              </tr>
            </table>
	      </form></td>
        </tr>
    </table>
    <?
	}
	?>
       
    <? 
if($action == "images")
{
$strsqlselet = "select id,type_name from {$tablehead}type where type_id = '3' order by id";
$resultselet = @mysql_query("$strsqlselet",$myconn);
 ?>
     <table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
        <tr> 
          <td height="219" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
              <tr>
                <td width="20%" height="25" bgcolor="#206CA6" align="center"><strong>类别序号</strong></td>
                <td width="34%" align="center" bgcolor="#206CA6"><strong>类别名称</strong></td>
                <td width="46%" align="center" bgcolor="#206CA6"><strong>操&nbsp; 作</strong></td>
              </tr>
              <?
			    while($row = @mysql_fetch_array($resultselet))
				{
			  ?>
              <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
                <td height="19" align="center"><? echo $row[0]; ?></td>
                <td align="center"><? echo $row["type_name"]; ?></td>
                <td align="center">[<a onclick="return confirm('是否确认?')" href="<?=$phpself?>?main=type&action=imgdel&id=<?=$row[0]?>" >删 除</a>]</td>
              </tr>
            <? } ?>
            </table>
		  <form name="addsub" method="post" action="<?=$phpself?>?main=type&action=imgadd">
            <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
              <tr bgcolor="#AEB6FD">
                <td colspan="2" align="center" bgcolor="#206CA6"> <strong>图 片 类 别 增 加</strong></td>
              </tr>
              <tr>
                <td width="18%" height="27" bgcolor="#FFFFFF">类别：</td>
                <td width="82%" height="27" bgcolor="#FFFFFF"><input name="typename" type="text" size="24" maxlength="20"></td>
              </tr>
              
              <tr>
                <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="增   加">                </td>
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