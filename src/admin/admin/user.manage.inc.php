<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
$action = trim($_GET["action"]);

logString(__FILE__, "action: " . $action);

// logString(__FILE__, "_REQUEST : " . print_r($_REQUEST, 1));

if($action == "changepass")
{
	$strsql = "select id,admin_pass from {$tablehead}admin where admin_name = '$admin_name'";
	$result = @mysql_query($strsql,$myconn);
	$rows = @mysql_fetch_array($result) or die("错误");
	?>
	<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css" />
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	  <!--DWLayoutTable-->
	  <tr>
		<td width="100%" height="312"><form id="form1" name="form1" method="post" action="<?=$phpself?>?main=user_action&action=changepass">
		<center>
		  <table width="389" border="1" align="center" cellpadding="2" cellspacing="0" bordercolordark="#000000" bordercolorlight="#FFFFFF">
			<tr>
			  <td height="28" colspan="2" align="center"><strong>修 改 密 码
				  <input type="hidden" name="id" value="<? echo $rows[0]  ?>">
			  </strong></td>
			</tr>
			
			<tr>
			  <td width="113">请输入原密码：</td>
			  <td width="262"><input name="ypass" type="password" id="password" /></td>
			</tr>
			<tr>
			  <td>请输入新密码：</td>
			  <td><input name="pass" type="password" id="password"></td>
			  </tr>
			<tr>
			  <td>再次输入密码：</td>
			  <td><input name="repass" type="password" id="password" /></td>
			  </tr>
					
			<tr>
			  <td colspan="2" align="center"><input type="submit" name="Submit" value="提 交" /> &nbsp;&nbsp;
				<input type="reset" name="Submit2" value="重 置" /></td>
			</tr>
		  </table>
		</center>
		</form>
		</td>
	  </tr>
	</table>


	<?
	exit;
}

if($action == "user_edit")
{
	$id = $_GET["id"];
	//////////////////////////判断ID
	if(empty($id)&&!ereg("^[0-9]+$",$id))
	{
	funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
	exit;
	}
	//////////////////
	$strsql = "select id,admin_name,admin_pass,admin_group,admin_remark from {$tablehead}admin where id = '$id'";
	$result = @mysql_query($strsql,$myconn);
	$rows = @mysql_fetch_array($result) or die("错误");
	if($rows["admin_group"] > $admin_group )
	{
	funmessageother("javascript:history.go(-1)",$templang['nongroup'],$backtime);
	exit;
	}
	?>
	<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css" />
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	  <!--DWLayoutTable-->
	  <tr>
		<td width="100%" height="312"><form id="form1" name="form1" method="post" action="<?=$phpself?>?main=user_action&action=edit">
		  <table width="389" border="1" align="center" cellpadding="2" cellspacing="0" bordercolordark="#000000" bordercolorlight="#FFFFFF">
			<tr>
			  <td height="28" colspan="2" align="center"><strong>用 户 编 辑
				<input type="hidden" name="id" value="<? echo $rows[0]  ?>">
			  </strong></td>
			</tr>
			<tr>
			  <td width="113">用户名：</td>
			  <td width="262"><input name="username" type="text" class="inputtext" value="<? echo $rows["admin_name"]  ?>"></td>
			</tr>
			
			<tr>
			  <td>请输入新密码：</td>
			  <td><input name="pass" type="password" id="password"></td>
			  </tr>
			<tr>
			  <td>再次输入密码：</td>
			  <td><input name="repass" type="password" id="password" /></td>
			  </tr>
			<tr>
			  <td>选择用户组：</td>
			  <td><select name="group">
			  <option value="<?=$rows["admin_group"]?>" selected="selected"><?
			  if($rows["admin_group"]=="1")
			  {
			  echo "普通管理员";
			  }elseif($rows["admin_group"]=="2"){
			  echo "超级管理员";
			  }else{
			  echo "&nbsp;";
			  }
			  
			  ?></option>
				<option value="1">普通管理员</option>
				<option value="2">超级管理员</option>
			  </select>          </td>
			  </tr>        
			<tr>
			  <td height="27">备注：</td>
			  <td><input name="remark" type="text" value="<?= $rows[admin_remark]?>" size="40" maxlength="40" /></td>
			</tr>
			<tr>
			  <td colspan="2" align="center"><input type="submit" name="Submit" value="提 交" /> &nbsp;&nbsp;
				<input type="reset" name="Submit2" value="重 置" /></td>
			</tr>
		  </table>
			</form>
		</td>
	  </tr>
	</table>

	<?
	exit;
}
?>



