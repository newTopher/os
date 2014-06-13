<?php
/**
 * Created by IntelliJ IDEA.
 * User: Topher
 * Date: 14-4-28
 * Time: 上午11:29
 * To change this template use File | Settings | File Templates.
 */
class WeipayAction extends UserAction{

    public $weipay;

    public function _initialize() {
        parent::_initialize();
        $this->weipay=M('Weipay_config');
        if (!$this->token){
            exit();
        }
    }

    public function index(){
        $config = $this->weipay->where(array('token'=>$this->token))->find();
        $user = M('Wxuser')->where(array('token'=>session('token')))->find();
        if(IS_POST){
            $row['appid']=$this->_post('appid');
            $row['appsecret']=$this->_post('appsecret');
            $row['partnerkey']=$this->_post('partnerkey');
            $row['appkey']=$this->_post('appkey');
            $row['token']=session('token');
            $row['uid']=$user['id'];
            if ($config){
                $where=array('token'=>$this->token);
                $this->weipay->where($where)->save($row);
            }else {
                $this->weipay->add($row);
            }
            $this->success('设置成功',U('Weipay/index',$where));
        }else{

            $this->assign('config',$config);
            $this->display();
        }
    }



}