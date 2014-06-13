<?php
/**
 * Created by IntelliJ IDEA.
 * User: Topher
 * Date: 14-4-26
 * Time: 下午4:26
 * To change this template use File | Settings | File Templates.
 */
class WeixinfansAction extends UserAction{

    public function index(){
        $usersModel = M('Wxusers');
        $wxuser = M('Wxuser')->where(array('token'=>session('token')))->find();

        import('ORG.Util.Page');// 导入分页类
        $count      = $usersModel->where(array('uid'=>$wxuser['id'],'status'=>1))->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list =  $usersModel->order('add_time desc')->where(array('uid'=>$wxuser['id'],'status'=>1))->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function userview(){
        $id = $_GET['id'];
        $usersModel = M('Wxusers');
        $userinfo = $usersModel->where(array('id'=>$id))->find();

        $wxuser = M('Wxuser')->where(array('token'=>session('token')))->find();

        $where =  "uid=".$wxuser['id']." And from_openid = '".$userinfo['openid']."' or to_openid='".$userinfo['openid']."'";
        $msgList = M('Msg_list')->order('add_time','desc')->where($where)->select();

        import('ORG.Util.Page');// 导入分页类
        $count      = M('Msg_list')->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $this->assign('userinfo',$userinfo);
        $this->assign('page',$show);
        $this->assign('msglist',$msgList);
        $this->assign('fakeid',$wxuser['fakeid']);
        $this->display();
    }

    public function sendmsg(){
        $content = $_REQUEST['content'];
        $openid = $_REQUEST['openid'];
        $fakeid = $_REQUEST['fakeid'];
        if(!empty($fakeid)){
            $wxuser = M('Wxuser')->where(array('token'=>session('token')))->find();
            if(!empty($wxuser['wx_a']) &&  !empty($wxuser['wx_p'])){
                Vendor('weixin.WX_Remote_Opera');
                $ro = new WX_Remote_Opera();
                $token=$ro->test_login($wxuser['wx_a'],$wxuser['wx_p']);
                if($token){
                    $ro->init($wxuser['wx_a'],$wxuser['wx_p']);
                    //Array ( [wx_account] => diaobaojiecao [fakeid] => 3083415613 [nickname] => 屌爆段子 [ghid] => gh_8da4455c132d )
                    $ro->sendmsg($content,$fakeid,$token);
                    $msglistModel = M('Msg_list');
                    $mdata = array();
                    $mdata['uid'] = $wxuser['id'];
                    $mdata['to_openid'] = $openid;
                    $mdata['from_openid'] = $wxuser['wx_openid'];
                    $mdata['content'] =$content;
                    $mdata['type'] = 'text';
                    $mdata['add_time'] = time();
                    $msglistModel->data($mdata)->add();
                }
            }
        }
    }

    public function msglist(){
        $wxuser = M('Wxuser')->where(array('token'=>session('token')))->find();
        $msgList = M('Msg_list')->order('add_time desc')->where(array('uid'=>$wxuser['id'],'to_openid'=>$wxuser['wx_openid']))->select();
        $wxusers = M('Wxusers');
        foreach($msgList as $k=>$v){
            $temp= array();
            $temp = $wxusers->field('id,fakeid')->where(array('openid'=>$v['from_openid'],'uid'=>$wxuser['id']))->find();
            $msgList[$k]['fakeid'] = $temp['fakeid'];
            $msgList[$k]['uid'] = $temp['id'];
        }

        import('ORG.Util.Page');// 导入分页类
        $count      = M('Msg_list')->where(array('uid'=>$wxuser['id'],'to_openid'=>$wxuser['wx_openid']))->count();// 查询满足要求的总记录数
        $Page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);
        $this->assign('msglist',$msgList);
        $this->display();
    }




}