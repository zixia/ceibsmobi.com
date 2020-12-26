<?
/*////////////////////////////////////////////////////////////
文件生成 ： 2007-03-17
文件性质 ： 主要统计数据增加处理
编辑： 白月
最后一次更改 ： 2007-04-17  10：30 
还未解决的问题以及需要处理的问题：
*////////////////////////////////////////////////////////////////
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
$action = $_GET["action"];
@require_once("inc/templates.lang.php");
@require_once("inc/fun.inc.php");
?>
<title>------LOGIN-------</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<?
if($action=="relogin")
{
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="500" height="240">
	<center>
	<form name="form1" method="post" action="<?=$php_self?>?main=login_action">
      <table width="309" height="98" border="1" align="center" cellpadding="2" cellspacing="0" bordercolordark="#000000" bordercolorlight="#FFFFFF">
        <tr>
          <td height="34" colspan="2" align="center">用 户 登 陆</td>
        </tr>
        <tr>
          <td width="106" height="19" align="center">用户名：</td>
          <td width="278"><input name="username" type="text" class="inputtext"></td>
        </tr>
        <tr>
          <td height="19" align="center">密&nbsp; 码：</td>
          <td><input name="pass" type="password" class="password"></td>
        </tr>
        <tr>
          <td height="24" colspan="2" align="center"><input type="submit" name="Submit" value="登 陆">&nbsp;&nbsp;
            <input type="reset" name="Submit2" value="重 置"></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </form>
	</center>
	</td>
  </tr>
</table>
<?
}
elseif($action == "")
{
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="500" height="240">
	<center>
	<form name="form1" method="post" action="<?=$php_self?>?main=login_action">
      <table width="309" height="98" border="1" align="center" cellpadding="2" cellspacing="0" bordercolordark="#000000" bordercolorlight="#FFFFFF">
        <tr>
          <td height="34" colspan="2" align="center">用 户 登 陆</td>
        </tr>
        <tr>
          <td width="106" height="19" align="center">用户名：</td>
          <td width="278"><input name="username" type="text" class="inputtext"></td>
        </tr>
        <tr>
          <td height="19" align="center">密&nbsp; 码：</td>
          <td><input name="pass" type="password" class="password"></td>
        </tr>
        <tr>
          <td height="24" colspan="2" align="center"><input type="submit" name="Submit" value="登 陆">&nbsp;&nbsp;
            <input type="reset" name="Submit2" value="重 置"></td>
        </tr>
      </table>
    </form>
	</center>
	</td>
  </tr>
</table>
<?
///////////////////////////////////////////////////////////
}else{
funmessage("index.php",$templang['alreadylogin'],$backtime);
exit;
}

?>
