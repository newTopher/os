<?php
/**
 *文本回复
**/
class LiuyanAction extends UserAction{
	//留言列表
	public function index(){
		$db=D('Liuyan');
		$where['token']=session('token');

		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('createtime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('username',$username);
		$this->assign('info',$info);
		$this->display();
	}

	public function add(){
		$this->uid = session('uid');
		$this->token = session('token');
		$this->uptatetime = time();
		$this->createtime = time();
		$this->display();
	}
	//添加留言处理
	public function runAdd(){

		if(IS_POST){
			if($_POST['re']==''){
				$_POST['updatetime'] = null;
			}
			$db = D('Liuyan');
			if($db->add($_POST)){
				$this->success('添加成功',U('Liuyan/index'));
			}else{
				$this->error('添加失败');
			}
			
		}else{
			$this->error('非法操作');
		}
	}

	public function edit(){
		
		$db = D('Liuyan');
		$this->uid = session('uid');
		$this->token = session('token');
		$this->uptatetime = time();
		$id = $_GET['id'];
		$this->info = $db->find($id);
		$this->display();
	}
	public function runEdit(){
		if(IS_POST){
			$db = D('Liuyan');
			if($db->save($_POST)){
				$this->success('回复成功',U('Liuyan/index'));
			}else{
				$this->error('回复失败');
			}
			
		}else{
			$this->error('非法操作');
		}
	}
	//删除留言 
	public function del(){
		
		$id = $_GET['id'];
		if(IS_GET){
			$db = D('Liuyan');
			if($db->delete($id)){
				$this->success('删除成功',U('Liuyan/index'));
			}else{
				$this->error('删除失败');
			}
			
		}else{
			$this->error('非法操作');
		}
	}
	
}
?>