<?
/*////////////////////////////////////////////////////////////
文件生成 ： 2007-03-17
文件性质 ： 后台管理主页面
编辑： 白月
最后一次更改 ： 2007-12-12  10：30 
还未解决的问题以及需要处理的问题：
*////////////////////////////////////////////////////////////////
$main = $_GET["main"];
if(!empty($main))
{
if($main == "intro")
{
$includefile = "intro";
}
elseif($main == "top")
{
$includefile = "top";
}
elseif($main == "down")
{
$includefile = "down";
}
elseif($main == "webset")
{
$includefile = "webset";
}
elseif($main == "article_manage")
{
$includefile = "article.manage";
}
elseif($main == "article_disposal")
{
$includefile = "article.disposal";
}
elseif($main == "news_disposal")
{
$includefile = "news.disposal";
}
elseif($main == "news_manage")
{
$includefile = "news.manage";
}
elseif($main == "img_disposal")
{
$includefile = "images.disposal";
}
elseif($main == "img_manage")
{
$includefile = "images.manage";
}
elseif($main == "user_manage")
{
$includefile = "user.manage";
}
elseif($main == "login")
{
$includefile = "login";
}
elseif($main == "login_action")
{
$includefile = "login.action";
}
elseif($main == "user_dispoal")
{
$includefile = "user.dispoal";
}
elseif($main == "user_action")
{
$includefile = "user.action";
}
elseif($main == "type")
{
$includefile = "type.manage";
}
elseif($main == "down_manage")
{
$includefile = "down.manage";
}
elseif($main == "down_disposal")
{
$includefile = "down.disposal";
}
elseif($main == "contact_manage")
{
$includefile = "contact.manage";
}
elseif($main == "contact_disposal")
{
$includefile = "contact.disposal";
}
elseif($main == "single_disposal")
{
$includefile = "single.disposal";
}
elseif($main == "single_manage")
{
$includefile = "single.manage";
}
elseif($main == "src_disposal")
{
$includefile = "src.disposal";
}
elseif($main == "src_manage")
{
$includefile = "src.manage";
}
elseif($main == "lead_disposal")
{
$includefile = "lead.disposal";
}
elseif($main == "lead_manage")
{
$includefile = "lead.manage";
}
}
//////////////////////////////////////////////

@require_once("inc/config.inc.php");

logString(__FILE__, "includefile: " . $includefile);

if(!empty($includefile))
{
	require_once("admin/".$includefile.".inc.php");
	exit;
}
///////////////////////////////////////////////////////////////////////////////
@require_once('inc/templates.lang.php');
@require_once('inc/fun.inc.php');
@require_once("inc/config.db.php");
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
@require_once("inc/purview.php");   ///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
///////////////权限文件///////////////权限文件///////////////权限文件///////////////权限文件
//////////////////////////////////////////////////////////////////////////

?>
<html><head>
<title><?=$config_web_title?>  --- Power by By Studio(白月工作室)</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$DefaultLang?>">
<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
</head>
<body style="margin: 0px" scroll="no">
<div style="position: absolute; top: 0px; left: 0px; z-index: 2; height: 65px; width: 100%"><? require("admin/inc/top.php")?></div>
<table border="0" cellPadding="0" cellSpacing="0" height="100%" width="100%" style="table-layout: fixed;">
<tr><td width="120" height="100"></td>
<td width="100%"></td>
</tr>
<tr>
<td width="120"><iframe frameborder="0" id="menu" name="menu" src="admin/inc/left.php" scrolling="yes" style="height: 100%; visibility:inherit; width: 118px; z-index: 1;overflow: auto;"></iframe></td>
<td><iframe frameborder="0" id="main" name="main" src="admin.php?main=intro" scrolling="yes" style="height: 100%; visibility: inherit; width: 100%; z-index: 1;overflow: auto;"></iframe></td>
</tr>
</table>
</body>
</html>