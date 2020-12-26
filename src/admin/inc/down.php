<?
$strsrc = "select src_url,src_img,src_title from {$tablehead}src where src_stat=1 order by id desc";
$ressrc = mysql_query($strsrc);
?>
<div style="width:855px; height:80px; ">
<div style="width:855px;">
<?
while($rowsrc = mysql_fetch_array($ressrc))
{
?>
<div style="border:1px dotted #C3C3C3; margin-left:9px; margin-right:9px; margin-top:5px; float:left"><a href="<?=$rowsrc["src_url"]?>" target="_blank"><img width="120" height="40" src="<?=CONFIG_WEB_URL.$rowsrc["src_img"]?>" alt="<?=$rowsrc["src_title"]?>" border="0" /></a></div>
<?
}
?>

</div>


<div id="bottom" style="margin-top:7px;"><a href="#">关于我们</a>&nbsp;|&nbsp;<a href="#">资源合作</a>&nbsp;|&nbsp;<a href="#">联系我们</a>&nbsp;|&nbsp;<a href="#">版权申明</a> <br>
	Copyright@2008 水电十局 基础工程分局<br>
	分局地址：四川省都江堰市公园路53号 邮政编码：611830 
<br>分局电话：028-87265176  </div>

</div>