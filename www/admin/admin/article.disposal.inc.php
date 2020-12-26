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
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<title><? echo "$config_web_title  -  管理首页" ?></title>
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<?
$action = $_GET["action"];
logString(__FILE__, "action: " . $action);

if($action == "add")
{
?>
<script language="javascript" src="inc/item_art.js">

</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
    <td height="77" valign="top">
	<form name="form1" enctype="multipart/form-data" method="post" action="<?=$phpself?>?main=article_manage&action=add">
      <table width="99%" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
        <tr bgcolor="#AEB6FD">
          <td colspan="2" align="center" bgcolor="#D6E0EF"> <strong>文 章 增 加</strong></td>
        </tr>
        <tr>
          <td width="13%" height="27" bgcolor="#FFFFFF">文章标题：</td>
          <td width="87%" height="27" bgcolor="#FFFFFF"><input name="articletitle" type="text" size="80" maxlength="80">
           &nbsp; * 最多100个字符！！</td>
        </tr>
        <tr>
          <td height="32" bgcolor="#FFFFFF">栏目：</td>
          <td height="32" bgcolor="#FFFFFF">
				<?  
				$strsqlselet = "select id,type_name from {$tablehead}type where type_stat='1'";
				// echo $strsqlselet;
				$resultselet = @mysql_query($strsqlselet);
				?>
            <select id="pritype" name="pritype" <!-- onchange="getCustomerInfo()" --> >
            <option selected="selected" value=""></option>
				<?   
				while($rowc = @mysql_fetch_array($resultselet))
				{
				?>
					<option value="<? echo $rowc[0]  ?>"><? echo $rowc["type_name"] ?></option>
				<? 
				}
				?>
            </select>
            <!-- * 如果选择主栏目后如果子栏目没有出现，那么说明子栏目不符合规范！ --> </td>
        </tr>
		<!-- 不考虑子栏目
        <tr>
          <td height="32" bgcolor="#FFFFFF">子栏目：</td>
          <td height="32" bgcolor="#FFFFFF"><div id="sectype"></div></td>
        </tr>
		-->
        
        <tr>
          <td height="350" colspan="2" align="center" bgcolor="#FFFFFF">
		  <?
		  require_once("fckeditor/fckeditor.php");
		  $sBasePath = "fckeditor/" ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('content') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= '' ;
$oFCKeditor->Create() ;
$oFCKeditor->width='100%';
$oFCKeditor->height='100%'; ?>		  </td>
        </tr>
          <!--新增多个附件-->
<!--
        <tr>
          <td height="23" colspan="2">
          
<script language="javascript">
function aa(aid)
{
	var id = aid+1;
	var divnum = "div";
	divnum += aid;
	document.getElementById(divnum).innerHTML = '<input type="file" name="file[]" onchange="aa('+id+')" >&nbsp;&nbsp;&nbsp;&nbsp;描述：&nbsp;<input type="text" name="intro'+aid+'"><div id="div'+id+'"></div>';
	document.getElementById("setnum").innerHTML = '<input type="hidden" name="setnum" value="'+id+'" />';
}
/*
function fileadd()
{
var id = aid+1;
var divnum = "div";
divnum += aid;
document.getElementById(divnum).innerHTML = '<input type="file" name="file'+aid+'" onchange="aa[]" >&nbsp;&nbsp;&nbsp;&nbsp;描述：&nbsp;<input type="text" name="intro'+aid+'"><div id="div'+id+'"></div>';
}
*/
</script>

<div>
      <input type="file" name="file[]" onChange="aa(1)" >&nbsp;&nbsp;&nbsp;&nbsp;描述：
    
    <input type="text" name="intro0">
    
    <div id="div1"></div>
    </div>
    <div id="setnum"></div>

          
          </td>
        </tr>
-->
<!--新增多个附件-->
        <tr>
          <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="增   加">          </td>
        </tr>
      </table>
        </form>    </td>
  </tr>
</table>
<?
}
if($action == "edit")
{
	$id = $_GET["id"];
	if(empty($id)&&!ereg("^[0-9]+$",$id))
	{
		funmessage("javascript:history.go(-1)",$templang['contentempty'],$backtime);
		exit;
	}
	$strsql = "select * from {$tablehead}article where id='$id'";
	$result = @mysql_query($strsql);
	$rowarticle = @mysql_fetch_array($result);
	?>
	<script language="javascript" src="inc/item_art.js">

	</script>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td  height="77" valign="top">
		<form name="form1" method="post" action="<?=$phpself?>?main=article_manage&action=edit&id=<?=$id ?>">
		  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
			<tr bgcolor="#AEB6FD">
			  <td colspan="2" align="center"> 文章编辑</td>
			</tr>
			<tr>
			  <td width="15%" height="27" bgcolor="#FFFFFF">文章标题：</td>
			  <td width="85%" height="27" bgcolor="#FFFFFF"><input name="articletitle" type="text" size="80" maxlength="80" value="<? echo $rowarticle["art_title"]  ?>">
			   &nbsp; * 最多100个字符！！</td>
			</tr>
			<tr>
			  <td height="32" bgcolor="#FFFFFF">修改文章栏目：</td>
			  <td height="32" bgcolor="#FFFFFF">
			  
			  <input type="checkbox" name="checkbox" id="checkbox" value="1" /> 
				* 如果需要修改，请钩选！目前此文章属于 <b><font color="#FF0000"><?=$rowarticle["art_typename"]?></font></b></td>
			</tr>
			<tr>
			  <td height="32" bgcolor="#FFFFFF">栏目：</td>
			  <td height="32" bgcolor="#FFFFFF"><?  
			 $strsqlselet = "select id,type_name from {$tablehead}type where type_stat='1'";
			// echo $strsqlselet;
			 $resultselet = @mysql_query($strsqlselet);
			
			   ?>
				<select id="pritype" name="pritype" <!-- onchange="getCustomerInfo()" --> >
				<option selected="selected" value=""></option>
				  <?   
			  while($rowc = @mysql_fetch_array($resultselet))
			  {
			  ?>
				  <option value="<? echo $rowc[0]  ?>"><? echo $rowc["type_name"] ?></option>
				  <? } ?>
				</select> 
				<!-- * 如果选择主栏目后如果子栏目没有出现，那么说明子栏目不符合规范！ --> </td>
			</tr>
			<!-- 不考虑子栏目
			<tr>
			  <td height="32" bgcolor="#FFFFFF">子栏目：</td>
			  <td height="32" bgcolor="#FFFFFF"><div id="sectype"></div></td>
			</tr>
			-->
			
			<tr>
			  <td height="350" colspan="2" align="center" bgcolor="#FFFFFF">
			  <?
			  require("fckeditor/fckeditor.php");
			  $sBasePath = "fckeditor/" ;
	//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

	$oFCKeditor = new FCKeditor('content') ;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= $rowarticle["art_content"];
	$oFCKeditor->Create() ;
	$oFCKeditor->width='1000px';
	$oFCKeditor->height='1000px'; 


	?>		  </td>
			</tr>
			<tr>
			  <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="修 改">          </td>
			</tr>
		  </table>
			</form>    </td>
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