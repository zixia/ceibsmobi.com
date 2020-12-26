<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
$pritype="member";
?>
<?
@require_once("inc/config.inc.php");
?>

<html>
<head>
<?
@require_once("inc/prepare.php");
@require_once("inc/head.php");
@require_once("inc/files.php");
?>
</head>

<body>
<!--头部 start-->
<div id="header">
	<?
	@require_once("inc/header.php");
	?>
</div>
<!--头部 end-->

<!--二级页面 start-->
<div id="secondPage">
	<div class="secondPage-l">
    	<ul class="secondPageL-t">
        	<li <? if($lead_type == 0) echo 'class="secondPageLActi"'; ?> ><a href="<?=$CONFIG_WEB_URL?>member/">+ 会员介绍</a></li>
        	<li <? if($lead_type == 1) echo 'class="secondPageLActi"'; ?> ><a href="<?=$CONFIG_WEB_URL?>advisor/">+ 顾问介绍</a></li>
			<?=$strPriTypeListLeft?>
            <span class="secondPageL-tt"></span>
            <span class="secondPageL-tb"></span>
        </ul>
    </div>
    
    <div class="secondPage-r">
    	<div class="memberIntrodImg">
			<?
			// 成员列表
			$sql_member_list = "SELECT id,lead_type,lead_name,lead_img,lead_work FROM {$tablehead}lead where lead_type = $lead_type and stat = 1 and row_stat = 0 order by id";
			// logString(__FILE__, "sql_art_list: $sql_art_list");
			$result_member_list = @mysql_query($sql_member_list,$myconn);

			for($i=0; $row = mysql_fetch_array($result_member_list); $i++)
			{
				if ($lead_type == 0)
				{
					$virDir = 'member';
				}
				else
				{
					$virDir = 'advisor';
				}

				echo "
				<dl>
					<dt><a href=\"${CONFIG_WEB_URL}${virDir}/$row[id].html\">
					<img width=\"120\" height=\"160\" alt=\"$row[lead_name]\" src=\"" . ADMIN_ROOT.$row["lead_img"] . "\" /></a></dt>
					<dd class=\"memberIntrodImgDd1\"><a href=\"${CONFIG_WEB_URL}member/$row[id].html\">$row[lead_name]</a></dd>
					<dd>$row[lead_work]</dd>
				</dl>
				";
			}
			?>
        </div>
    </div>
</div>
<!--二级页面 end-->

<?
@require_once("inc/footer.php");
?>
</body>
</html>