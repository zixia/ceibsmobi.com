<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLangPage?>">

<?
// 栏目相关 title
$typeTitle = "";

// logString(__FILE__, "get pritypename: $_GET[pritypename]; get pritype: $_GET[pritype]; init pritype: $pritype");

// 避免覆盖预定义的 pritype （index 和 member）
if (!isset($pritype))
{
	$pritypename = $_GET["pritypename"];
	if (!isset($pritypename))
	{
		$pritype = $_GET["pritype"];
	}
	else
	{
		$pritype = $static_type_name[$pritypename];
	}
}
logString(__FILE__, "pritype: $pritype");
// logString(__FILE__, "empty(static_type[pritype]): " . empty($static_type[$pritype]));

require_once("inc/config.db.php");

// 一级栏目
$strsql1 = "select id,type_name,type_list,type_check,type_shu from {$tablehead}type where type_stat=1 order by type_list, id";
$result1 = @mysql_query("$strsql1",$myconn);

$strPriTypeListLeft = "";
$strPriTypeListHeader = "";
$hoverString = 'class="memberIntrod"';
$hoverStringLeft = 'class="secondPageLActi"';

for($i=0; $row = mysql_fetch_array($result1); $i++)
{
	if (!isset($pritype) && i==0)
	{
		$pritype = $row[id];
		// logString(__FILE__, "pritype: $pritype");
	}
	
	// 生成顶部栏目信息字符串
	$activeClass = "";
	$activeClassLeft = "";
	if ($pritype == $row[id])
	{
		$activeClass .= $hoverString;
		$activeClassLeft .= $hoverStringLeft;
		$typeTitle = $row[type_name];
	}
	$strPriTypeListHeader .= "\r\n<a href=\"${CONFIG_WEB_URL}".getStaticTypeUrl($row[id])."\" $activeClass>$row[type_name]</a>";

	// 生成左侧栏目列表字符串
	$strPriTypeListLeft .= "\r\n<li $activeClassLeft><a href=\"${CONFIG_WEB_URL}".getStaticTypeUrl($row[id])."\">+ $row[type_name]</a></li>";
}
$indexHoverString = "";
$memberHoverString = "";
$advisorHoverString = "";
if ($pritype == "index")
{
	$indexHoverString .= 'class="homePage"';
	$typeTitle = "首页";
}
if ($pritype == "member")
{
	$lead_type = $_GET["lead_type"];
	if (!isset($lead_type))
	{
		$lead_type = 0;
	}

	if ($lead_type == 0)
	{
		$memberHoverString .= $hoverString;
		$typeTitle = "会员介绍";
	}
	else
	{
		$advisorHoverString .= $hoverString;
		$typeTitle = "顾问介绍";
	}

	logString(__FILE__, "lead_type: $lead_type, typeTitle:$typeTitle, memberHoverString:$memberHoverString, advisorHoverString:$advisorHoverString");
}
$strPriTypeListHeader = "\r\n<a href=\"${CONFIG_WEB_URL}index.php\" $indexHoverString>首页</a>" 
	. "\r\n<a href=\"${CONFIG_WEB_URL}member/\" $memberHoverString>会员介绍</a>" 
	. "\r\n<a href=\"${CONFIG_WEB_URL}advisor/\" $advisorHoverString>顾问介绍</a>" 
	. $strPriTypeListHeader;

// logString(__FILE__, "strPriTypeListHeader: $strPriTypeListHeader");
// logString(__FILE__, "strPriTypeListLeft: $strPriTypeListLeft");
?>
