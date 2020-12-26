<!--合作伙伴 start-->
<?
// 合作伙伴列表
$sql_src_list = "SELECT id,src_title,src_img,src_url FROM {$tablehead}src order by id ";
// logString(__FILE__, "sql_src_list: $sql_src_list");
$result_src_list = @mysql_query($sql_src_list,$myconn);

$strSrcs = "\r\n";
for($i=0; $row = mysql_fetch_array($result_src_list); $i++)
{
	$strSrcs .= "\r\n<a href=\"$row[src_url]\" target=\"_blank\">
			<img height=\"70\" width=\"170\" alt=\"$row[src_title]\" src=\"" . ADMIN_ROOT.$row["src_img"] . "\" /></a>";
}
?>

<div id="teamworkMate">
	<div class="teamworkMateCon">
    	<div class="teamworkMateImg">
        	<a href="javascript:void(0);" class="btn-l"><img src="<?=$CONFIG_WEB_URL?>images/btn-l.gif" /></a>
            <div class="teamworkMateImgDiv">
            	<div class="teamworkMateImgDivCon">
                	<?=$strSrcs?>
                </div>            
            </div>
        	<a href="javascript:void(0);" class="btn-r"><img src="<?=$CONFIG_WEB_URL?>images/btn-r.gif" /></a>
        </div>
        <span class="teamworkMateTitle"><a href="<?=$CONFIG_WEB_URL?>partners.php">合作伙伴</a></span>
    </div>
</div>
<!--合作伙伴 end-->

<!--脚注 start-->
<div id="footer">
	<div class="footerCon">
    	<dl class="footerConEng">
        	<dt><a target="_blank" href="http://www.yidianer.com"><img src="<?=$CONFIG_WEB_URL?>images/yidianerLogo.jpg" /></a></dt>
            <dd class="footerConEngDd1">网站友情设计 by 艺点儿艺术平台</dd>
            <dd><a target="_blank" href="http://www.yidianer.com">www.yidianer.com</a></dd>
        	<dd>艺点儿，让生活多一点艺术</dd>
        </dl>
<dl>
</dl>
    	<div class="footerCon-r">
			<a href="<?=$CONFIG_WEB_URL?>news/4.html">关于我们</a>
			丨<a href="<?=$CONFIG_WEB_URL?>news/5.html">联系我们</a>
			丨<a href="http://www.ceibsmobi.com/news/11.html" target="_blank" >加入协会</a>
			丨<a href="<?=$CONFIG_WEB_URL?>partners.php">合作伙伴</a>
            丨<script src="http://static.anquan.org/static/outer/js/official_authen_83x30.js"></script>
			<a href="#top" class="returnTop" title="回到网页顶部">返回顶部</a>
		</div>
    </div>
</div>
<!--脚注 end-->
