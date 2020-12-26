// JavaScript Document
//banner图片轮换
/*$(function(){
	var picIndex=1;//索引值为1
	var picUrl=["images/bannerImg1.gif","images/bannerImg2.gif","images/bannerImg3.gif"]
	function changePic(){		
		$("#pic").css("opacity","0")//改变透明度
		$("#pic").animate({"opacity":"1"})//透明度动画
		$("#pic").attr("src",picUrl[picIndex])//设置图片的src属性值    对象.attr("属性","属性值")
		$(".links a:eq("+picIndex+")").addClass("linksActive").siblings().removeClass("linksActive")//对应的按钮背景变为白色
		picIndex++;//索引值增加
		if(picIndex>2){//当索引值大于2时，索引值为0
			picIndex=0
		}
		if(picIndex==1){
			$(".bannerCon p").replaceWith("<p>中欧校友移动互联网协会成立仪式将于10月13日在上海校区隆重召开</p>")
		}
		if(picIndex==2){
			$(".bannerCon p").replaceWith("<p>中欧校友移动互联网协会成立仪式将于10月13日在上海校区隆重召开222</p>")
		}
		if(picIndex==0){
			$(".bannerCon p").replaceWith("<p>中欧校友移动互联网协会成立仪式将于10月13日在上海校区隆重召开333</p>")
		}
	}
	var bannerTime=setInterval(changePic,3000)//定时器
	$(".links a").mouseover(function(){//当鼠标划过时改变图片和按钮背景颜色
		clearInterval(bannerTime)//停止定时器（切换）
		if(!$("#pic").is(":animated")){//判断是否处于动画状态
			picIndex=$(".links a").index(this)//获取当前鼠标滑过按钮的索引值=当前按钮的索引值
			changePic()//调用函数
		}
	})
	$(".links a").mouseout(function(){//当鼠标离开后重新调用定时器
		bannerTime=setInterval(changePic,3000)
	})
})*/

//合作伙伴，点击按钮左右滚动 
$(function(){ 
	var page=1; 
	var size = $("div.teamworkMateImgDivCon").children("a").length; 
	var pageCount = Math.ceil(size / 4); 
	$(".btn-r").click(function(){ 
		if(!$(".teamworkMateImgDivCon").is(":animated")){//判断是否处于动画状态，返回布尔值 
			if(page >= pageCount){//等于4时，返回第一页 
			$(".teamworkMateImgDivCon").animate({"margin-left":"0"},500) 
				page=1 
			}else{ 
			$(".teamworkMateImgDivCon").animate({"margin-left":"-=840px"},500) 
				page++ 
			} 
		}//and animted 
	}) 
	$(".btn-l").click(function(){ 
		if(!$("div.teamworkMateImgDivCon").is(":animated")){
			if(page == 1){ 
				page=pageCount; 
				movement = 840*(page - 1); 
				$(".teamworkMateImgDivCon").animate({"margin-left":"-" + movement + "px"},500) 
			}else{ 
				$(".teamworkMateImgDivCon").animate({"margin-left":"+=840px"},500) 
				page-- 
			} 
		} 
	}) 
})

/* 收藏本站 */
function addBookmark(title,url) {
	if(!title){title =document.title};
	if(!url){url=window.location.href}
	if (window.sidebar) {
		window.sidebar.addPanel(title,url ,"");
	} else if( document.all ) {
		window.external.AddFavorite(url,title);
	} else {
		alert("抱歉，您的浏览器不支持此操作，请使用 Ctrl+D 添加收藏");;
	}
}

//去掉域名前的 "www."
function getNo3wDomain(domainName) {
	if (domainName.indexOf("www.") == 0)
	{
		return domainName.substring(4);
	}
	else
	{
		return domainName;
	}
}

// 为百度站内搜索动态设置域名
function setSearchDomainBaidu(formname) {
	// baidu
	formname.si.value = getNo3wDomain(window.location.host);
	return true;
}
// 为 google 站内搜索动态设置域名
function setSearchDomainGoogle(formname) {
	// google
	formname.domains.value = getNo3wDomain(window.location.host);
	formname.sitesearch.value = getNo3wDomain(window.location.host);
	return true;
}