<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
 
  <tr>
    <td width="100%" height="248" valign="top"><? // 下面是数据获取内容
	  
	  $strsqlselet = "select id,admin_name,admin_group,admin_remark from {$tablehead}admin order by id";
	  $resultselet = @mysql_query("$strsqlselet",$myconn);
		  ?>
  <table width="100%" height="100%" border="0" align="center" cellpadding="2" cellspacing="0" >
    <tr>
      <td width="100%" height="219" valign="top">
	 <?
	 ////////////////////判断当用户组不是超级用户时看不见用户列表
	  if($admin_group > 1)
	 {
	 
	 ?>
	  
	  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
        <tr>
          <td width="20%" height="19" align="center" bgcolor="#206CA6"><strong>用户名</strong></td>
          <td width="23%" align="center" bgcolor="#206CA6"><strong>权 限</strong></td>
          <td width="41%" align="center" bgcolor="#206CA6"><strong>备 注</strong></td>
          <td width="16%" align="center" bgcolor="#206CA6"><strong>操&nbsp; 作</strong></td>
        </tr>
        <?
		while($rows = @mysql_fetch_array($resultselet))
		{
	    ?>
        <tr onMouseOver ="this.style.backgroundColor='#F1E6C2'" onMouseOut ="this.style.backgroundColor='#ffffff'" bgcolor="#FFFFFF">
          <td height="22" align="center"><? echo $rows["admin_name"]; ?></td>
          <td align="center">
			<? if($rows["admin_group"] == 1)
				{
				echo "普通管理员";
				}
				else 
				{
				echo "超级管理员";
				} ?>
		  </td>
          <td align="center">
			<? if(empty($rows[admin_remark]))
				{
				echo "&nbsp;";
				}
				else 
				{
				echo $rows[admin_remark];
				} ?>
		  </td>
          <td align="center">[<a href="<?=$phpself?>?main=user_manage&amp;id=<?=$rows[0]?>&amp;action=user_edit" >编 辑</a>]
		  [<a onclick="return confirm('是否确认?')" href="<?=$phpself?>?main=user_action&id=<?=$rows[0]?>&action=del">删 除</a>]</td>
        </tr>
        <? } ?>
      </table>
	 <? } ?>
	<form id="form1" name="form1" method="post" action="<?=$phpself?>?main=user_action&action=add">
		  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bordercolorlight="#FFFFFF" bordercolordark="#000000" class="tableborder">
			<tr>
			  <td height="28" colspan="2" align="center" bgcolor="#206CA6"><strong>用 户 增 加</strong></td>
			</tr>
			<tr>
			  <td width="30%" bgcolor="#FFFFFF">用户名：</td>
			  <td width="70%" bgcolor="#FFFFFF"><input name="username" type="text" class="inputtext" /></td>
			</tr>
			<tr>
			  <td bgcolor="#FFFFFF">密&nbsp; 码：</td>
			  <td bgcolor="#FFFFFF"><input name="pass" type="password" class="password" /></td>
			</tr>
			<tr>
			  <td bgcolor="#FFFFFF">再次输入密码：</td>
			  <td bgcolor="#FFFFFF"><input name="repass" type="password" class="password" /></td>
			</tr>
			<tr>
			  <td bgcolor="#FFFFFF">选择用户组：</td>
			  <td bgcolor="#FFFFFF"><select name="group">
				  <option value="1">普通管理员</option>
				  <option value="2">超级管理员</option>
				</select>                  </td>
			</tr>
			<tr>
			  <td height="27" bgcolor="#FFFFFF">备注：</td>
			  <td bgcolor="#FFFFFF"><input name="remark" type="text" size="40" maxlength="40"></td>
			</tr>
			<tr>
			  <td colspan="2" align="center"><input type="submit" name="Submit" value="提 交" />
				&nbsp;&nbsp;
				<input type="reset" name="Submit2" value="重 置" /></td>
			</tr>
		  </table>
		</form>          </td>
	</tr>
  </table></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php")
?></td>
  </tr>
</table>