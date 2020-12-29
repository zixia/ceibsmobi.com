<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
$pritype="index";
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

<?
// 成员列表倒序
$sql_member_list = "SELECT id,lead_name,lead_img,lead_work FROM {$tablehead}lead where stat = 1 and row_stat = 0 order by id desc limit 0,1";
// logString(__FILE__, "sql_art_list: $sql_art_list");
$result_member_list = @mysql_query($sql_member_list,$myconn);

$strMembers = "";
$oneMember;
for($i=0; $row = mysql_fetch_array($result_member_list); $i++)
{
	if (i == 0)
	{
		$memberId = $row["id"];
		$oneMember = $row;
	}
	$strMembers .= "\r\n<a href=\"${CONFIG_WEB_URL}member/$row[id].html\"><img height=\"100\" width=\"75\" src=\"" . ADMIN_ROOT.$row["lead_img"] . "\" /></a>";
}

// 第一个成员的详情
$sql_one_member_content = "SELECT lead_content FROM {$tablehead}lead where id = " . $oneMember["id"];
//logString(__FILE__, "sql_one_member_content: $sql_one_member_content");
$result_one_member_content = @mysql_query($sql_one_member_content,$myconn);
if($row = mysql_fetch_array($result_one_member_content))
{
	$oneMember["lead_content"] = $row["lead_content"];
}
//logString(__FILE__, "oneMember: ".print_r($oneMember, 1));

// 前两个栏目id列表（pritype = 2）
$sql_two_type_id = "SELECT id,type_name,type_list,type_name FROM {$tablehead}type where type_stat=1 order by type_list, id limit 0, 2";
// logString(__FILE__, "sql_two_type_id: $sql_two_type_id");
$result_two_type_id = @mysql_query($sql_two_type_id,$myconn);
for ($i=0; i<2; $i++)
{
	if (!$row = mysql_fetch_array($result_two_type_id))
		break;
	$typeIds[$i] = $row;
}
// logString(__FILE__, "count(typeIds): ".count($typeIds));
// logString(__FILE__, "typeIds: ".print_r($typeIds, 1));

if (count($typeIds)>0)
{
	// 组织活动列表
	$sql_act_list = 
		"SELECT id,art_pritype,art_typeid,art_title,add_date,art_content FROM {$tablehead}article where art_pritype=".$typeIds[0][id]." and row_stat = 0 order by id desc";
	// logString(__FILE__, "sql_act_list: $sql_act_list");
	$result_act_list = @mysql_query($sql_act_list,$myconn);

	for($i=0; $i < 5; $i++)
	{
		if (!$row = mysql_fetch_array($result_act_list))
			break;
		$actArray[$i] = $row;
	}
	// logString(__FILE__, "count(actArray): ".count($actArray));
	// logString(__FILE__, "actArray: ". print_r($actArray, 1));
}

if (count($typeIds)>1)
{
	// 新闻资讯列表（pritype = 2）
	$sql_news_list = 
		"SELECT id,art_pritype,art_typeid,art_title,add_date,art_content FROM {$tablehead}article where art_pritype=".$typeIds[1][id]." and row_stat = 0 order by id desc";
	// logString(__FILE__, "sql_news_list: $sql_news_list");
	$result_news_list = @mysql_query($sql_news_list,$myconn);

	for($i=0; $i < 5; $i++)
	{
		if (!$row = mysql_fetch_array($result_news_list))
			break;
		$newsArray[$i] = $row;
	}
	// logString(__FILE__, "count(newsArray): ".count($newsArray));
	// logString(__FILE__, "newsArray: ".print_r($newsArray, 1));
}
?>
<!--banner start-->
<div id="banner">
	<div class="bannerCon">
    	<span class="bannerBj-top"></span>
        <a href="<?=$CONFIG_WEB_URL.getStaticArticleUrl($actArray[0]['art_pritype'],$actArray[0]['id'])?>"><img src="images/bannerImg1.gif" id="pic" /></a>
        <span class="bannerImg-bj"></span>
        <p><a href="<?=$CONFIG_WEB_URL.getStaticArticleUrl($actArray[0]['art_pritype'],$actArray[0]['id'])?>"><?=$actArray[0][art_title]?></a></p>
        <div class="links">
        	<a href="#" class="linksActive"></a><a href="#"></a><a href="#"></a>
        </div>
    </div>
</div>
<!--banner end-->

<!--主体 start-->
<div id="main">
	<div class="memberIntro">
    	<h3><span>会员</span>介绍<a href="<?=$CONFIG_WEB_URL?>member/">更多&gt;&gt;</a></h3>
        <dl>
        	<dt>
				<a title="<?=$oneMember[lead_name]?>" href="<?="${CONFIG_WEB_URL}member/$oneMember[id].html"?>">
					<img src="<?=ADMIN_ROOT.$oneMember[lead_img]?>" width="120" height="160" />
				</a>
			</dt>
            <dd class="memberIntroDd1"><?=$oneMember[lead_content]?></dd>
            <dd class="memberIntroDd2"><?=$oneMember[lead_work]?></dd>
        </dl>
    </div>
	<div class="textureaActi">
    	<h3><span><?=substr($typeIds[0][type_name],0,6)?></span><?=substr($typeIds[0][type_name],6)?>
			<a href="<?=$CONFIG_WEB_URL.getStaticTypeUrl($typeIds[0][id])?>">更多&gt;&gt;</a>
		</h3>
        <ul>
			<?
			for ($i=0; $i<5 && $i<count($actArray); $i++)
			{
				$str = "<li><a href=
					\"${CONFIG_WEB_URL}".getStaticArticleUrl($actArray[$i][art_pritype],$actArray[$i][id])."\">"
					.$actArray[$i][art_title]."</a>[" . $actArray[$i][add_date] . "]</li>";
				echo $str;
			}
			?>
        </ul>
    </div>
	<div class="newMessage">
    	<h3><span><?=substr($typeIds[1][type_name],0,6)?></span><?=substr($typeIds[1][type_name],6)?>
			<a href="<?=$CONFIG_WEB_URL.getStaticTypeUrl($typeIds[1][id])?>">更多&gt;&gt;</a>
		</h3>
        <div class="newMessageImg"><img src="images/newMessageImg.jpg" /></div>
        <ul>
			<?
			for ($i=0; $i<5 && $i<count($newsArray); $i++)
			{
				$str = "<li><a href=
					\"${CONFIG_WEB_URL}".getStaticArticleUrl($newsArray[$i][art_pritype],$newsArray[$i][id])."\">"
					.$newsArray[$i][art_title]."</a>[" . $newsArray[$i][add_date] . "]</li>";
				echo $str;
			}
			?>
        </ul>
    </div>
</div>
<!--主体 end-->

<?
@require_once("inc/footer.php");
?>
</body>
</html>