<?
/* 老方法获取路径，可以使用超全局变量就可以。
$sRealPath = realpath( './' ) ;
//echo "$sRealPath"."<br>";
	$sSelfPath = $_SERVER['PHP_SELF'] ;
	//echo "$sSelfPath"."<br>";
	$sSelfPath = substr( $sSelfPath, 0, strrpos( $sSelfPath, '/' ) ) ;
	//echo "$sSelfPath"."<br>";
	
	$path = substr( $sRealPath, 0, strlen( $sRealPath ) - strlen( $sSelfPath ) );
	*/
	//echo "$path"."<br>";
	//echo "$path"."<br>";
//$upfile = "upload";        //上传文件存放目录名！！用于检测使用的。请注意和下面的上传路径要相同！
//////////////////////////////////////////////
$uppath = "UploadFiles/";   //上传目录路径！！   如：  “/upload/”  注意斜杠
//上传分路径，如，图片为IMAG。这个可以你自己指定，如果不指定，则上传至上传的目录
$all_up_path = CONFIG_WEB_ROOT."$uppath";     //全部的路径！！
///////////////////////判断是否有这个文件夹
$makpath = CONFIG_WEB_ROOT."$uppath";
// logString(__FILE__, "all_up_path: $all_up_path");
if(!is_dir("$makpath"))
{
	echo "目录 $makpath 不存在，自动新建目录 ...<br/>";
	/////
	if(mkdir("$makpath",0777))
	{
		echo "指定的上传目录不存在<br><br>现在已经此建立，请再次刷新后 就不会出现本提示！";
		exit;
	}else{
		echo "指定的上传目录不存在<br>并且不能建立此目录，请检查上传配置文件！！";
		exit;
	}
	/////
}
////////////////////
if(!is_writable("$all_up_path"))
{
	echo "指定的上传目录 $all_up_path 不可写<br><br>请将其设置为可写的状态才能上传数据！";
	exit;
}
?>