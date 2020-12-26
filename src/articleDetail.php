<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
@require_once("inc/config.inc.php");
?>

<html>
<head>
<?
@require_once("inc/prepare.php");

$artid = $_GET["artid"];

if (empty($artid))
{
	die("参数错误！");
}

$strsql = "select art_title, art_content from {$tablehead}article where id = $artid and row_stat = 0";
// logString(__FILE__, "strsql: " . $strsql);

$result = mysql_query($strsql);
$row = mysql_fetch_array($result);

// logString(__FILE__, "row['art_title']: " . $row['art_title']);
// logString(__FILE__, "row['art_content']: " . $row['art_content']);
?>

<title><?=$row[art_title] . " - " . $config_web_title?></title>
<meta name="keywords" content="<?=$typeTitle . "," . $config_web_keywords?>" />
<meta name="description" content="<?=$row[art_title] . " - " . $config_web_title?>" />

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
        	<li><a href="<?=$CONFIG_WEB_URL?>advisor/">+ 顾问介绍</a></li>
			<?=$strPriTypeListLeft?>
            <span class="secondPageL-tt"></span>
            <span class="secondPageL-tb"></span>
        </ul>
        <ul class="secondPageL-b">
			<?
			// 文章列表
			$secTypeCond = "";
			if (isset($sectype))
			{
				$secTypeCond .= " and art_typeid=$sectype ";
			}
			$sql_list = "SELECT id,art_title FROM {$tablehead}article 
				where art_pritype=$pritype " . $secTypeCond . " and row_stat = 0 order by id desc";
			// logString(__FILE__, "sql_art_list: $sql_art_list");
			$result_list = @mysql_query($sql_list,$myconn);
			
			for($i=0; $rowLeft = mysql_fetch_array($result_list); $i++)
			{
				$siblings[$i]= $rowLeft;
				if ($rowLeft[id] == $artid)
				{
					$selfIndex = $i;
				}
			}
			
			// 计算开始结束索引
			$maxLeftCount = 15; // 左侧显示节点数最大值
			$halfLeftCount = floor($maxLeftCount/2);
			$siblingsCount = count($siblings);
			if ($selfIndex - $halfLeftCount < 0) { // 前面节点不够一半，beginIndex 取 0
				$beginIndex = 0;
				
				// 后面尽量多取
				if ($maxLeftCount > $siblingsCount) { // 总节点数不够最大值，endIndex 取最大索引
					$endIndex = $siblingsCount - 1;
				}
				else { // 否则，取够 maxLeftCount 个节点
					$endIndex = $maxLeftCount - 1;
				}
			}
			else { // 前面节点够一半，正常计算 beginIndex
				$beginIndex = $selfIndex - $halfLeftCount;

				// 计算 endIndex
				if ($selfIndex + $halfLeftCount > $siblingsCount - 1) { // 后面节点不够一般，
					$endIndex = $siblingsCount - 1;
					
					// 前面尽量多取（重算 beginIndex）
					if ($siblingsCount - $maxLeftCount < 0) { // 总节点数不够最大值, beginIndex 取 0
						$beginIndex = 0;
					}
					else { // 否则，取够 maxLeftCount 个节点
						$beginIndex = $siblingsCount - $maxLeftCount;
					}
				}
				else {
					$endIndex = $selfIndex + $halfLeftCount;
				}
			}
			
			// 输出列表
			for ($i = $beginIndex; $i <= $endIndex; $i++)
			{
				$hoverStringItem = "";
				if ($siblings[$i][id] == $artid)
				{
					$hoverStringItem .= 'class="secondPageLActi"';
				}
				echo "<li $hoverStringItem>
					<a title=\"".$siblings[$i][art_title].
					"\" href=\"${CONFIG_WEB_URL}".getStaticArticleUrl($pritype,$siblings[$i][id])."\">".$siblings[$i][art_title]."</a>
					</li>";

			}
			?>
            <span class="secondPageL-tt"></span>
            <span class="secondPageL-bb"></span>
        </ul>
    </div>
    
    <div class="secondPage-r">
        <div class="memberIntrodCon tissueActivityCon">
			<h3><span><?=$row['art_title']?></span></h3>
            <div class="secondPage-r-div">
				<?=$row['art_content']?>
            </div>
        </div>
    </div>
</div>
<!--二级页面 end-->

<?
@require_once("inc/footer.php");
?>
</body>
</html>