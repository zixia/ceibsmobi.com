<link rel="stylesheet" type="text/css" href="<?=$CONFIG_WEB_URL?>styles/style.css" />
<script type="text/javascript">
//表单验证
	function $(id){
		return document.getElementById(id)
	}
	function checkFocus(){
		document.getElementById("searchText").value=""
		document.getElementById("searchText").className="changeUsername"
	}
	function checkForm(){
		if(document.getElementById("searchText").value==""){
			document.getElementById("searchText").value="请输入关键字"
			document.getElementById("searchText").className="searchText"
		}
	}
</script>
<script type="text/javascript" src="<?=$CONFIG_WEB_URL?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=$CONFIG_WEB_URL?>js/ceibsmobi.js"></script>
