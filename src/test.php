<?
if (!isset($_COOKIE["user"]))
	setcookie("user", "peilj", time()+3600);
?>

<html>
<body>

<?

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
