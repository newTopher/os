<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/index.css"
        media="all">
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/bootstrap_min.css"
        media="all">
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/bootstrap_responsive_min.css"
        media="all">
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/style.css" media="all">
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/themes.css">
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/resource.css">
        <script src="<?php echo RES;?>/js/date/WdatePicker.js"></script>
        <script type="text/javascript" src="<?php echo RES;?>/js/wapwei/jQuery.js">
        </script>
        <script type="text/javascript" src="<?php echo RES;?>/js/wapwei/application.js">
        </script>
        <script type="text/javascript" src="<?php echo RES;?>/js/wapwei/bootstrap_min.js">

        </script>
        <script type="text/javascript" src="<?php echo RES;?>/js/wapwei/notifIt.js"></script>
        <link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
        <link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />
        <script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>
        <script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
        <script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/notifIt.css" media="all">
        <style type="text/css">
            .dropdown-submenu:hover>.dropdown-menu{display:none}
        </style>
        <title>
            <?php echo C('site_title');?> <?php echo C('site_name');?>
        </title>
        <!--[if IE 7]>
            <link href="http://stc.weimob.com/css/font_awesome_ie7.css" rel="stylesheet"
            />
        <![endif]-->
        <!--[if lte IE 8]>
            <script language="javascript" type="text/javascript" src="http://stc.weimob.com/src/excanvas_min.js">
            </script>
        <![endif]-->
        <script>
            var SITEURL = '';
        </script>
        <script type="text/javascript">
            function source_delete(url){
                if(confirm('您确定删除此条记录')){
                    $.post(url,{},function(data){
                        if(data.status == 1){
                            notif({
                                msg: data.info,
                                type: "success"
                            });
                            setTimeout(function(){
                                window.location.href = data.url;
                            },'1000');
                        }else{
                            notif({
                                msg: data.info,
                                type: "error"
                            });
                        }
                    },'json');
                }else{
                    return;
                }
            }

            function go_url(url){
                $.post(url,{},function(data){
                    if(data == null){
                        window.location.href = url;
                    }else{
                        if(data.status == 1){
                            notif({
                                msg: data.info,
                                type: "success"
                            });
                            setTimeout(function(){
                                window.location.href = data.url;
                            },'1000');
                        }else{
                            notif({
                                msg: data.info,
                                type: "error"
                            });
                            if(data.url != null){
                                setTimeout(function(){
                                    window.location.href = data.url;
                                },'1000');
                            }else{
                                setTimeout(function(){
                                    window.location.href = url;
                                },'1000');
                            }
                            return false;
                        }
                    }


                },'json');
           }

            function lbsfunc(){
                notif({
                    width:'100%',
                    msg: '亲,地理位置是智能回复的,只要设置商家地理信息就能自动回复的哦',
                    type: "success"
                });
                return;
            }
        </script>
    </head>
    
    <body>
        <div id="navigation">
            <div class="container-fluid">
                <div>
                    <a href="" target="_self" id="brand">
                        <img src="<?php echo RES;?>/images/logo_wapwei.png" style="width: 100px;">
                    </a>

                </div>

                <div class="user">
                    <ul class="icon-nav">

                        <li class="dropdown sett" style="display:none;">
                            <a href="http://www.weimob.com/wechat/index/aid/116261#" class="dropdown-toggle"
                            data-toggle="dropdown" title="系统设置">
                                <i class="icon-cog">
                                </i>
                            </a>
                        </li>

                            </ul>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="http://www.weimob.com/wechat/index/aid/116261#" class="dropdown-toggle"
                        data-toggle="dropdown" style="min-width:127px;">
                            <nobr style="font-size: 13px">
                                <?php echo (session('name')); ?>
                                <img src="./upload/weixin_headimg/<?php echo (session('fakeid')); ?>.png"
                                style="width: 50px; height: 50px" alt="<?php echo (session('name')); ?>">
                                <span class="caret">
                                </span>
                            </nobr>
                        </a>
                        <ul class="dropdown-menu pull-right" style="min-width: 147px;">
                            <li>
                                <a href="<?php echo U('Admin/Admin/logout');?>" target="_self">
                                    退出
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="content">
            <div id="left" style="overflow: hidden; outline: none;" tabindex="5000">
                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-down">
                            </i>
                            <span>
                                我的万普微盟
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Bind') OR (MODULE_NAME == 'Index') OR (MODULE_NAME == 'Alipay_config') OR (MODULE_NAME == 'Home')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if(MODULE_NAME == 'Home'): ?>class="selected" <?php else: ?> class="subCatalogList"<?php endif; ?>>
                            <a href="<?php echo U('Home/index',array('token'=>$token,'id'=>session('wxid')));?>">
                                我的首页
                            </a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Bind'): ?>class="selected" <?php else: ?> class="subCatalogList"<?php endif; ?>>
                            <a href="<?php echo U('Bind/index',array('token'=>$token,'id'=>session('wxid')));?>">
                                账号绑定
                            </a>
                        </li>
                       <!-- <li <?php if(MODULE_NAME == 'Index'): ?>class="selected" <?php else: ?> class="subCatalogList"<?php endif; ?>>
                            <a href="<?php echo U('Index/edit',array('token'=>$token,'id'=>session('wxid')));?>">
                                个人设置
                            </a>
                        </li>-->
                        <!--<li <?php if(MODULE_NAME == 'Sms'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>>
                        <a href="<?php echo U('Index/editsms',array('id'=>session('wxid')));?>">手机短信通知中心<span class="new"></span></a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Email'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>>
                        <a href="<?php echo U('Index/editemail',array('token'=>$token));?>">邮件通知中心<span class="new"></span></a>
                        </li>-->
                       <li   <?php if(MODULE_NAME == 'Alipay_config'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Alipay_config/index',array('token'=>$token));?>">支付设置</a></li>
                        <li <?php if(MODULE_NAME == 'Index'): ?>class="selected" <?php else: ?> class="subCatalogList"<?php endif; ?>>
                            <a href="<?php echo U('Index/useredit',array('token'=>$token,'id'=>session('wxid')));?>">
                                修改密码
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                               微信基础服务
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Function') OR (MODULE_NAME == 'Fang') OR (MODULE_NAME == 'Areply') OR (MODULE_NAME == 'Text') OR (MODULE_NAME == 'Img') OR (MODULE_NAME == 'Voiceresponse') OR (MODULE_NAME == 'lbslist') OR (MODULE_NAME == 'Index') OR (MODULE_NAME == 'Diymen')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>


                        <li <?php if(MODULE_NAME == 'Areply'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Areply/index',array('token'=>$token));?>">首次关注</a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Text'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Text/index',array('token'=>$token));?>">文本回复</a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Img'): ?>class="selected" <?php else: ?> class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Img/index',array('token'=>$token));?>">图文回复</a>
                        </li>
                       <!-- <li   <?php if(MODULE_NAME == 'Voiceresponse'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Voiceresponse/index',array('token'=>$token));?>">语音回复</a>
                        </li>-->
                        <li   <?php if(MODULE_NAME == 'lbslist'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="#" onclick="lbsfunc()">地理位置(LBS)回复</a><span class="new"></span>
                        </li>
                        <li   <?php if(MODULE_NAME == 'Diymen'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Diymen/index',array('token'=>$token));?>">微信自定义菜单<span class="new"></span></a>
                        </li>

                    </ul>
                </div>

                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-down">
                            </i>
                            <span>
                                我的微信粉丝
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Weixinfans') ): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if(MODULE_NAME == 'Weixinfans'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>>
                            <a href="<?php echo U('Weixinfans/index',array('token'=>$token));?>">
                                微信粉丝
                            </a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Weixinfans'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>>
                            <a href="<?php echo U('Weixinfans/msglist',array('token'=>$token));?>">
                                粉丝消息
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="alert('您还不能测试此功能哦')">
                                粉丝分组
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                微官网设置
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Classify') OR (MODULE_NAME == 'Tmpls') OR (MODULE_NAME == 'Flash') OR (MODULE_NAME == 'Yulan') OR (MODULE_NAME == 'speeddial')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if(MODULE_NAME == 'Home'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Home/set',array('token'=>$token));?>">首页回复配置</a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Classify'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Classify/index',array('token'=>$token));?>">分类管理</a>
                        </li>
                        <li   <?php if(MODULE_NAME == 'Tmpls'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Tmpls/index',array('token'=>$token));?>">微官网风格管理</a>
                        </li>
                        <li   <?php if(MODULE_NAME == 'Flash'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Flash/index',array('token'=>$token));?>">首页轮播图<span class="new"></span></a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Yulan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>>
                        <a  onclick="window.open('<?php echo U('Yulan/index',array('token'=>$token));?>', 'bindweixin', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,title=0,height=1100,width=720');" href="#">微官网预览<span class="new"></span></a>
                        </li>
                        <li   <?php if(MODULE_NAME == 'speeddial'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('speeddial/index',array('token'=>$token));?>">微官网版权与导航<span class="new"></span></a>
                        </li>

                    </ul>
                </div>

                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                微电商
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Groupon') OR (MODULE_NAME == 'Company') OR (MODULE_NAME == 'Product') OR (MODULE_NAME == 'orders') OR (MODULE_NAME == 'Qj') OR (MODULE_NAME == 'Panorama') OR (MODULE_NAME == 'Discount_input')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if((MODULE_NAME == 'Groupon') and (ACTION_NAME == 'index')): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> >

                    <a href="<?php echo U('Groupon/index',array('token'=>$token));?>">微信团购系统</a><span class="new"></span>
                    </li>
                    <li <?php if((MODULE_NAME == 'Company') and (ACTION_NAME == 'index')): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?>>
                    <a href="<?php echo U('Company/index',array('token'=>$token));?>">商家信息</a><span class="new"></span>
                    </li>
                    <li <?php if((MODULE_NAME == 'Product') and (ACTION_NAME == 'index')): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> >
                    <a href="<?php echo U('Product/index',array('token'=>$token));?>">微信商城系统</a><span class="new"></span>
                    </li> 
                    <li <?php if(ACTION_NAME == 'orders'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> >
                    <a href="<?php echo U('Product/orders',array('token'=>$token,'dining'=>1));?>">微信订餐</a><span class="new"></span>
                    </li>

                  <!--  <li <?php if(MODULE_NAME == 'Xt'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Discount_input/index',array('token'=>$token));?>">二维码扫码折扣</a>
                    </li>-->
                    </ul>
                </div>
                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                微应用
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Xt') OR (MODULE_NAME == 'Car_pp') OR (MODULE_NAME == 'Yuyue') OR (MODULE_NAME == 'Estate') OR (MODULE_NAME == 'Medical') OR (MODULE_NAME == 'Reservation') OR (MODULE_NAME == 'Shipin') OR (MODULE_NAME == 'Jianshen') OR (MODULE_NAME == 'Zhengwu') OR (MODULE_NAME == 'Lvyou') OR (MODULE_NAME == 'Jiaoyu') OR (MODULE_NAME == 'Huadian') OR (MODULE_NAME == 'Wuye') OR (MODULE_NAME == 'Ktv') OR (MODULE_NAME == 'Jiuba') OR (MODULE_NAME == 'Zhuangxiu') OR (MODULE_NAME == 'Hunqing') OR (MODULE_NAME == 'Host')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if(MODULE_NAME == 'Xt'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Xt/index',array('token'=>$token));?>">微喜贴</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Car'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Car_pp/index',array('token'=>$token));?>">微汽车</a>
                      </li>
                       <li <?php if(MODULE_NAME == 'Yuyue'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Yuyue/index',array('token'=>$token));?>">微预约</a>
                       </li>
                      <li <?php if(MODULE_NAME == 'Estate'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Fang/index',array('token'=>$token));?>">微房产</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Medical'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Medical/index',array('token'=>$token));?>">微医疗</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Reservation'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Reservation/index',array('token'=>$token));?>">微美容</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Shipin'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Shipin/index',array('token'=>$token));?>">微食品</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Jianshen'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Jianshen/index',array('token'=>$token));?>">微健身</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Zhengwu'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Zhengwu/index',array('token'=>$token));?>">微政务</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Lvyou'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Lvyou/index',array('token'=>$token));?>">微旅游</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Jiaoyu'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Jiaoyu/index',array('token'=>$token));?>">微教育</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Huadian'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Huadian/index',array('token'=>$token));?>">微花店</a>
                      </li>
                      <!--<li   <?php if(MODULE_NAME == 'Host'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Host/index',array('token'=>$token));?>">通用订单(酒店,KTV)</a></li>-->

                    <!--<li   <?php if(MODULE_NAME == 'Adma'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Adma/index',array('token'=>$token));?>">微宣传</a><span class="new"></span></li>-->
                    <li   <?php if(MODULE_NAME == 'Photo'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Photo/index',array('token'=>$token));?>">微相册</a><span class="new"></span></li>

                    <li   <?php if(MODULE_NAME == 'Selfform'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Selfform/index',array('token'=>$token));?>">微表单</a><span class="new"></span></li>
                    <li <?php if(MODULE_NAME == 'Liuyan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Liuyan/index',array('token'=>$token));?>">微留言</a>
                    </li>
                    <li <?php if(MODULE_NAME == 'Vote'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Vote/index',array('token'=>$token));?>">微投票</a>
                    </li>
                    <li   <?php if(MODULE_NAME == 'Wxq'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Wxq/index',array('token'=>$token));?>">微信墙<span class="new"></span></a></li>
                    <li   <?php if(MODULE_NAME == 'Gcard'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Gcard/index',array('token'=>$token));?>">微贺卡<span class="new"></span></a></li>
                    <li   <?php if(MODULE_NAME == 'Panorama'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Panorama/index',array('token'=>$token));?>">微全景<span class="new"></span></a>
                    </li>
                    </ul>
                </div>
                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                微活动
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Lottery') OR (MODULE_NAME == 'Zadan') OR (MODULE_NAME == 'Shake') OR (MODULE_NAME == 'Diaoyan') OR (MODULE_NAME == 'Coupon') OR (MODULE_NAME == 'Guajiang') OR (MODULE_NAME == 'Zadan') ): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li   <?php if(MODULE_NAME == 'Lottery'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Lottery/index',array('token'=>$token));?>">幸运大转盘</a><span class="new"></span></li>
                        <li   <?php if(MODULE_NAME == 'Coupon'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Coupon/index',array('token'=>$token));?>">优惠券</a></li>
                        <li   <?php if(MODULE_NAME == 'Guajiang'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Guajiang/index',array('token'=>$token));?>">刮刮卡</a></li>
                            <li   <?php if(MODULE_NAME == 'Zadan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Zadan/index',array('token'=>$token));?>">砸金蛋</a></li>
                            <li   <?php if(MODULE_NAME == 'Diaoyan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Diaoyan/index',array('token'=>$token));?>">微调研</a></li>
                            <li   <?php if(MODULE_NAME == 'Shake'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="#" onclick="alert('您还有没权限测试此功能')">摇一摇</a></li>
                    </ul>
                </div>
                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                微信会员卡
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Member_card') OR (MODULE_NAME == 'Member')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if((MODULE_NAME == 'Member_card') and (ACTION_NAME == 'index')): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member_card/index',array('token'=>$token));?>">会员卡设计</a></li>
                        <li  <?php if(ACTION_NAME == 'news'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member_card/news',array('token'=>$token));?>">最新通知</a></li>
                        <li <?php if(ACTION_NAME == 'privilege'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member_card/privilege',array('token'=>$token));?>">会员特权</a></li>
                        <li <?php if(ACTION_NAME == 'info'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member_card/info',array('token'=>$token));?>">会员卡详情</a></li>
                        <li <?php if(ACTION_NAME == 'create'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member_card/create',array('token'=>$token));?>">创建会员卡</a></li>
                        <li  <?php if(ACTION_NAME == 'exchange'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member_card/exchange',array('token'=>$token));?>">积分设置</a></li>
                          <li   <?php if(MODULE_NAME == 'Member'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member/index',array('token'=>$token));?>" >会员资料管理</a><span class="new"></span></li>
                    </ul>
                </div>
                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                数据魔方
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Requery') OR (MODULE_NAME == 'Member')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li   <?php if(MODULE_NAME == 'Requery'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Requery/index',array('token'=>$token));?>" >数据魔方</a>
                        </li>
                    </ul>
                </div>

                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                微信客服
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Kf')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                    <li <?php if(MODULE_NAME == 'Kf'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> >
                        <a href="<?php echo U('Kf/addview',array('token'=>$token));?>">
                            添加个人微信客服
                        </a>
                    </li>
                    <li <?php if(MODULE_NAME == 'Kf'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>>
                        <a onclick="alert('您还没有获得此功能权限')" href="#" >
                            查看客服聊天信息
                        </a>
                    </li>

                    </ul>
                </div>



                <div class="subnav">
                    <div class="subnav-title">
                        <a href="javascript:void(0);" class="toggle-subnav">
                            <i class="icon-angle-right">
                            </i>
                            <span>
                                微信支付中心
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Weipay')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                    <li>
                        <a <?php if(MODULE_NAME == 'Weipay'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>  href="<?php echo U('Weipay/index',array('token'=>$token));?>">
                            微信支付配置
                        </a>
                    </li>
                    <li>
                        <a <?php if(MODULE_NAME == 'Requery'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>  href="<?php echo U('Weipay/index',array('token'=>$token));?>">
                           微信支付订单
                         </a>
                    </li>

                    </ul>
                </div>

            </div>
       <div class="content right">

<div class="cLineB">
  <h4>用户首次关注时自动回复的内容 </h4>
 </div>
   <div class="alert alert-info">
       <button type="button" class="close" data-dismiss="alert">×</button>
       <strong>提示信息!</strong>
       <ol>
           <li>在这里设置用户首次关注您的微信公众账号的回复信息</li>
           <li>回复形式分为两种,文字回复和图文回复</li>
           <li>图文回复是自动关联图文回复栏目里面的相同匹配关键词的图文信息列表</li>
       </ol>
   </div>

         <div class="zdhuifu">
                  <form method="post"  action="">
                  <input type="hidden" name="wxid" value="gh_858dwjkeww5"  />
  
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr><td height="5"></td><td></td></tr>
  <tr>
      <td height="40" style="font-size: 14px;">回复类型:</td>
  </tr>
  <tr>
      <td>
          <select id="replay_type" name="type">
              <option value="1">文本回复</option>
              <option value="2">高级回复</option>
          </select>
      </td>
  </tr>
<tr class="text_replay">
<td valign="top" width="50">

<textarea class="px" style="width:500px; height:120px; margin:5px 0"  id="Hfcontent" name="content">
<?php echo ($areply["content"]); ?>
</textarea>
    <div class="e_right"  >
        <ul style="margin-left: 0px;">
            <li class="biaoqing"><span>表情</span>
                <ul>
                    <li><img src="<?php echo RES;?>/images/face/0.gif" alt="微笑" onclick="jsbq('微笑')"></li>
                    <li><img src="<?php echo RES;?>/images/face/1.gif" alt="撇嘴" onclick="jsbq('撇嘴')"></li>
                    <li><img src="<?php echo RES;?>/images/face/2.gif" alt="色" onclick="jsbq('色')"></li>
                    <li><img src="<?php echo RES;?>/images/face/3.gif" alt="发呆" onclick="jsbq('发呆')"></li>
                    <li><img src="<?php echo RES;?>/images/face/4.gif" alt="得意" onclick="jsbq('得意')"></li>
                    <li><img src="<?php echo RES;?>/images/face/5.gif" alt="流泪" onclick="jsbq('流泪')"></li>
                    <li><img src="<?php echo RES;?>/images/face/6.gif" alt="害羞" onclick="jsbq('害羞')"></li>
                    <li><img src="<?php echo RES;?>/images/face/7.gif" alt="闭嘴" onclick="jsbq('闭嘴')"></li>
                    <li><img src="<?php echo RES;?>/images/face/8.gif" alt="睡" onclick="jsbq('睡')"></li>
                    <li><img src="<?php echo RES;?>/images/face/9.gif" alt="大哭" onclick="jsbq('大哭')"></li>
                    <li><img src="<?php echo RES;?>/images/face/10.gif" alt="尴尬" onclick="jsbq('尴尬')"></li>
                    <li><img src="<?php echo RES;?>/images/face/11.gif" alt="发怒" onclick="jsbq('发怒')"></li>
                    <li><img src="<?php echo RES;?>/images/face/12.gif" alt="调皮" onclick="jsbq('调皮')"></li>
                    <li><img src="<?php echo RES;?>/images/face/13.gif" alt="呲牙" onclick="jsbq('呲牙')"></li>
                    <li><img src="<?php echo RES;?>/images/face/14.gif" alt="惊讶" onclick="jsbq('惊讶')"></li>
                    <li><img src="<?php echo RES;?>/images/face/15.gif" alt="难过" onclick="jsbq('难过')"></li>
                    <li><img src="<?php echo RES;?>/images/face/16.gif" alt="酷" onclick="jsbq('酷')"></li>
                    <li><img src="<?php echo RES;?>/images/face/17.gif" alt="冷汗" onclick="jsbq('冷汗')"></li>
                    <li><img src="<?php echo RES;?>/images/face/18.gif" alt="抓狂" onclick="jsbq('抓狂')"></li>
                    <li><img src="<?php echo RES;?>/images/face/19.gif" alt="吐" onclick="jsbq('吐')"></li>
                    <li><img src="<?php echo RES;?>/images/face/20.gif" alt="偷笑" onclick="jsbq('偷笑')"></li>
                    <li><img src="<?php echo RES;?>/images/face/21.gif" alt="可爱" onclick="jsbq('可爱')"></li>
                    <li><img src="<?php echo RES;?>/images/face/22.gif" alt="白眼" onclick="jsbq('白眼')"></li>
                    <li><img src="<?php echo RES;?>/images/face/23.gif" alt="傲慢" onclick="jsbq('傲慢')"></li>
                    <li><img src="<?php echo RES;?>/images/face/24.gif" alt="饥饿" onclick="jsbq('饥饿')"></li>
                    <li><img src="<?php echo RES;?>/images/face/25.gif" alt="困" onclick="jsbq('困')"></li>
                    <li><img src="<?php echo RES;?>/images/face/26.gif" alt="惊恐" onclick="jsbq('惊恐')"></li>
                    <li><img src="<?php echo RES;?>/images/face/27.gif" alt="流汗" onclick="jsbq('流汗')"></li>
                    <li><img src="<?php echo RES;?>/images/face/28.gif" alt="憨笑" onclick="jsbq('憨笑')"></li>
                    <li><img src="<?php echo RES;?>/images/face/29.gif" alt="大兵" onclick="jsbq('大兵')"></li>
                    <li><img src="<?php echo RES;?>/images/face/30.gif" alt="奋斗" onclick="jsbq('奋斗')"></li>
                    <li><img src="<?php echo RES;?>/images/face/31.gif" alt="咒骂" onclick="jsbq('咒骂')"></li>
                    <li><img src="<?php echo RES;?>/images/face/32.gif" alt="疑问" onclick="jsbq('疑问')"></li>
                    <li><img src="<?php echo RES;?>/images/face/33.gif" alt="嘘" onclick="jsbq('嘘')"></li>
                    <li><img src="<?php echo RES;?>/images/face/34.gif" alt="晕" onclick="jsbq('晕')"></li>
                    <li><img src="<?php echo RES;?>/images/face/35.gif" alt="折磨" onclick="jsbq('折磨')"></li>
                    <li><img src="<?php echo RES;?>/images/face/36.gif" alt="衰" onclick="jsbq('衰')"></li>
                    <li><img src="<?php echo RES;?>/images/face/37.gif" alt="骷髅" onclick="jsbq('骷髅')"></li>
                    <li><img src="<?php echo RES;?>/images/face/38.gif" alt="敲打" onclick="jsbq('敲打')"></li>
                    <li><img src="<?php echo RES;?>/images/face/39.gif" alt="再见" onclick="jsbq('再见')"></li>
                    <li><img src="<?php echo RES;?>/images/face/40.gif" alt="擦汗" onclick="jsbq('擦汗')"></li>
                    <li><img src="<?php echo RES;?>/images/face/41.gif" alt="抠鼻" onclick="jsbq('抠鼻')"></li>
                    <li><img src="<?php echo RES;?>/images/face/42.gif" alt="鼓掌" onclick="jsbq('鼓掌')"></li>
                    <li><img src="<?php echo RES;?>/images/face/43.gif" alt="糗大了" onclick="jsbq('糗大了')"></li>
                    <li><img src="<?php echo RES;?>/images/face/44.gif" alt="坏笑" onclick="jsbq('坏笑')"></li>
                    <li><img src="<?php echo RES;?>/images/face/45.gif" alt="左哼哼" onclick="jsbq('左哼哼')"></li>
                    <li><img src="<?php echo RES;?>/images/face/46.gif" alt="右哼哼" onclick="jsbq('右哼哼')"></li>
                    <li><img src="<?php echo RES;?>/images/face/47.gif" alt="哈欠" onclick="jsbq('哈欠')"></li>
                    <li><img src="<?php echo RES;?>/images/face/48.gif" alt="鄙视" onclick="jsbq('鄙视')"></li>
                    <li><img src="<?php echo RES;?>/images/face/49.gif" alt="委屈" onclick="jsbq('委屈')"></li>
                    <li><img src="<?php echo RES;?>/images/face/50.gif" alt="快哭了" onclick="jsbq('快哭了')"></li>
                    <li><img src="<?php echo RES;?>/images/face/51.gif" alt="阴险" onclick="jsbq('阴险')"></li>
                    <li><img src="<?php echo RES;?>/images/face/52.gif" alt="亲亲" onclick="jsbq('亲亲')"></li>
                    <li><img src="<?php echo RES;?>/images/face/53.gif" alt="吓" onclick="jsbq('吓')"></li>
                    <li><img src="<?php echo RES;?>/images/face/54.gif" alt="可怜" onclick="jsbq('可怜')"></li>
                    <li><img src="<?php echo RES;?>/images/face/55.gif" alt="菜刀" onclick="jsbq('菜刀')"></li>
                    <li><img src="<?php echo RES;?>/images/face/56.gif" alt="西瓜" onclick="jsbq('西瓜')"></li>
                    <li><img src="<?php echo RES;?>/images/face/57.gif" alt="啤酒" onclick="jsbq('啤酒')"></li>
                    <li><img src="<?php echo RES;?>/images/face/58.gif" alt="篮球" onclick="jsbq('篮球')"></li>
                    <li><img src="<?php echo RES;?>/images/face/59.gif" alt="乒乓" onclick="jsbq('乒乓')"></li>
                    <li><img src="<?php echo RES;?>/images/face/60.gif" alt="咖啡" onclick="jsbq('咖啡')"></li>
                    <li><img src="<?php echo RES;?>/images/face/61.gif" alt="饭" onclick="jsbq('饭')"></li>
                    <li><img src="<?php echo RES;?>/images/face/62.gif" alt="猪头" onclick="jsbq('猪头')"></li>
                    <li><img src="<?php echo RES;?>/images/face/63.gif" alt="玫瑰" onclick="jsbq('玫瑰')"></li>
                    <li><img src="<?php echo RES;?>/images/face/64.gif" alt="凋谢" onclick="jsbq('凋谢')"></li>
                    <li><img src="<?php echo RES;?>/images/face/65.gif" alt="示爱" onclick="jsbq('示爱')"></li>
                    <li><img src="<?php echo RES;?>/images/face/66.gif" alt="爱心" onclick="jsbq('爱心')"></li>
                    <li><img src="<?php echo RES;?>/images/face/67.gif" alt="心碎" onclick="jsbq('心碎')"></li>
                    <li><img src="<?php echo RES;?>/images/face/68.gif" alt="蛋糕" onclick="jsbq('蛋糕')"></li>
                    <li><img src="<?php echo RES;?>/images/face/69.gif" alt="闪电" onclick="jsbq('闪电')"></li>
                    <li><img src="<?php echo RES;?>/images/face/70.gif" alt="炸弹" onclick="jsbq('炸弹')"></li>
                    <li><img src="<?php echo RES;?>/images/face/71.gif" alt="刀" onclick="jsbq('刀')"></li>
                    <li><img src="<?php echo RES;?>/images/face/72.gif" alt="足球" onclick="jsbq('足球')"></li>
                    <li><img src="<?php echo RES;?>/images/face/73.gif" alt="瓢虫" onclick="jsbq('瓢虫')"></li>
                    <li><img src="<?php echo RES;?>/images/face/74.gif" alt="便便" onclick="jsbq('便便')"></li>
                    <li><img src="<?php echo RES;?>/images/face/75.gif" alt="月亮" onclick="jsbq('月亮')"></li>
                    <li><img src="<?php echo RES;?>/images/face/76.gif" alt="太阳" onclick="jsbq('太阳')"></li>
                    <li><img src="<?php echo RES;?>/images/face/77.gif" alt="礼物" onclick="jsbq('礼物')"></li>
                    <li><img src="<?php echo RES;?>/images/face/78.gif" alt="拥抱" onclick="jsbq('拥抱')"></li>
                    <li><img src="<?php echo RES;?>/images/face/79.gif" alt="强" onclick="jsbq('强')"></li>
                    <li><img src="<?php echo RES;?>/images/face/80.gif" alt="弱" onclick="jsbq('弱')"></li>
                    <li><img src="<?php echo RES;?>/images/face/81.gif" alt="握手" onclick="jsbq('握手')"></li>
                    <li><img src="<?php echo RES;?>/images/face/82.gif" alt="胜利" onclick="jsbq('胜利')"></li>
                    <li><img src="<?php echo RES;?>/images/face/83.gif" alt="抱拳" onclick="jsbq('抱拳')"></li>
                    <li><img src="<?php echo RES;?>/images/face/84.gif" alt="勾引" onclick="jsbq('勾引')"></li>
                    <li><img src="<?php echo RES;?>/images/face/85.gif" alt="拳头" onclick="jsbq('拳头')"></li>
                    <li><img src="<?php echo RES;?>/images/face/86.gif" alt="差劲" onclick="jsbq('差劲')"></li>
                    <li><img src="<?php echo RES;?>/images/face/87.gif" alt="爱你" onclick="jsbq('爱你')"></li>
                    <li><img src="<?php echo RES;?>/images/face/88.gif" alt="NO" onclick="jsbq('NO')"></li>
                    <li><img src="<?php echo RES;?>/images/face/89.gif" alt="OK" onclick="jsbq('OK')"></li>
                    <li><img src="<?php echo RES;?>/images/face/90.gif" alt="爱情" onclick="jsbq('爱情')"></li>
                    <li><img src="<?php echo RES;?>/images/face/91.gif" alt="飞吻" onclick="jsbq('飞吻')"></li>
                    <li><img src="<?php echo RES;?>/images/face/92.gif" alt="跳跳" onclick="jsbq('跳跳')"></li>
                    <li><img src="<?php echo RES;?>/images/face/93.gif" alt="发抖" onclick="jsbq('发抖')"></li>
                    <li><img src="<?php echo RES;?>/images/face/94.gif" alt="怄火" onclick="jsbq('怄火')"></li>
                    <li><img src="<?php echo RES;?>/images/face/95.gif" alt="转圈" onclick="jsbq('转圈')"></li>
                    <li><img src="<?php echo RES;?>/images/face/96.gif" alt="磕头" onclick="jsbq('磕头')"></li>
                    <li><img src="<?php echo RES;?>/images/face/97.gif" alt="回头" onclick="jsbq('回头')"></li>
                    <li><img src="<?php echo RES;?>/images/face/98.gif" alt="跳绳" onclick="jsbq('跳绳')"></li>
                    <li><img src="<?php echo RES;?>/images/face/99.gif" alt="挥手" onclick="jsbq('挥手')"></li>
                    <li><img src="<?php echo RES;?>/images/face/100.gif" alt="激动" onclick="jsbq('激动')"></li>
                    <li><img src="<?php echo RES;?>/images/face/101.gif" alt="街舞" onclick="jsbq('街舞')"></li>
                    <li><img src="<?php echo RES;?>/images/face/102.gif" alt="献吻" onclick="jsbq('献吻')"></li>
                    <li><img src="<?php echo RES;?>/images/face/103.gif" alt="左太极" onclick="jsbq('左太极')"></li>
                </ul>
            </li>
        </ul>
    </div>
   </td>

</tr>
<tr class="text_replay">
    <td>
    <p style="line-height: 30px;">
        <input id="home" name="home" type="checkbox" <?php if($areply['home'] == 1): ?>checked="checked"<?php endif; ?> value="1"   /><span class="help-inline">勾选此项请填写关键词,我们将检索关键词相关的图文信息最多回复9条信息</span></p>
        <p>
    关键词：<input type="input" style="width:100px;" class="px" id="keyword" value="<?php echo ($areply["keyword"]); ?>" name="keyword" style="width:300px" ><span class="help-inline">如：填写"万普微盟",系统会检索包含最近发布的9条信息</span>
    </td>
</tr>
<tr class="high_replay" style="display: none;">
  <td>
      <select id="mod_id" name="mod_id">
          <option value="">请选择</option>
          <optgroup label="基本功能"></optgroup>
          <option value="首页">|___微官网</option>
          <optgroup label="图文素材"></optgroup>
          <?php if($imgsource != null): if(is_array($imgsource)): $i = 0; $__LIST__ = $imgsource;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="I_<?php echo ($vo["id"]); ?>">|___<?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
          <optgroup label="大转盘"></optgroup>
          <?php if($lottery != null): if(is_array($lottery)): $i = 0; $__LIST__ = $lottery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="l_<?php echo ($vo["id"]); ?>">|___<?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
          <optgroup label="刮刮卡"></optgroup>
          <?php if($guagua != null): if(is_array($lottery)): $i = 0; $__LIST__ = $lottery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="l_<?php echo ($vo["id"]); ?>">|___<?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>

          <optgroup label="优惠券"></optgroup>
          <?php if($youhui != null): if(is_array($lottery)): $i = 0; $__LIST__ = $lottery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="l_<?php echo ($vo["id"]); ?>">|___<?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
      </select>
  </td>
</tr>
<tr>
<td height="150">
       
<button type="button" id="bsubmit"  name="sbmt"   class="btn btn-primary left" >保存</button>

<script type="text/javascript">
function jsbq(srt){
document.getElementById("Hfcontent").value=document.getElementById("Hfcontent").value+"/"+srt;
}
</script>


</td><td valign="top">
</tr>
</table>
</form>
                   
               </div>
        </div>

        <div class="clr"></div>
      </div>
    </div>
  </div>
  <script>
$(document).ready( function(){ 
$('.checkall').click(function(){

$('.checkitem').each(function(){
$(this).attr('checked',$('.checkall').attr('checked'));
});
});

});
  </script>
  <!--底部-->
  	</div>
<script type="text/javascript">
    $(function(){
        $("#replay_type").change(function(){
            if($(this).val() == 2){
                $(".text_replay").hide();
                $(".high_replay").show();
            }else if($(this).val() == 1){
                $(".text_replay").show();
                $(".high_replay").hide();
            }

        });

        $("#bsubmit").click(function(){
            var content = $("#Hfcontent").val();
            var home = $("input[name='home']:checked").val();
            var keyword = $("input[name='keyword']").val();
            if(! content){
                notif({
                    msg: "首次回复的内容不能为空哦",
                    type: "warning"
                });
                return false;
            }


            $.post("<?php echo U('Areply/insert');?>",{content:content,home:home,keyword:keyword},function(data){
                if(data.status == 1){
                    notif({
                        msg: data.info,
                        type: "success"
                    });
                    setTimeout(function(){
                        window.location.href = data.url;
                    },'1000');
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
﻿</div>

</body>
</html>