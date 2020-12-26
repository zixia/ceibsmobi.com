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

$id = $_GET["id"];

if (empty($id))
{
	die("参数错误！");
}

$strsql = "select lead_type, lead_name, lead_work, lead_class, lead_img, lead_content, stat from {$tablehead}lead where id = $id and row_stat = 0";
// logString(__FILE__, "strsql: " . $strsql);

$result = mysql_query($strsql);
$row = mysql_fetch_array($result);

// logString(__FILE__, "row['lead_name']: " . $row['lead_name']);
// logString(__FILE__, "row['lead_work']: " . $row['lead_work']);
// logString(__FILE__, "row['lead_class']: " . $row['lead_class']);

if ($row[stat] == 1)
{
	$leadName = $row[lead_name];
}
else
{
	$leadName = '失效会员';
}
?>

<title><?=$leadName . "，" . $row['lead_class'] . '，' . $config_web_title . '会员'?></title>
<meta name="keywords" content="<?=$leadName . "," . $config_web_keywords?>" />
<meta name="description" content="<?=$leadName . " - " . $config_web_title?>" />

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
        	<li <? if($lead_type == 0) echo 'class="secondPageLActi"'; ?> ><a href="<?=$CONFIG_WEB_URL?>member/">+ 会员介绍</a></li>
        	<li <? if($lead_type == 1) echo 'class="secondPageLActi"'; ?> ><a href="<?=$CONFIG_WEB_URL?>advisor/">+ 顾问介绍</a></li>
			<?=$strPriTypeListLeft?>
            <span class="secondPageL-tt"></span>
            <span class="secondPageL-tb"></span>
        </ul>
        <ul class="secondPageL-b">
			<?
			// 成员列表
			$sql_list = "SELECT id,lead_type,lead_name,lead_work FROM {$tablehead}lead where lead_type = $lead_type and stat = 1 and row_stat = 0 order by id";
			// logString(__FILE__, "sql_art_list: $sql_art_list");
			$result_list = @mysql_query($sql_list,$myconn);

			for($i=0; $rowLeft = mysql_fetch_array($result_list); $i++)
			{
				$siblings[$i]= $rowLeft;
				if ($rowLeft[id] == $id)
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

			if ($lead_type == 0)
			{
				$virDir = 'member';
			}
			else
			{
				$virDir = 'advisor';
			}
			
			// 输出列表
			for ($i = $beginIndex; $i <= $endIndex; $i++)
			{
				$hoverStringItem = "";
				if ($siblings[$i][id] == $id)
				{
					$hoverStringItem .= 'class="secondPageLActi"';
				}
				echo "<li $hoverStringItem><a title=\"".$siblings[$i][lead_work]."\" href=\"${CONFIG_WEB_URL}${virDir}/".$siblings[$i][id].".html\">"
						.$siblings[$i][lead_name]."</a></li>";
			}
			?>
            <span class="secondPageL-tt"></span>
            <span class="secondPageL-bb"></span>
        </ul>
    </div>

<style>
#icon {background:url(../images/peopleImg-Bj.jpg) no-repeat; display:inline-block; float:left; height:160px; padding:8px 8px 8px 8px; width:120px; margin:0 15px 15px 0;}
</style>


    
    <div class="secondPage-r">
		<div class="memberIntrodCon">
			<?
			if ($row[stat] == 0)
			{
				die('<h2>此会员已经失效！</h2>');
			}
			?>
			<h1 class="secondPageR-h3">
				<span><?=$row[lead_name]?></span>
				<?
				echo $row[lead_work];
				if ($row[lead_class] != null)
				{
					echo "，" . $row[lead_class];
				}
				?>
			</h1>
            <div class="secondPage-r-div">
					<img id='icon' width="120" height="160" alt="<?=$row['lead_name'] ?>" src="<?=ADMIN_ROOT.$row['lead_img'] ?>"/>
				<?=$row['lead_content']?>
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
