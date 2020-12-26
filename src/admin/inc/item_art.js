var request = false;
try {
  request = new XMLHttpRequest();
} catch (trymicrosoft) {
  try {
    request = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (othermicrosoft) {
    try {
      request = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (failed) {
      request = false;
    }
  }
}

if (!request)
{
  alert("Error initializing XMLHttpRequest!");
}
//////////以上是检测浏览器版本，并且赋予方法
////以下是传递数据
 function getCustomerInfo() {
	 var pritype = document.getElementById("pritype").value;
     var url = "inc/ajax.php?action=item&pritype="+pritype+"&sid="+ Math.random();
	 request.open("GET", url, true);
 request.onreadystatechange = updatePage;
     request.send(null);
   }
   

   function updatePage() {
	    
	        if (request.readyState == 4) 
			{
				//////
	var response = request.responseText.split("|"); //获取值后以 | 为分割为数组，赋值给 response
       if (request.status == 200) 
	   {
		   ////////
         if(response[0] == "1")
	   {
		 
		document.getElementById("sectype").innerHTML = response[1]; //将值传递给DIV标签	
		
	   }else{
		    alert(request.responseText);   //出错，就弹出对话框
	   }
	   /////////
       } else{
         alert("status is " + request.status);  //如果返回结果过程出错的提示
     	 }
	 ////////
   }
   }
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
/////////////////////////////下面是备份的
/*
///以下是获取返回的数据
   function updatePage() {
	    
	        if (request.readyState == 4) 
			{
				//////
	var response = request.responseText.split("|"); //获取值后以 | 为分割为数组，赋值给 response
       if (request.status == 200) 
	   {
		   ////////
         if(response[0] == "1")
	   {
		document.getElementById("stuff1").value = response[1];
		document.getElementById("stuff2").value = response[2];  //将值传递给表单元素
	    document.getElementById("stuff3").innerHTML = response[2];  //将值传递给DIV标签
	   }else{
		    alert(request.responseText);   //出错，就弹出对话框
	   }
	   /////////
       } else{
         alert("status is " + request.status);  //如果返回结果过程出错的提示
     	 }
	 ////////
   }
   }

*/