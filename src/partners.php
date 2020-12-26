<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
$pritype="partners";
?>
<?
@require_once("inc/config.inc.php");
?>

<html>
<head>
<?
@require_once("inc/prepare.php");

// 合作伙伴列表
$sql_src_list = "SELECT id,src_title,src_img,src_url FROM {$tablehead}src order by id ";
// logString(__FILE__, "sql_src_list: $sql_src_list");
$result_src_list = @mysql_query($sql_src_list,$myconn);

for($i=0; $row = mysql_fetch_array($result_src_list); $i++)
{
	$strSrcs .= "<a href=\"$row[src_url]\" target=\"_blank\" title=\"$row[src_title]\">
		<img height=\"70\" width=\"170\" alt=\"$row[src_title]\" src=\"" . ADMIN_ROOT.$row["src_img"] . "\" /></a>\r\n";
}
?>
<title><?="合作伙伴 - " . $config_web_title?></title>
<meta name="keywords" content="<?="合作伙伴," . $config_web_keywords?>" />
<meta name="description" content="<?="合作伙伴 - " . $config_web_title?>" />
<?
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
        	<li><a href="<?=$CONFIG_WEB_URL?>member/">+ 会员介绍</a></li>
			<?=$strPriTypeListLeft?>
            <span class="secondPageL-tt"></span>
            <span class="secondPageL-tb"></span>
        </ul>
    </div>
    
    <div class="secondPage-r">
    	<div class="teamworkPartner">
			<?=$strSrcs?>
        </div>
    </div>
</div>
<!--二级页面 end-->

<?
@require_once("inc/footer.php");
?>
</body>
</html>