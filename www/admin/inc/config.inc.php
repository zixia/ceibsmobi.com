<?

function logString($srcFile, $logString)
{
	$logfile=fopen("trace.log." . date('Ymd'),"a");
	fwrite($logfile, "[" . date('Y/m/d') . " " . date('H:i:s') . "] " 
		. "[" . $srcFile . "] " . $logString . "\r\n");
	fclose($logfile);
}

//数据库字段
/////////////////////////////////////////////
///                   设置网站使用数据库连接参数
$dbhost = getenv('CEIBSMOBI_MYSQL_HOST');		// 设置数据库服务器地址
$dbuser = getenv('CEIBSMOBI_MYSQL_USER');		// 设置数据库登陆用户名
$dbpass = getenv('CEIBSMOBI_MYSQL_PASS');		// 设置数据库登陆密码
$dbname = 'ceibsmobi';	//设置数据库名称

//*///////////////////////////////////////////////////
//////////////////////////////////////////////
///                   设置网站使用数据库默认前缀
$tablehead = 'jz_';
//*///////////////////////////////////////////////////
////////COOKIE前缀
$config_cookie_head = 'asdf';
//////////////////////////////////////////////
///                   设置网站使用的默认字符集
$DefaultLangDb = 'UTF8';
$DefaultLang = 'UTF-8';
//*///////////////////////////////////////////////////

//////////////////////////////////////////////
///                   设置网站标题
$config_web_title = '中欧校友移动互联网协会网站';
//*///////////////////////////////////////////////////
/*/////////////////////////////////////////////
//                     网站绝对路径
*////////////////////////////////////////////////////////////////////////////
$php_self = $_SERVER['PHP_SELF'];     //页面地址
// logString(__FILE__, "php_self: ".$php_self);

define('CONFIG_WEB_ROOT', substr(dirname(__FILE__), 0, -3)); 
// logString(__FILE__, "CONFIG_WEB_ROOT: ".CONFIG_WEB_ROOT);
///////substr(dirname(__FILE__), 0, -3) -3代表此文件在INC文件夹下，共三个字符！
///获取网站根目录
/*///////////////////////////////////////////////////////////////////////////
//                     网站绝对路径
*///////////////////////////////////////////////////////////////////////
///                   设置网站URL地址参数
//////////////////////////////////////////////////


$dummydir = substr($php_self,0,strlen($php_self)-strlen("admin.php"));
// logString(__FILE__, "dummydir: ".$dummydir);

////////////如果有二级或者三级目录，自动获取
$hosturl = $_SERVER['HTTP_HOST'];        //获取网站URL
// logString(__FILE__, "hosturl: ".$hosturl);

define("BASE_URL",str_replace("\\","/","https://$hosturl$dummydir"));
$Default_Img_Folder = BASE_URL."images/default/";

define("CONFIG_WEB_URL",BASE_URL);
// logString(__FILE__, "CONFIG_WEB_URL: ".CONFIG_WEB_URL);

 ///€/网站URL地址
/*//////////////////////////////////////////////////
*//////////////////////////////////////////////
///                   设置网站跳转时间，单位秒
$backtime = 2;
$refreshtime = 3;    //防刷新时间
//*///////////////////////////////////////////////////
$config_pass_encrypt_type = "md5";
$config_pass_encrypt_time = 6;
//////////////////////MD5加密次数////////////////////////
$config_upload_max_size = 2048000;     ///2M 
//*///////////////////////////////////////////////////
$config_pass_encrypt_time = 6;
//////////////////////MD5加密次数////////////////////////
///                   设置网站版本号
$version = "3.0";
//*///////////////////////////////////////////////////
$nowtime = date(Y年m月d日H时i分);
$nowdate = date("Y-m-d");
$sitedate = "2007-01-01";
////////////////////////////////////////////////////
///////本站类型设置
$array_type = array(
			"single" => "1",
			"news" => "2",
			"article" => "3",
			"down" => "4",
			"image" => "5",
			"bbs" => "6"	
);
///////本站类型设置
$form_start_year = 1960;
///////////////////////////////////////////////////
$config_admin_group = '普通用户,普通管理员,超级管理员';  ////管理用户权限
///////////////////////////////////////////////////
///////////////////////搜索引擎优化////////////////////////////
$config_key_words = '中欧国际工商学院,中欧校友移动互联网协会,移动互联网,校友会,CEIBS,CEIBS Mobi Club, CEIBS Alumni Mobi Club, Mobile Internet';
$config_key_description = '中欧校友移动互联网协会是中欧国际工商学院校友会为服务移动互联网行业校友而设立的校友会组织。';
$config_append_title = 'CMC';///标题附加关键字
////////////////////////////////////////////////////
$config_page_static = '1';  ///是否使用文章静态 1-不启用，2-启用
///
///企业基本信息设置
$config_company_name = '北京九州智通科技有限公司';  //公司名名称
$config_company_tel = '4000-600-800';  //联系电话
$config_company_linkman = '裴利杰'; //联系人
$config_company_address = '海淀区知春路6号 罗庄北里 锦秋家园 7号楼1903室'; //联系地址
$config_company_postid = '100088'; // 邮政编码
$config_company_qq = '';//联系QQ
$company_company_msn = "";//联系MSN
$config_company_email = '';//联系电子邮件


function in_include()
{
if(!ereg("(admin.php){1}",$_SERVER['PHP_SELF']))
{
echo "No Acess,Exit";
exit;
}
}
?>
