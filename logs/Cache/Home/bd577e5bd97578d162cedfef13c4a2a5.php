<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="height:100%">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>万普微盟微信公众平台</title>
    <link rel="stylesheet" href="<?php echo RES;?>/css/bootstrap-cerulean.css" />
    <link rel="stylesheet" href="<?php echo RES;?>/css/charisma-app.css" />
    <link rel="stylesheet" href="<?php echo RES;?>/css/uniform.default.css" />
    <script type="text/javascript" src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo RES;?>/js/notifIt.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/notifIt.css" media="all">

</head>
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
                万普微盟微信公众平台
            </div>
            <?php endif; ?>
            <div class="admin_logo" style="margin-bottom: 10px;">
                <img src="<?php echo RES;?>/images/admin_logo.jpg" width='80px'>
            </div>

            <form class="form-horizontal" action="" method="post">
                <fieldset>
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
                $.post("<?php echo U('Users/checklogin');?>",{username:$("#username").val(),password:$("#password").val()},function(data){
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

            });
        });

    </script>

</body>
</html>