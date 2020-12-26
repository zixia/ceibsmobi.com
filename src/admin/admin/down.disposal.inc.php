<?
@require_once("inc/config.inc.php");
in_include(); ///判断是否是直接打开的页面
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件/
$strsqlselet = "select id,type_name from {$tablehead}type where type_stat = '1' order by id";
$resultselet = @mysql_query("$strsqlselet",$myconn);
 ?>
 <link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
<form action="<?=$phpself?>?main=down_manage&action=upload" enctype="multipart/form-data" method="post"  name="addsub">
            <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bordercolorlight=#000000 bordercolordark=#FFFFFF class="tableborder">
              <tr bgcolor="#AEB6FD">
                <td colspan="2" align="center" bgcolor="#206CA6"> <strong>文 件 上 传</strong></td>
              </tr>
              <tr>
                <td width="14%" height="27" bgcolor="#FFFFFF"><strong>上传地址：</strong></td>
                <td width="86%" height="27" bgcolor="#FFFFFF"><strong>
                  <input name="userfile" type="file" size="40">
&nbsp;&nbsp;* 只能上传.DOC .XLS .PPT .RAR .ZIP等文件 </strong></td>
              </tr>
              
              <tr>
                <td height="32" bgcolor="#FFFFFF"><strong>文件路径：</strong></td>
                <td height="32" bgcolor="#FFFFFF"><strong>
                  <input name="url" type="text" size="60"> 
                  （如果不上传，请在此输入下载路径）</strong></td>
              </tr>
              <tr>
                <td height="32" bgcolor="#FFFFFF"><strong>文件标题：</strong></td>
                <td height="32" bgcolor="#FFFFFF"><strong>
                  <input name="title" type="text" size="60">
                  *&nbsp;&nbsp;（必须填写填写！）</strong></td>
              </tr>
              
              <tr>
                <td height="27"><strong>所属项目：</strong></td>
                <td height="27"><?  
		 $strsqlselet = "select id,type_name from {$tablehead}type where type_class = '4' and type_stat='2'";
         $resultselet = mysql_query($strsqlselet);
		
		   ?>
                  <select name="downtype">
                    <?   
		  while($rowc = @mysql_fetch_array($resultselet))
		  {
		  ?>
                    <option value="<? echo $rowc[0]  ?>"><? echo $rowc["type_name"] ?></option>
                    <? } ?>
                  </select></td>
              </tr>
              <tr>
                <td height="27" colspan="2">文件说明内容（如果不需要可以不用填写！）</td>
              </tr>
              <tr>
                <td height="508" colspan="2" align="center" bgcolor="#FFFFFF">
				<?
		  @require_once("fckeditor/fckeditor.php");
		  $sBasePath = "fckeditor/" ;
			//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

		  $oFCKeditor = new FCKeditor('content') ;
		  $oFCKeditor->BasePath	= $sBasePath ;
		  $oFCKeditor->Value		= '' ;
		  $oFCKeditor->Create() ;
		  $oFCKeditor->width='1000px';
	      $oFCKeditor->height='1000px'; 
		  ?></td>
              </tr>
              <tr>
                <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="上  传"></td>
              </tr>
              <tr>
                <td height="32" colspan="2" bgcolor="#FFFFFF">* 请注意，请不要上传大于2M的文件，否则不能上传！ </td>
              </tr>
            </table>
 </form>
 
 
<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolorlight=#000000 bordercolordark=#FFFFFF>
  <tr>
    <td><?
include ("admin/inc/down.php")
?></td>
  </tr>
</table>