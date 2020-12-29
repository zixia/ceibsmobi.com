<?
@require_once("inc/config.inc.php");
@require_once("inc/config.db.php");

if (!isset($_COOKIE["user"]))
	setcookie("user", "peilj", time()+3600);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset==UTF-8">
</head>
<body>
<script language="javascript">
//获取域名
host = window.location.host;
host2=document.domain; 

//获取页面完整地址
url = window.location.href;

document.write("<br>window.location.host="+host)
document.write("<br>document.domain="+host2)
document.write("<br>window.location.href="+url)
</script>
<script language="javascript">
function setSearchDomain(formname) {
//	formname.si.value = window.location.host;
	formname.si.value = "www.ceibsmobi.com";
}
</script>

<form name="formSearch" onsubmit="javascript:setSearchDomain(this)" action="https://www.baidu.com/baidu" target="_blank"> 
<input type=text name=word> 
<input type="submit" value="baidu"> 
<input name=tn type=hidden value="bds"> 
<input name=cl type=hidden value="3"> 
<input name=ct type=hidden value="2097152"> 
<input name=si type=hidden> 
</form> 

<!--Google站内搜索开始-->
<form method=get action="https://www.google.com/search" target="_blank">
<input type=text name=q>
<input type=submit name=btnG value="Google">
<input type=hidden name=ie value=GB2312>
<input type=hidden name=oe value=GB2312>
<input type=hidden name=hl value=zh-CN>
<input type=hidden name=domains value="www.ceibsmobi.com">
<input type=hidden name=sitesearch value="www.ceibsmobi.com">
</form>
<!--Google站内搜索结束-->

<?

echo "1. I'm"."<br/>";
echo "2.". mysql_real_escape_string("I'm")."<br/>";

echo $_REQUEST[test];
echo "<br/>";

echo strpos("hello", "l");
echo "<br/>";
echo strlen("");

echo "<br/>";

$x = "2";
switch($x)
{
	case "1":
		echo "number 1";
		break;
	case "2":
		echo "number 2";
		break;
	default:
		echo "default";
}

echo "<br/>";

$arr=array("one", "two", "three");
foreach ($arr as $value)
{
  echo "Value: " . $value . "<br />";
}
echo "<p/>";

echo date('Y/m/d') . " " . date('H:i:s') . "<br/>";

echo implode(",",$_COOKIE) . "<br/>";

if (isset($_COOKIE["user"]))
  echo "Welcome " . $_COOKIE["user"] . "!<br />";
else
  echo "Welcome guest!<br />";

echo 
"
test1
test2
<br/>
";

function log_str($logString)
{
	$logfile=fopen("trace.log","a");
	fwrite($logfile,"[" . date('Y/m/d') . " " . date('H:i:s') . "] " . $logString . "\r\n");
	fclose($logfile);
}

echo "log_str result: " . log_str(__FILE__ . date('Y/m/d') . " " . date('H:i:s'));

echo $_SERVER['DOCUMENT_ROOT'].'<br/>';

echo $_SERVER['HTTP_HOST'].'<br/>';
?>

<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> <br />
<input type="submit" name="submit" value="Submit" />
</form>

<div height="300px">
<?
require_once("fckeditor/fckeditor.php");
$sBasePath = "fckeditor/" ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('content1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= '1234' ;
$oFCKeditor->ToolbarSet = 'baiyue';
$oFCKeditor->Create() ;
?>
</div>

end
</body>
</html>
