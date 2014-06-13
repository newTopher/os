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
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/wapwei/victor-client.css">

<div class="content right">

<div class="cLineB">
  <h4>我的消息 </h4>
 </div>
    <!--复制开始-->


    <div class="box-content">

        <div class="row-fluid">
            <ul id="custom_group_navigator_div" class="qb_clearfix unstyled">
                <li class="list-box">
                    <div class="list-box__hd list-box__hd_bg_1">今天新增粉丝</div>
                    <div class="list-box__bd">
                        <div class="list-box__count">
                            <strong class="list-box__total" id="NewToday"><?php echo $todayfans;?></strong>
                            <div class="list-box__trend" id="NewToday1" style="display:none;"><i class="icon icon-arrow-down"></i><?php echo $todayfans;?>人</div>
                        </div>

                        <div class="list-box__links"><a href="<?php echo U('Weixinfans/index',array('token'=>$token));?>">详情</a></div>
                    </div>
                </li>

                <li class="list-box">
                    <div class="list-box__hd list-box__hd_bg_1">粉丝总数</div>
                    <div class="list-box__bd">
                        <div class="list-box__count">
                            <strong class="list-box__total" id="NewToday"><?php echo $fans;?></strong>
                            <div class="list-box__trend" id="NewToday1" style="display:none;"><i class="icon icon-arrow-down"></i><?php echo $fans;?>人</div>
                        </div>

                        <div class="list-box__links"><a href="<?php echo U('Weixinfans/index',array('token'=>$token));?>" class="margin-right_m">详情</a></div>
                    </div>
                </li>

                <li class="list-box">
                    <div class="list-box__hd list-box__hd_bg_2">今日用户消息</div>
                    <div class="list-box__bd">
                        <div class="list-box__count">
                            <strong class="list-box__total" id="NewToday"><?php echo $msgs;?></strong>
                            <div class="list-box__trend" id="NewToday1" style="display:none;"><i class="icon icon-arrow-down"></i><?php echo $msgs;?>条</div>
                        </div>

                        <div class="list-box__links"><a href="<?php echo U('Weixinfans/msglist',array('token'=>$token));?>" class="margin-right_m">详情</a></div>
                    </div>
                </li>

                <li class="list-box">
                    <div class="list-box__hd list-box__hd_bg_2">今日用户访问量</div>
                    <div class="list-box__bd">
                        <div class="list-box__count">
                            <strong class="list-box__total" id="NewToday"><?php echo $viewcounts;?></strong>
                            <div class="list-box__trend" id="NewToday1" style="display:none;"><i class="icon icon-arrow-down"></i><?php echo $viewcounts;?></div>
                        </div>

                        <div class="list-box__links"><a href="<?php echo U('Requery/index',array('token'=>$token));?>" class="margin-right_m">详情</a></div>
                    </div>
                </li>

            </ul>

        </div>
    </div>

 <!--复制结束-->
    <div class="cLineB">
        <h4>我的应用 </h4>
    </div>
    <div class="row-fluid app_ico_box" style="margin-left: -23px;">
        <ul>
            <li class="li_first">
                <a href="<?php echo U('Home/set',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/star_64px.png"></a>
                <span class="app_b_title">微官网</span>
            </li>
            <li>
                <a href="<?php echo U('Requery/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/trends_64px.png"></a>
                <span class="app_b_title">数据魔方</span>
            </li>
            <li>
                <a href="<?php echo U('Home/set',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/gear_64px.png"></a>
                <span class="app_b_title">基本设置</span>
            </li>
            <li>
                <a href="<?php echo U('Tmpls/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/layers_64px.png"></a>
                <span class="app_b_title">模版选择</span>
            </li>
            <li>
                <a href="<?php echo U('Diymen/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/bookshelf_64px.png"></a>
                <span class="app_b_title">自定义菜单</span>
            </li>
            <li>
                <a href="<?php echo U('Weixinfans/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/phone_64px.png"></a>
                <span class="app_b_title">微信粉丝</span>
            </li>
            <li>
                <a href="<?php echo U('Weixinfans/msglist',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/chat_64px.png"></a>
                <span class="app_b_title">微信消息</span>
            </li>
            <li>
                <a href="<?php echo U('Member_card/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/creditcard_64px.png"></a>
                <span class="app_b_title">会员卡</span>
            </li>
            <li>
                <a href="<?php echo U('Product/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/tag_64px.png"></a>
                <span class="app_b_title">微商城</span>
            </li>
            <li>
                <a href="<?php echo U('Groupon/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/support_64px.png"></a>
                <span class="app_b_title">微团购</span>
            </li>
            <li>
                <a href="<?php echo U('Product/orders',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/layers_64px.png"></a>
                <span class="app_b_title">微订餐</span>
            </li>
            <li>
                <a href="<?php echo U('Xt/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/book_64px.png"></a>
                <span class="app_b_title">微喜帖</span>
            </li>
            <li>
                <a href="<?php echo U('Car_pp/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/security_64px.png"></a>
                <span class="app_b_title">微汽车</span>
            </li>
            <li>
                <a href="<?php echo U('Estate/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/upload_64px.png"></a>
                <span class="app_b_title">微房产</span>
            </li>
            <li>
                <a href="<?php echo U('Photo/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/tablet_64px.png"></a>
                <span class="app_b_title">微相册</span>
            </li>
            <li>
                <a href="<?php echo U('Guajiang/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/paint_64px.png"></a>
                <span class="app_b_title">刮刮卡</span>
            </li>
            <li>
                <a href="<?php echo U('Lottery/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/piechart_64px.png"></a>
                <span class="app_b_title">大转盘</span>
            </li>
            <li>
                <a href="<?php echo U('Zadan/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/lightbulb_64px.png"></a>
                <span class="app_b_title">砸金蛋</span>
            </li>
            <li>
                <a href="<?php echo U('Kf/addview',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/compose_64px.png"></a>
                <span class="app_b_title">微客服</span>
            </li>
            <li>
                <a href="<?php echo U('Weipay/index',array('token'=>$token));?>"><img src="<?php echo RES;?>/images/app/security_64px.png"></a>
                <span class="app_b_title">微支付</span>
            </li>
        </ul>
    </div>

    <div class="cLineB" style="margin-bottom: 0px;">
        <h4>我的微信公众号 </h4>
    </div>
    <div class="box-content" style="height: 500px;">
        <div class="row-fluid app_ico_box">
            <table class="table table-bordered">
                <tbody>
                <?php if($user['status'] == 1): ?><tr>
                        <td width="200px;">公众号头像</td>
                        <td><img width="60px" height="60px" src="./upload/weixin_headimg/<?php echo $user['fakeid']; ?>.png"></td>
                    </tr>
                    <tr>
                        <td width="200px;">公众账号名称</td>
                        <td><?php echo $user['name']; ?></td>

                    </tr>
                    <tr>
                        <td width="200px;">微信公众账号</td>
                        <td><?php echo $user['wxname']; ?></td>
                    </tr>
                    <tr>
                        <td width="200px;">公众号二维码</td>
                        <td><img width="100px" height="100px" src="./upload/weixin_qrcode/<?php echo $user['fakeid']; ?>.png"></td>
                    </tr>
                    <tr>
                        <td width="200px;">token</td>
                        <td><?php echo $user['token']; ?></td>
                    </tr>
                    <tr>
                        <td width="200px;">url</td>
                        <td>http://v.wapwei.com/index.php?g=Home&m=Weixin&a=index&token=<?php echo $user['token']; ?></td>
                    </tr>
                    <tr>
                        <td>绑定时间</td>
                        <td><?php echo date("Y-m-d H:i:s",$user['bind_time']); ?></td>
                    </tr>

                    <tr>
                        <td>绑定状态</td>
                        <td><span style="font-weight: bold;" class="green">已绑定</span> <a onclick="if(confirm('您确定解除绑定吗?')){ go_url('<?php echo U('Bind/closeBind');?>');}" href="#" class="btn btn-mini btn-danger">解除绑定</a></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td>绑定状态</td>
                        <td><span style="font-weight: bold;" class="green">未绑定</span> <a href="<?php echo U('Bind/index');?>" class="btn btn-mini btn-primary">去绑定</a></td>
                    </tr><?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
 </div>
﻿</div>

</body>
</html>