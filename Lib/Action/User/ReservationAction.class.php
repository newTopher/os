<?php

class ReservationAction extends UserAction{
	public function index(){
		$token_open=M('token_open')->field('queryname')->where(array('token'=>$_SESSION['token']))->find();
		/*if(!strpos($token_open['queryname'],'Reservation')){
            $this->error2('您还未开启该模块的使用权,请到功能模块中添加',U('Reservation/index',array('token'=>$_SESSION['token'],'id'=>session('wxid'))));}	
		*/
        $db=D('Reservation');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();	
		$infoa=M('Reservation_setup_control')->where(array('token'=>$this->_GET('token')))->find();	
		$tj=M('Reservation')->where(array('token'=>$this->_GET('token')))->count();
		$this->assign('tj',$tj);	
		$this->assign('page',$page->show());
		$this->assign('infoa',$infoa);
		$this->assign('info',$info);
		$this->display();
	}
	public function add(){
	$infoa=M('Reservation_setup_control')->where(array('token'=>$this->_GET('token')))->find();
	$this->assign('infoa',$infoa);
		$this->display();
	}	
	public function edit(){
		$id=$this->_get('id','intval');
		$info=M('Reservation')->find($id);
		$this->assign('info',$info);
		$this->display();
	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
		M('Keyword')->where(array('pid'=>$where['id'],'token'=>session('token'),'module'=>'Reservation'))->delete();
			$this->success2('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error2('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function insert(){			
	$tj=M('Reservation')->where(array('token'=>SESSION('token')))->count();
	if($tj==0){
	$this->all_insert2();
	}
	else
	{
	$this->error2('操作失败',U(MODULE_NAME.'/index'));
	}
	}
	public function upsave(){
	$token=$this->_get('token');
$infoa=M('Reservation')->where(array('token'=>$this->_GET('token')))->find();
	$this->assign('infoa',$infoa);
	$this->all_save2();
	}
}
?>
