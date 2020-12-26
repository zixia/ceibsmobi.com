<script>
//初始化
var def="1";
function mover(object){
  //主菜单
  var mm=document.getElementById("m_"+object);
  mm.className="m_li_a";
  //初始主菜单先隐藏效果
  if(def!=0){
    var mdef=document.getElementById("m_"+def);
    mdef.className="m_li";
  }
  //子菜单
  var ss=document.getElementById("s_"+object);
  ss.style.display="block";
  //初始子菜单先隐藏效果
  if(def!=0){
    var sdef=document.getElementById("s_"+def);
    sdef.style.display="none";
  }
}

function mout(object){
  //主菜单
  var mm=document.getElementById("m_"+object);
  mm.className="m_li";
  //初始主菜单还原效果
  if(def!=0){
    var mdef=document.getElementById("m_"+def);
    mdef.className="m_li_a";
  }
  //子菜单
  var ss=document.getElementById("s_"+object);
  ss.style.display="none";
  //初始子菜单还原效果
  if(def!=0){
    var sdef=document.getElementById("s_"+def);
    sdef.style.display="block";
  }
}
</script>
<div id="arttop">
       <div id="arttop-left"><img src="images/LOGO.jpg" width="285" height="60"></div>
	   <div id="arttop-right">
	       <div id="arttop-right-row"><img src="images/article_elite.gif" width="12" height="15">&nbsp;&nbsp;&nbsp;<a href="#" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.cwetb.com.cn/')">设为首页</a></div>
		   <div id="arttop-right-row"><img src="images/home.gif" width="16" height="16">&nbsp;&nbsp;<a href='#' onclick='window.external.AddFavorite("http://www.cwetb.com.cn","中国水电十局 基础工程分局")'>加入收藏</a> </div>
		   <div id="arttop-right-row"><img src="images/Favorite.gif" width="14" height="15">&nbsp;&nbsp;<a href='#' onclick="window.external.ShowBrowserUI('OrganizeFavorites', null)">整理收藏</a></div>
	   </div>
</div>
<div id="banner" style="width:860px;"><img src="images/index.jpg" width="860" height="146"> </div>
<div id="menu" style="width:860px;">
  <ul>
  <li class="m_line"><img src="images/line1.gif" width="1" height="13" /></li>
    <li id="m_1" class='m_li_a'><a href="index.php">首页</a></li>
   <?    
	  $strsql1 = "select id,type_name from {$tablehead}type where type_stat='1' and type_check='1' order by type_list";
	  $res1 = mysql_query($strsql1);
	  $i=2;
	  $title_num = mysql_num_rows($res1);
	  while($row1 = mysql_fetch_array($res1))
	  {
	  $type_lishu_x .= $row1[0];
	  $type_lishu_x .= "|";
	 ?>
    <li class="m_line"><img src="images/line1.gif" width="1" height="13" /></li>
    <li id="m_<?=$i?>" class='m_li' onmouseover='mover(<?=$i?>);' onmouseout='mout(<?=$i?>);'><a href="#"><?=$row1["type_name"]?></a></li>
    
    <?
	$i++;
	}
	?>
    </ul>
</div>
<div style="height:25px; width:860px; background-color:#F1F1F1;">
   <ul class="smenu" style="width:780px; margin:0 auto;">
     <li style="padding-left:25px;" id="s_1" class='s_li_a'>欢迎光临中国水利水电工程局 基础工程分局！</li>
    <?
	$type_lishu_array = explode("|",$type_lishu_x);
	
	for($j=2;$j<=$title_num+1;$j++)
	{
	$k=$j-2;
	$type_lishu=$type_lishu_array["$k"];
 	$strsql2 = "select * from {$tablehead}type where type_shu = '$type_lishu' and type_check='1' order by type_list";
	//echo $strsql2;
	$res2 = mysql_query($strsql2);
	?>
    <li style=" margin-left:<?=($j-2)*50+100?>px;" id="s_<?=$j?>" class='s_li' onmouseover='mover(<?=$j?>);' onmouseout='mout(<?=$j?>);'>
    <?
    while($row2 = mysql_fetch_array($res2))
	{  //while
    ?>
	|&nbsp;&nbsp;<a href="
	<?
	////////////////////////////////////////////连接地质
			if($row2["type_class"] == "6")
			{
			echo $row2["type_remark"];
			}
			elseif($row2["type_class"] == "1")
			{
			echo 'item.php?aid='.$row2[0];
			}
			elseif($row2["type_class"] == "2")
			{
			echo 'article_item.php?aid='.$row2[0];
			}
			elseif($row2["type_class"] == "3")
			{
			echo 'article_item.php?aid='.$row2[0];
			}
			elseif($row2["type_class"] == "4")
			{
			echo 'download_item.php?aid='.$row2[0];
			}
			elseif($row2["type_class"] == "5")
			{
			echo 'image_item.php?aid='.$row2[0];
			}////////////////////////////////////////////连接地质
			?>
            "><?=$row2["type_name"]?></a>&nbsp;
    <?
	}  //while
	?>|
    </li>
    <?
	}
	?>
    </ul>
</div>
<div id="content2" style="width:858px; margin-top:3px;">
  <div><img src="images/find.gif" width="23" height="21">&nbsp;&nbsp;站内搜索：<input type="text" size="18" maxlength="35" class="form"/>&nbsp;&nbsp;&nbsp;<img src="images/button1.gif" width="50" height="20">
    <label>
    <input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
    </label>
  分局概况
  <label>
  <input name="radiobutton" type="radio" value="radiobutton" />
  </label>
图片
<label>
<input name="radiobutton" type="radio" value="radiobutton" />
</label>
文件
<label>
<input name="radiobutton" type="radio" value="radiobutton" />
</label>
综合&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/talk.gif" width="10" height="11">&nbsp;<a href="item.php?id=9">领导致词</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/pho.gif" width="11" height="12">&nbsp;<a href="address_book.php">分局通信录</a></div>
</div>
