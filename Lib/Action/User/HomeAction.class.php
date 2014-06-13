<?php
class HomeAction extends UserAction{

    /*
    public function _initialize() {
		
		parent::_initialize();
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'shouye')){
            	$this->error('您未开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));
		}
		
	}
    */
    public function index(){
        $token = $this->_get('token');
        if(isset($token)){
            $res = M('Wxuser')->where(array('token'=>$token))->find();
            if($res){
                $this->assign('user',$res);
            }
        }else{
            $res = M('Wxuser')->where(array('token'=>session('token')))->find();
            if($res){
                $this->assign('user',$res);
            }
        }
        $fans = M('Wxusers')->where(array('uid'=>$res['id'],'status'=>1))->count();
        $where['uid']=$res['id'];
        $where['status']=1;
        $time = strtotime(date("Y-m-d")." 00:00:00");
        $where['add_time']=array('between',array($time,$time+3600*24));
        $todayfans = M('Wxusers')->where($where)->count();
        $msgwhere['add_time'] = array('between',array($time,$time+3600*24));
        $msgwhere['uid']=$res['id'];
        $msgs = M('Msg_list')->where($msgwhere)->count();
        $fans = $res['wxfans']+$fans;

        $adminuser = M('users')->field('viptime,is_dz,id')->where(array('id'=>$res['uid']))->find();

        $year=date("Y",time());
        $data = date("d",time());
        if(empty($month)){
            $month=date("m",time());
        }
        $db=D('Requestdata');
        $vwhere['token']=session('token');
        $vwhere['month']=$month;
        $vwhere['year']=$year;
        $list=$db->where($vwhere)->find();
        $viewcounts = $list['3g']+$list['textnum']+$list['imgnum']+$list['videonum']+$list['videonum'];
        $this->assign('viewcounts',$viewcounts);


        $this->assign('fans',$fans);
        $this->assign('adminuser',$adminuser);
        $this->assign('todayfans',$todayfans);
        $this->assign('msgs',$msgs);
        $this->display();
    }
	
	
	public function set(){
		$home=M('Home')->where(array('token'=>session('token')))->find();
		if(IS_POST){
			if($home==false){				
				$this->all_insert('Home','/set');
			}else{
				$_POST['id']=$home['id'];
				$this->all_save('Home','/set');				
			}
		}else{
			$this->assign('home',$home);
			$this->display();
		}
	}
	
}



?>