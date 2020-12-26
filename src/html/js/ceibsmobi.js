// JavaScript Document
window.onload=function(){
	//头部时间
	function changeTime(){
		var date=new Date();
		var year=date.getFullYear();  //获取年
		var month=date.getMonth()+1;  //获取月+1  值（0-11）
		var daday=date.getDate();   //获取天
		var week=date.getDay();     //获取星期 值在0-6
			if(week=="0"){week="SUN"}
			else if(week=="1"){week="MON"}
			else if(week=="2"){week="TUE"}
			else if(week=="3"){week="WED"}
			else if(week=="4"){week="THU"}
			else if(week=="5"){week="FRI"}
			else{week="SAT"}
		document.getElementById("year").innerHTML=year;
		document.getElementById("month").innerHTML=month+"月";
		document.getElementById("dayTime").innerHTML=daday;
		document.getElementById("Wednesday").innerHTML=week;
	}
	window.setInterval(changeTime,0)
}
//banner图片轮换
$(function(){
	var picIndex=1;//索引值为1
	var picUrl=["images/bannerImg1.jpg","images/bannerImg2.jpg","images/bannerImg3.jpg"]//图片路径
	/*var imgTitle=["庆祝中欧移动互联网协会成立","美丽风景胜地","欢迎到此一游"]*/
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
			$(".bannerFont h3").replaceWith("<h3>庆祝中欧移动互联网协会成立</h3>")
			$(".bannerFont p").replaceWith("<p>内容：主题：赴美商考——探秘硅谷移动互联网创新之源<br />时间：2012年8月8日-10月12日<br />地点：美国硅谷</p>")
		}
		if(picIndex==2){
			$(".bannerFont h3").replaceWith("<h3>新闻资讯新闻资讯新闻资讯</h3>")
			
			$(".bannerFont p").replaceWith("<p>新闻资讯新闻资讯新闻资讯新闻资讯新闻资讯<br />时间：2012年8月8日-10月12日<br />地点：美国硅谷</p>")
		}
		if(picIndex==0){
			$(".bannerFont h3").replaceWith("<h3>会员介绍会员介绍会员介绍会员介绍</h3>")
			
			$(".bannerFont p").replaceWith("<p>会员介绍会员介绍会员介绍会员介绍会员介绍会员介绍会员介绍会员<br />时间：2012年8月8日-10月12日<br />地点：美国硅谷</p>")
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
})


//会员介绍，点击按钮左右滚动
$(function(){
	var page=1;
	$(".nextBtn").click(function(){
		if(!$(".peopleImgMove").is(":animated")){//判断是否处于动画状态，返回布尔值
			if(page==4){//等于4时，返回第一页
				page=1
				$(".peopleImgMove").animate({"margin-left":"0"},500)
			}else{
				$(".peopleImgMove").animate({"margin-left":"-=565px"},500)
				page++
			}
		}//and animted
	})
	$(".lastBtn").click(function(){
		if(!$(".peopleImgMove").is(":animated")){
			if(page==1){
				page=4
				$(".peopleImgMove").animate({"margin-left":"-1695px"},500)
			}else{
				$(".peopleImgMove").animate({"margin-left":"+=565px"},500)
				page--
			}
		}
	})
})

//合作伙伴，点击按钮左右滚动
$(function(){
	setInterval(function(){$(".teamworkImgMove").animate({"margin-left":"-565px"},1000,function(){
		$(".teamworkImgMove div:first").clone().appendTo(".teamworkImgMove")
		$(".teamworkImgMove div:first").remove()
		$(".teamworkImgMove").css("margin-left","0")
	})},2000)
	
	
	
	var page=1;
	$(".nextBtn2").click(function(){
		if(!$(".teamworkImgMove").is(":animated")){//判断是否处于动画状态，返回布尔值
			if(page==4){//等于4时，返回第一页
				page=1
				$(".teamworkImgMove").animate({"margin-left":"0"},500)
			}else{
				$(".teamworkImgMove").animate({"margin-left":"-=565px"},500)
				page++
			}
		}//and animted
	})
	$(".lastBtn2").click(function(){
		if(!$(".teamworkImgMove").is(":animated")){
			if(page==1){
				page=4
				$(".teamworkImgMove").animate({"margin-left":"-1695px"},500)
			}else{
				$(".teamworkImgMove").animate({"margin-left":"+=565px"},500)
				page--
			}
		}
	})
})
