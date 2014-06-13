<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding:0 0 48px;margin:150px auto;width:400px;background: rgba(238, 238, 238, 0.43);}
.system-message h3{ font-size: 50px; font-weight: normal; line-height: 120px; margin-bottom: 12px;border:1px solid #ccc}
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 23px ;text-align: center;}
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
	<p style="height:35px;background:#1c86d1;padding-left:10px;line-height:35px;color:white;border-radius: 5px;">万普微盟</p>
	<div style="padding:24px;">
		<present name="message">		
		<div class="success"><?php echo($message); ?></span></div>
		<else/>		
		<div class="error"><span style="padding-top:0px;"><?php echo($error); ?></div>
		</present>
	
	</div>
<p class="detail"></p>
<div class="jump" style="float:right;padding-right:5px;">
<a id="href" href="<?php echo($jumpUrl); ?>"></a><b id="wait"><?php echo($waitSecond); ?></b>
</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>