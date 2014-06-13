<?php
/**
 * Created by IntelliJ IDEA.
 * User: Topher
 * Date: 14-5-28
 * Time: 上午9:51
 * To change this template use File | Settings | File Templates.
 */
class AuthAction extends Action{


    public function index(){
        $code = $_GET['code'];
        $token = $_GET['token'];
        if($token && $code){
            $appdata = M('Diymen_set')->where(array('token'=>$token))->find();
            if($appdata){
                $apiurl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appdata['appid']."&secret=".$appdata['appsecret']."&code=".$code."&grant_type=authorization_code";
                $content = file_get_contents($apiurl);
                $data = json_decode($content);
            }
        }
    }
    //https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2aa2bb12e3f0b17&redirect_uri=http://v.wapwei.com/index.php/Home/Auth/index/token/&response_type=code&scope=snsapi_base&state=1#wechat_redirect


}