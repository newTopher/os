<?php

class Car_guanhuaiAction extends UserAction{
	public function index(){
		
		
		$token_open=M('token_open')->field('queryname')->where(array('token'=>$_SESSION['token']))->find();

		/*if(!strpos($token_open['queryname'],'Car')){
            $this->error2('您还未开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>$_SESSION['token'],'id'=>session('wxid'))));}
		*/
		$db=D('Car_guanhuai');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	
	public function add(){
		$this->display();
	}
	
	public function edit(){
		$id=$this->_get('id','intval');
		$info=M('Car_guanhuai')->find($id);
		$this->assign('info',$info);
		$this->display();
	}
	
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			M('Keyword')->where(array('pid'=>$where['id'],'token'=>session('token'),'module'=>'Car_guanhuai'))->delete();
			$this->success2('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error2('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function insert(){
		$this->all_insert2();
	}
	public function upsave(){
		$this->all_save2();
	}
}
?>