<?php
class UserAction extends BaseAction{
	protected function _initialize(){
		parent::_initialize();
        $funclist = C('funclist');
        if(session('gid') == 2){
            if(in_array(MODULE_NAME,$funclist[2])){
                $this->error2('您当前使用的是万普展示版还不能使用此功能哦,请联系客服');
            }
        }
        if(session('gid') == 3){
            if(in_array(MODULE_NAME,$funclist[3])){
                $this->error2('您当前使用的是万普功能版还不能使用此功能哦,请联系客服');
            }
        }
		$userinfo=M('User_group')->where(array('id'=>session('gid')))->find();
		$wecha=M('Wxuser')->field('wxname,wxid,weixin,headerpic')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
        $token = session('token');
        $imgsource = M('Img')->field('id,title')->where(array('token'=>$token))->select();
        $lottery = M('Lottery')->field('id,title')->where(array('token'=>$token,'status'=>1))->select();
        $guagua = M('Lottery')->field('id,title')->where(array('token'=>$token,'status'=>2))->select();
        $youhui = M('Lottery')->field('id,title')->where(array('token'=>$token,'status'=>3))->select();
        $zadan = M('Lottery')->field('id,title')->where(array('token'=>$token,'status'=>4))->select();
        $this->assign('imgsource',$imgsource);
        $this->assign('lottery',$lottery);
        $this->assign('guagua',$guagua);
        $this->assign('youhui',$youhui);
        $this->assign('zadan',$zadan);
        $this->assign('wecha',$wecha);
		$this->assign('token',session('token'));
		$this->assign('userinfo',$userinfo);
		$this->assign('gid',session('gid'));
		if(session('uid')==false){
			$this->redirect('Home/Index/login');
		}
        /*if(session('token')==false){
            $this->error('请先绑定您的微信公众账号哦',U('Bind/index'));
        }*/
	}
}