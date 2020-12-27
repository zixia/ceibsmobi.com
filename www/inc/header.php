<div class="header-top"></div>
<div class="headerLogo">
	<div class="headerLogo-r">
		<div><img src="<?=$CONFIG_WEB_URL?>images/star.jpg" class="collectSite">
		<a href="#" title="收藏本站到你的收藏夹" onclick="javascript:addBookmark()">收藏本站</a>
		<span>|</span><img src="<?=$CONFIG_WEB_URL?>images/sinaLogo.jpg" /><a href="http://weibo.com/ceibsmobi" target="_blank">协会微博</a>
		<a href="http://www.ceibsmobi.com/news/11.html" target="_blank" class="joinSociety">加入协会</a></div>
		<div class="headerLogo-rt"><a href="http://www.ceibs.edu/index_cn.shtml" target="_blank" ><img src="<?=$CONFIG_WEB_URL?>images/ceibsLogo.jpg" /></a><img src="<?=$CONFIG_WEB_URL?>images/ceibsFont.jpg" /></div>
	</div>
	<a href="/" name="top"><img src="<?=$CONFIG_WEB_URL?>images/logo.jpg" /></a>
</div>
<div class="nav">
	<!--Baidu站内搜索开始--> 
<!--
	http://www.baidu.com/baidu?tn=bds&cl=3&ct=2097152&si=www.sohu.com&word=%E4%B8%AD%E6%AC%A7
-->
	<form class="searchForm" method=get onsubmit="javascript:setSearchDomainBaidu(this)" action="https://www.baidu.com/baidu" target="_blank">
		<input type=text name=word value="请输入关键字" class="searchText" id="searchText" onfocus="checkFocus()" onblur="checkForm()" /> 
		<input type="submit" value="" class="searchBtn" />
		<input name=tn type=hidden value="bds" />
		<input name=cl type=hidden value="3" />
		<input name=ct type=hidden value="2097152" />
		<input name=si type=hidden value="ceibsmobi.com" />
	</form>
	<!--Baidu站内搜索结束-->

	<!--Google站内搜索开始-->
<!--
	<form class="searchForm" method=get onsubmit="javascript:setSearchDomainGoogle(this)"  action="http://www.google.com/search" target="_blank">
		<input type=text name=q value="请输入关键字" class="searchText" id="searchText" onfocus="checkFocus()" onblur="checkForm()" />
		<input type=submit name=btnG value="" class="searchBtn" />
		<input type=hidden name=ie value=UTF-8 />
		<input type=hidden name=oe value=UTF-8 />
		<input type=hidden name=hl value=zh-CN />
		<input type=hidden name=domains value="ceibsmobi.com" />
		<input type=hidden name=sitesearch value="ceibsmobi.com" />
	</form>
-->
	<!--Google站内搜索结束-->

	<div class="navCon">
		<?=$strPriTypeListHeader?>
	</div>
	<span class="navBj-l"></span>
	<span class="navBj-r"></span>
</div>

