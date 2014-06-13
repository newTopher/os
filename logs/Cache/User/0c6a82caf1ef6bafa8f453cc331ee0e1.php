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
                        return false;
                    }



                },'json');
                window.location.href = url;
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
                        data-toggle="dropdown" style="width:127px;">
                            <nobr>
                                <?php echo (session('name')); ?>
                                <img src="./upload/weixin_headimg/<?php echo (session('fakeid')); ?>.png"
                                style="width: 27px; height: 27px" alt="<?php echo (session('name')); ?>">
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
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Bind') OR (MODULE_NAME == 'Index') OR (MODULE_NAME == 'Alipay_config') ): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
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
                    <ul class="subnav-menu" style="display: block;">
                        <li>
                            <a href="http://www.weimob.com/wechat/home?aid=116261">
                                微信粉丝
                            </a>
                        </li>
                        <li>
                            <a href="http://www.weimob.com/wechat/home?aid=116261">
                                粉丝消息
                            </a>
                        </li>
                        <li>
                            <a href="http://www.weimob.com/wechat/home?aid=116261">
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
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Home') OR (MODULE_NAME == 'Classify') OR (MODULE_NAME == 'Tmpls') OR (MODULE_NAME == 'Flash') OR (MODULE_NAME == 'Yulan') OR (MODULE_NAME == 'speeddial')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if(MODULE_NAME == 'Home'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Home/set',array('token'=>$token));?>">首页回复配置</a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Classify'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Classify/index',array('token'=>$token));?>">分类管理</a>
                        </li>
                        <li   <?php if(MODULE_NAME == 'Tmpls'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Tmpls/index',array('token'=>$token));?>">微官网风格管理</a>
                        </li>
                        <li   <?php if(MODULE_NAME == 'Flash'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Flash/index',array('token'=>$token));?>">首页轮播图<span class="new"></span></a>
                        </li>
                        <li <?php if(MODULE_NAME == 'Yulan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>>
                        <a  href="<?php echo U('Yulan/index',array('token'=>$token));?>">微网站预览<span class="new"></span></a>
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
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Xt') OR (MODULE_NAME == 'Car_pp') OR (MODULE_NAME == 'Estate') OR (MODULE_NAME == 'Medical') OR (MODULE_NAME == 'Reservation') OR (MODULE_NAME == 'Shipin') OR (MODULE_NAME == 'Jianshen') OR (MODULE_NAME == 'Zhengwu') OR (MODULE_NAME == 'Lvyou') OR (MODULE_NAME == 'Jiaoyu') OR (MODULE_NAME == 'Huadian') OR (MODULE_NAME == 'Wuye') OR (MODULE_NAME == 'Ktv') OR (MODULE_NAME == 'Jiuba') OR (MODULE_NAME == 'Zhuangxiu') OR (MODULE_NAME == 'Hunqing') OR (MODULE_NAME == 'Host')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li <?php if(MODULE_NAME == 'Xt'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Xt/index',array('token'=>$token));?>">微喜贴</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Car'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Car_pp/index',array('token'=>$token));?>">微汽车</a>
                      </li>
                      <li <?php if(MODULE_NAME == 'Estate'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Estate/index',array('token'=>$token));?>">微房产</a>
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
                      <li   <?php if(MODULE_NAME == 'Host'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Host/index',array('token'=>$token));?>">通用订单(酒店,KTV)</a></li>

                    <li   <?php if(MODULE_NAME == 'Adma'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Adma/index',array('token'=>$token));?>">微宣传</a><span class="new"></span></li>
                    <li   <?php if(MODULE_NAME == 'Photo'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Photo/index',array('token'=>$token));?>">微相册</a><span class="new"></span></li>

                    <li   <?php if(MODULE_NAME == 'Selfform'): ?>class="selected"<?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Selfform/index',array('token'=>$token));?>">微表单</a><span class="new"></span></li>
                    <li <?php if(MODULE_NAME == 'Liuyan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Liuyan/index',array('token'=>$token));?>">微留言</a>
                    </li>
                    <li <?php if(MODULE_NAME == 'Vote'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Vote/index',array('token'=>$token));?>">微投票</a>
                    </li>
                    <li   <?php if(MODULE_NAME == 'Wxq'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Wxq/index',array('token'=>$token));?>">微信墙<span class="new"></span></a></li>
                    <li   <?php if(MODULE_NAME == 'Gcard'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Gcard/index',array('token'=>$token));?>">微贺卡<span class="new"></span></a></li>
                    <li <?php if(MODULE_NAME == 'Qj'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Qj/index',array('token'=>$token));?>">360全景接口版</a>
                    </li>
                    <li   <?php if(MODULE_NAME == 'Panorama'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Panorama/index',array('token'=>$token));?>">360全景手动版<span class="new"></span></a>
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
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Lottery') OR (MODULE_NAME == 'Coupon') OR (MODULE_NAME == 'Guajiang') OR (MODULE_NAME == 'Zadan') ): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                        <li   <?php if(MODULE_NAME == 'Lottery'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Lottery/index',array('token'=>$token));?>">幸运大转盘</a><span class="new"></span></li>
                        <li   <?php if(MODULE_NAME == 'Coupon'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Coupon/index',array('token'=>$token));?>">优惠券</a></li>
                        <li   <?php if(MODULE_NAME == 'Guajiang'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Guajiang/index',array('token'=>$token));?>">刮刮卡</a></li>
                            <li   <?php if(MODULE_NAME == 'Zadan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Zadan/index',array('token'=>$token));?>">砸金蛋</a></li>
                            <li   <?php if(MODULE_NAME == 'Zadan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Diaoyan/index',array('token'=>$token));?>">微调研</a></li>
                            <li   <?php if(MODULE_NAME == 'Zadan'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Shake/index',array('token'=>$token));?>">摇一摇</a></li>
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
                        <li <?php if(ACTION_NAME == 'create'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?>> <a href="<?php echo U('Member_card/create',array('token'=>$token));?>">在线开卡(自定义卡号)</a></li>
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
                        <li   <?php if(MODULE_NAME == 'Requery'): ?>class="selected" <?php else: ?>class="subCatalogList"<?php endif; ?> > <a href="<?php echo U('Requery/index',array('token'=>$token));?>" >请求数详情</a>
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
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Requery') OR (MODULE_NAME == 'Member')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                    <li>
                        <a href="http://www.weimob.com/wechat/home?aid=116261">
                            添加个人微信客服
                        </a>
                    </li>
                    <li>
                        <a href="http://www.weimob.com/wechat/home?aid=116261">
                            微信客服管理
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
                                微信独立商城
                            </span>
                        </a>
                    </div>
                    <ul class="subnav-menu" <?php if((MODULE_NAME == 'Requery') OR (MODULE_NAME == 'Member')): ?>style="display:block;" <?php else: ?>style="display:none;"<?php endif; ?>>
                    <li>
                        <a href="http://www.weimob.com/wechat/home?aid=116261">
                            我的微商城
                        </a>
                    </li>

                    </ul>
                </div>
            </div>  
<div class="content right">
         
          <div class="cLineB">
              <h4 class="left">发布会员相关特权</h4>
               
              <div class="clr"></div>
          </div>
          <div class="cLine">
			<div class="pageNavigator left">
				<a href="<?php echo U('Member_card/privilege_add',array('token'=>$token));?>" title="发布会员特权" class="btn btn-primary">
			      发布会员特权
				</a>
			　  <a href="<?php echo U('Member_card/coupon',array('token'=>$token));?>" title="查看优惠券" class="btn btn-primary">
				  查看优惠券
			    </a>　
				<a class="btn btn-primary" href="<?php echo U('Member_card/integral',array('token'=>$token));?>" title="发布礼品券">
				  查看礼品券
				</a>　
			</div>
			<div class="clr"></div>
          </div>
          <div class="msgWrap">
          <form method="post" action="index.php?ac=importtxt&amp;id=9878&amp;wxid=gh_423dwjkewad" id="info">
          <input name="delall" type="hidden" value="del">
           <input name="wxid" type="hidden" value="gh_423dwjkewad">
            <table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
					<th class="select">选择</th>
					<th class="answer">标题</th>
					<th class="category">会员级别</th>
					<th class="time">创建时间</th>
					<th class="time">过期时间</th>
					<th class="edit norightborder">操作</th>
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($data_vip)): $i = 0; $__LIST__ = $data_vip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_vip): $mod = ($i % 2 );++$i;?><tr>
					  <td>  <input type="checkbox" name="del_id[]" value="" class="checkitem"></td>
					  <td><div class="answer_text"><?php echo ($data_vip["title"]); ?></div></td>
					  <td>
						<?php switch($data_vip["group"]): case "1": ?>所有会员<?php break;?>
							<?php case "2": ?>普通会员<?php break;?>
							<?php case "3": ?>银卡会员<?php break;?>
							<?php case "4": ?>金卡会员<?php break;?>
							<?php case "5": ?>钻石卡会员<?php break; endswitch;?>					  
					  </td>
					  <td><?php echo (date('Y-m-d',$data_vip["create_time"])); ?></td>
					  <td><?php if($data_vip['type'] == 1): ?>无时间限制<?php else: echo (date('Y-m-d',$data_vip["enddate"])); endif; ?></td>
					  <td class="norightborder">
						<!--a href="">使用统计</a--> 
						<a href="<?php echo U('Member_card/privilege_edit',array('id'=>$data_vip['id']));?>">编辑</a> <a href="<?php echo U('Member_card/privilege_del',array('id'=>$data_vip['id']));?>">删除</a>
					  </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      			 
              </tbody>
            </table>
           </form> 
			<script>
			   function checkvotethis() {
					var aa=document.getElementsByName('del_id[]');
					var mnum = aa.length;
					j=0;
					for(i=0;i<mnum;i++){
					if(aa[i].checked){
					j++;
					}
					}
					if(j>0) {
					document.getElementById('info').submit();
					} else {
					alert('未选中内容！')
					}
				}
			</script>
          </div>
          <div class="cLine">

            <div class="clr"></div>
          </div>
        </div>
﻿</div>

</body>
</html>