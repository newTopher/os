<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html style="height:100%">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>万普微信公众平台</title>
    <link rel="stylesheet" href="<?php echo RES;?>/css/bootstrap-cerulean.css" />
    <link rel="stylesheet" href="<?php echo RES;?>/css/charisma-app.css" />
    <link rel="stylesheet" href="<?php echo RES;?>/css/uniform.default.css" />
    <script type="text/javascript" src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo RES;?>/js/notifIt.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/notifIt.css" media="all">

</head>
<style type="text/css">
.choose{width:298px;margin:0 auto 0 auto;padding:15px 15px 15px 15px;}
.choosetext{height:24px;padding:20px 0;font-size:14px;}
.choosebox li{float:left;margin-right:10px;display:inline;}
.choosebox li a{float:left;color:white;font-size:14px;border:1px solid #ccc;height:14px;line-height:14px;padding:30px 10px; display:block;text-decoration:none;
     background:rgb(104, 173, 90);
	 border-radius:5px;
}
.choosebox li a.current{background:url(<?php echo RES;?>/images/right-icon.gif) #369bd7 no-repeat 100% 100%;}
.choosebox li input{display:none;}
no-repeat;cursor:pointer;border:0;}
.choose .btn-img span{display:block;font-size:18px;font-weight:800;color:#fff;font-family:"微软雅黑","宋体";padding:0 0 0 50px;line-height:50px;}
</style>
<body style="height:100%">

<div class="login-container" style="background:url(<?php echo RES;?>/images/loginbg.jpg);background-size: 100%;height:100%; ">
        <div class="row-fluid">
            <div class="span12 center login-header">

            </div><!--/span-->
        </div><!--/row-->

        <div class="row-fluid">
            <div class="well span5 center login-box" style="background: white;">
                <?php if(!empty($errMsg)): ?>
                <div class="alert text-error">
                    <?php echo $errMsg;?>
                </div>
                <?php endif; ?>
                <?php if(empty($errMsg)): ?>
                <div class="alert alert-info" style="font-size: 16px;line-height: 20px;">
                   万普微信公众平台
                </div>
                <?php endif; ?>
                <div class="admin_logo" style="margin-bottom: 10px;">
                    <img src="<?php echo RES;?>/images/admin_logo.jpg" width='80px'>
                </div>

                <div class="choose" id="dress-size">
					<form action="" method="get">
						<div class="choosebox">
							<ul class="clearfix">
								<li>
									<input type="radio" name="name" value="1" id="" />
									<a href="javascript:void(0);" class="size_radioToggle current"><span class="value">微信平台</span></a>
								</li>
								<li>
									<input type="radio" name="name" value="2" id="" />
									<a href="javascript:void(0);" class="size_radioToggle"><span class="value">微信商城</span></a>
								</li>
								<li>
									<input type="radio" name="name" value="3" id="" />
									<a href="javascript:void(0);" class="size_radioToggle"><span class="value">万普动力</span></a>
								</li>
							</ul>
						</div>
					</form>	
				</div>

                <form class="form-horizontal" action="" method="post">
                    <fieldset>
					    <input type="hidden" value="1" id="type" name="type"/>
                        <div class="input-prepend" title="Username" data-rel="tooltip">
                            <span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Password" data-rel="tooltip">
                            <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="" />
                        </div>
                        <!--
                        <div class="clearfix"></div>
                        <div>
                            <?php ?>
                            <input name="verifyCode" style="width:55px;">
                        </div>

                        <div class="input-prepend">
                            <label class="remember" for="remember"><input type="checkbox" id="remember" value="1" name="remember"/>记住我</label>
                        </div>
                        -->
                        <div class="clearfix"></div>

                        <p class="center span5">
                            <button id="bsubmit" type="button" class="btn btn-primary">登陆</button>
                        </p>



                    </fieldset>
                </form>

            </div><!--/span-->
        </div><!--/row-->
        <script type="text/javascript">
            $(function(){
                $("#bsubmit").click(function(){
                    var btn = $(this);
					var type = $("#type").val();
                    if(! $("#username").val()){
                        notif({
                            msg: "请输入万普微盟微信公众平台用户名",
                            type: "warning"
                        });
                        return false;
                    }
                    if(! $("#password").val()){
                        notif({
                            msg: "请输入万普微盟微信公众平台密码",
                            type: "warning"
                        });
                        return false;
                    }
					if(type == 1){
					   url = "<?php echo U('Users/checklogin');?>";
					   $.post(url,{username:$("#username").val(),password:$("#password").val()},function(data){
							if(data.status == 1){
								notif({
									msg: data.info,
									type: "success"
								});
								setTimeout(function(){
									window.location.href = data.url;
								},'2000');
							}else{
								notif({
									msg: data.info,
									type: "error"
								});
							}
						},'json');
					}else if(type == 2){
					   url = "http://vshop.wapwei.com/index.php?app=member&act=login&user_name="+$("#username").val()+"&password="+$("#password").val();
                       window.location.href=url;
					} 

                });
            });

        </script>
<script type="text/javascript">
	$(function(){   
		$('.choosebox li a').click(function(){
			var thisToggle = $(this).is('.size_radioToggle') ? $(this) : $(this).prev();
			var checkBox = thisToggle.prev();
		    if(checkBox.val() == 3){
			    notif({
					msg: "万普动力我们正在内测当中哦,尽请期待!",
					type: "success"
                 });
				 return false;
		    }
			checkBox.trigger('click');
			$('.size_radioToggle').removeClass('current');
			thisToggle.addClass('current');
			return false;
		});		
	});

	$(".choosebox li a").click(function(){
		var type = $(this).prev().val();
		$("#type").val(type);
	});
				
	function getSelectedValue(id){
		return 
		$("#" + id).find(".choosetext span.value").html();
	}
</script>

</body>
</html>