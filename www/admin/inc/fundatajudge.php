<?
/*////////////////////////////////////////////////////////////
文件生成 ： 2007-03-17
文件性质 ： 表单传递数据判断函数
编辑： 白月
最后一次更改 ： 2007-04-24  23：30 
*////////////////////////////////////////////////////////////////

///判断是否实数
function judgereal($tempdata)
{
if(!is_numeric($tempdata))
{
return false;
}else{
return true;
}
}
//////////////////////////判断是否是整数/
function judgeint($tempdata)
{
///
return ereg("^[1-9]+[0-9]+$","$tempdata");
///
}
/////////////////////////////////////判断是否浮点///////
function judgefloat($tempdata)
{
///
return ereg("^[1-9]+[0-9]+\.+[0-9]+$","$tempdata");
///
}
/////////////////////////////////////////////////判断邮件
function judgeemail($tempdata)
{
if(ereg("^[0-9a-zA-Z]+([0-9a-zA-Z]|_|\.|-)+[0-9a-zA-Z]+@(([0-9a-zA-Z]+\.)|([0-9a-zA-Z]+-))+[0-9a-zA-Z]+$","$tempdata") && strrpos("$tempdata","-") < strrpos("$tempdata","."))  ///已经正常！！首先验证一组数据是否正常，比如 sdd.或者dff-这样的数据是否正确，并且使用+可以验证引用零次或多次。再进行组合。
{
return true;
}else{
return false;
}
}
/////////////////////////////////////////////判断是否含有特殊符号
//////////////////////////////////////////判断特殊符号
function judgeteshu($tempdata)
{
if($tempdata == addslashes("$tempdata") && !ereg("[\}{\[\&\^\%\$\#\@\!\;\:\~\`\；\：\‘\“\”\，\。\？\／\）\（\＊\—\…\％\￥\＃\·\！\～\…\｀\,\.\?\<\>\*\(\)\+\_\=\/\ˇ\¨\〃\々\‖\〈\〉\《\》\「\」\『\』\〖\〗\【\】\±\-]","$tempdata") && !strpos("$tempdata","]"))
{
return false;    //没有检测到特殊符号。则返回ＦＡＬＳＥ//////检测到有特殊符号，则返回”真“值
}
else
{
return true;
}
}

////////////////////////////////////////////检查判断是否在字符中央含有空格///////////////////
function judgespace($tempdata)
{
if(strpos("$strtest"," ") || strpos("$strtest","　"))
{
return true;
}else{
return true;
}
}
//////////////////////////////////////////判断注册用户是否按照规定注册，只能以数字或者字母开头，并且职能包含减号（-）下划线（_）点号（.）用户名长度必须大于4个字符且小于20个字符
function judgeusername($tempdata)
{
	if(ereg("^[0-9a-zA-Z]+([0-9a-zA-Z]|_|\.|-)+[0-9a-zA-Z]$","$tempdata")&& strlen("$tempdata")>=4 && strlen("$tempdata")<20)
	{
		return true;
	}else{
		return false;
	}
}
?>