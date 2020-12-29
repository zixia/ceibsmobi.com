<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        	<li><a href="<?=$CONFIG_WEB_URL?>member/">+ 会员介绍</a></li>
        	<li><a href="<?=$CONFIG_WEB_URL?>advisor/">+ 顾问介绍</a></li>
			<?=$strPriTypeListLeft?>
            <span class="secondPageL-tt"></span>
            <span class="secondPageL-tb"></span>
        </ul>
    </div>
    
    <div class="secondPage-r">
        <div class="tissueActivity">
			<ul>
				<?
				// 文章列表
				$secTypeCond = "";
				if (isset($sectype))
				{
					$secTypeCond .= " and art_typeid=$sectype ";
				}
				$sql_art_list = "SELECT id,art_title,add_date FROM {$tablehead}article 
					where art_pritype=$pritype " . $secTypeCond . " and row_stat = 0 order by id desc";
				// logString(__FILE__, "sql_art_list: $sql_art_list");
				$result_art_list = @mysql_query($sql_art_list,$myconn);

				for($i=0; $row = mysql_fetch_array($result_art_list); $i++)
				{
					echo "\r\n<li><a href=\"${CONFIG_WEB_URL}".getStaticArticleUrl($pritype,$row[id])."\">
							$row[art_title]</a>[$row[add_date]]</li>";
				}
				?>
			</ul>
        </div>
    </div>
</div>
<!--二级页面 end-->

<?
@require_once("inc/footer.php");
?>
</body>
</html>