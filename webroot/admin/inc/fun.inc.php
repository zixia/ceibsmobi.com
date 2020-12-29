<?
/*////////////////////////////////////////////////////////////
文件生成 ： 2007-04-17
文件性质 ： 提示函数
编辑： 白月
最后一次更改 ： 2007-04-17  10：30 
*////////////////////////////////////////////////////////////////
function funmessage($backurl,$messagelang,$waittime)
{
	header("refresh:$waittime;url=$backurl");
	?>
	<link href="<?=$Default_Img_Folder?>/style_admin.css" rel="stylesheet" type="text/css">
	<table width="600" border="0" align="center" cellpadding="3" cellspacing="0" style="border:#C4EAFB 1px solid;">
	<tr>
	<td width="407" height="18" bgcolor="#f3f3f3">提示信息</td>
	</tr>
	<tr>
	<td height="88" bgcolor="#f9f9f9">
    <?
	echo "$messagelang";
	echo "<br>页面正在跳转，请等待........<br><br><br><a href='"."$backurl"."'>如果页面没有自动跳转请点击这里</a>";
	?>
    
	</td>
	</tr>
	</table>
	<?
}
function funmessageother($backurl,$messagelang,$waittime)
{
	header("refresh:$waittime;url=$backurl");
	?>
	<link href="inc/css.css" rel="stylesheet" type="text/css">
	<table width="600" border="0" align="center" cellpadding="3" cellspacing="0" style="border:#C4EAFB 1px solid;">
	<tr>
	<td width="407" height="18" bgcolor="#f3f3f3">提示信息</td>
	</tr>
	<tr>
	<td height="88" bgcolor="#f9f9f9">
	<?
	echo "$messagelang";
	echo "<br>页面正在跳转，请等待........<br><br><br><a href='"."$backurl"."'>如果页面没有自动跳转请点击这里</a>";
	?>
	
	</td>
	</tr>
	</table>
	<?
}
/*
使用方法
funmessage("跳转后达到的URL"，"跳转提示语言，前面LANG文件定义","等待时间，在CONFIG文件中定义")
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function by_md5($str,$config_pass_encrypt_time)
{
for($md=1;$md<=$config_pass_encrypt_time;$md++)
{
$str = md5($str);
}
return $str;
}
//////////////////MD5加密函数
function bdayage($birthday)
{
$bday = $birthday;
if($bday == "0000-00-00" || $bday == "")
///////
{
$age = "未知";
}else{
/////////
$tday = date("Y-m-d");
$tempb1 = intval(substr($bday,0,4));
$tempt1 = intval(substr($tday,0,4));
$agetemp = $tempt1 - $tempb1;
$tempb2 = intval(substr($bday,5,2));
$tempt2 = intval(substr($tday,5,2));
if($tempt2 > $tempb2)
{//判断月份的
$age = $agetemp + 1;
}//判断月份的
elseif($tempt2 < $tempb2)
{//判断月份的
$age = $agetemp;
}//判断月份的
else
{//判断月份的
$tempb3 = intval(substr($bday,8,2));
$tempt3 = intval(substr($tday,8,2));
if($tempt3 > $tempb3)
{//判断日
$age = $agetemp + 1;
}
else
{
$age = $agetemp;
}//判断日
}//判断月份的
//////
}
echo "$age";
}



//////////////////////////////////////////////////////从生日获取年龄函数
/////////////
function checksex($sex)
{
if($sex == 1)
{
return "男";
}elseif($sex == 2){
return "女";
}else{
return "未知";
}
}
/////////////检测性别////////////////////////

	///////////// 判断ID
function judgeid($id)
{
///
if(empty($id) || !ereg("^[1-9][0-9]*",$id))
{
	echo "没有相关信息";
	exit;
}
///
}
////////////////////////////////////////////////////////
function showarticletitle($title,$content,$titlelen,$nowdate,$link,$linkmode,$linkvalue,$target,$img)
//showarticletitle("标题"，内容，字数，日期(不需要日期请填写0)，连接地址，连接方式，连接值，窗口打开方式默认填写0,图标图片路径，默认填写0)
{
	if($nowdate == "0")
	{
	$nowdate = "";
	}else{
	$nowdate = "&nbsp;(".$nowdate.")";
	}
	if($target == "0")
	{
	$target = "_parent";
	}
	if($img == "0")
	{
	echo "<li style='border-bottom:#e3e3e3 1px dotted; padding:5px;margin-top:4px;'>";
	}else{
	//echo CONFIG_WEB_URL."job/".$img;
	echo "<li style='border-bottom:#e3e3e3 1px dotted; padding:3px;list-style-image:url(".$img.");margin-top:4px;height:12px; left:3px;position:relative; top:-1px;'>";
	}
			///先输出LI标签
			if(strstr($content,"<img"))
			{
			//如果有图片代码的时候
			echo "<font color='blue'>";
			echo "[图文]";
			echo "</font>";	
			$titlelen = $titlelen - 6;  
			//如果有图文，那么显示标题字符数就应该减6个字符位
			}
			if(strlen($title)< $titlelen)
			{
			echo "<a href='".$link."?".$linkmode."=".$linkvalue."' target='".$target."'>";
			echo $title;
			echo "</a>";
			echo $nowdate;
			echo "</li>";
			}
			elseif(strlen($title) >= $titlelen && strlen($title)%2 == 1)
				{
				echo "<a href='".$link."?".$linkmode."=".$linkvalue."' target='".$target."'>";
				echo substr($title,0,$titlelen-3);
				echo"..";
				echo "</a>";
				echo $nowdate;
				echo "</li>";
				}
				else
					{
					echo "<a href='".$link."?".$linkmode."=".$linkvalue."' target='".$target."'>";
					echo substr($title,0,$titlelen-2);
					echo"..";
					echo "</a>";
					echo $nowdate;
					echo "</li>";
					}
	
}
////////////////////////////浏览附件

function imageshow($link,$alt,$imgcort)
{
$size = getimagesize("$link");
$width = $size[0];
$height = $size[1];
if($imgcort!="")
{  
	if($width>$imgcort)
	{ 
	$temp=$imgcort/$width;
	$width=$imgcort;
	$height=$height*$temp;
	}else{
	$width=$width;
	$height=$height;
	}
}else{
$width=$width;
$height=$height;
}
echo '&nbsp;<img src="';
echo "$link";
echo '" width="';
echo "$width";
echo '" height="';
echo "$height";
echo '" alt="';
echo "$alt";
echo '" style="border=1px #aaaaaa solid;">';
}
/////////////////////////////////////
function getip()
{
if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])
{
$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
}
elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])
{
$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
}
elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"])
{
$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
}
elseif (getenv("HTTP_X_FORWARDED_FOR"))
{
$ip = getenv("HTTP_X_FORWARDED_FOR");
}
elseif (getenv("HTTP_CLIENT_IP"))
{
$ip = getenv("HTTP_CLIENT_IP");
}
elseif (getenv("REMOTE_ADDR"))
{
$ip = getenv("REMOTE_ADDR");
}
else
{
$ip = "Unknown";
}
return $ip ;
}

?>