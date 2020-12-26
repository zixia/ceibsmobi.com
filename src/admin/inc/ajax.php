<?
@require_once("../inc/config.inc.php");
@require_once("../inc/config.db.php");
header("Content-Type:text/html;text/html; charset=$DefaultLang");

///////////////////////////////////////////////////
$action = $_GET["action"];
//////////////////////////////////
if($action == "hypotaxis")
{
$strsql = "select * from {$tablehead}type where type_stat = '1'";
$result = mysql_query($strsql);
$output = '<select name="primarytype">';
               
while($row = mysql_fetch_array($result))
{
$output .= '<option value="'.$row[0].'">'.$row["type_name"].'</option>';
}
$output .= '</select>';
echo "1";
echo "|";
echo $output;
exit;
}
//////////////////////
if($action == "item")
{
logString(__FILE__, "item begin");

$pritype = $_GET["pritype"];
$strsql = "select * from {$tablehead}type where type_stat = '2' and type_shu='$pritype' and type_class = '2' or type_stat = '2' and type_shu='$pritype' and type_class = '3' order by type_list";
//echo $strsql;
//////
$result = mysql_query($strsql);
echo "1";
echo "|";
echo '<select name="sectype">';
while($row = mysql_fetch_array($result))
{
echo '<option value="'.$row[0].'">'.$row["type_name"].'</option>';
}
echo '</select>';
////
logString(__FILE__, "item end");
exit;
}
?>