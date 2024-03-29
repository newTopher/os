<?php
class GuajiangAction extends UserAction{
	public function index(){
		$token_open=M('token_open')->field('queryname')->where(array('token'=>$_SESSION['token']))->find();

		/*
		if(session('gid')==1){
			$this->error2('测试用户还不能使用哦',U('Home/Index/price'));
		}
		*/
		$user=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
		$group=M('User_group')->where(array('id'=>$user['gid']))->find();
		$this->assign('group',$group);
		$this->assign('activitynum',$user['activitynum']);
		$list=M('Lottery')->field('id,title,joinnum,click,keyword,statdate,enddate,status')->where(array('token'=>session('token'),'type'=>2))->select();
		//dump($list);
		$this->assign('count',M('Lottery')->where(array('token'=>session('token'),'type'=>2))->count());
		$this->assign('list',$list);
		$this->display();	
	}
	public function sn(){		
		
		if(session('gid')==1){
			$this->error2('测试用户还不能使用哦');
		}
		$id=$this->_get('id');
		
				$data=M('Lottery')->where(array('token'=>session('token'),'id'=>$id,'type'=>2))->find();	
		
		
		if(IS_POST){
				$key = $this->_post('searchkey');
				if(empty($key)){
					$this->error2("关键词不能为空");}
		$record=M('Lottery_record')->where('token="'.session('token').'" and lid='.$id.' and sn="'.$key.'"')->select();
		$recordcount=M('Lottery_record')->where('token="'.session('token').'" and lid='.$id.' and sn="'.$key.'"')->count();
				}
		else
		{
		$record=M('Lottery_record')->where('token="'.session('token').'" and lid='.$id.' and sn!=""')->select();
		$recordcount=M('Lottery_record')->where('token="'.session('token').'" and lid='.$id.' and sn!=""')->count();

		}
		$datacount=$data['fistnums']+$data['secondnums']+$data['thirdnums'];
		$sendCount=M('Lottery_record')->where('lid='.$id.' and sendstutas=1 and sn!=""')->count();
		$this->assign('sendCount',$sendCount);
		$this->assign('datacount',$datacount);
		$this->assign('recordcount',$recordcount);
		$this->assign('record',$record);
	
		$this->display();
	
	
	}
	public function add(){
		if(session('gid')==1){
			$this->error2('测试用户还不能使用哦');
		}
		if(IS_POST){		
			$data=D('lottery');
			$_POST['statdate']=strtotime($_POST['statdate']);
			$_POST['enddate']=strtotime($_POST['enddate']);
			$_POST['token']=session('token');		
			if($data->create()!=false){				
				if($id=$data->add()){
					$data1['pid']=$id;
					$data1['module']='Lottery';
					$data1['token']=session('token');
					$data1['keyword']=$_POST['keyword'];
					M('Keyword')->add($data1);
					$user=M('Users')->where(array('id'=>session('uid')))->setInc('activitynum');
					$this->success2('活动创建成功',U('Guajiang/index'));
				}else{
					$this->error2('服务器繁忙,请稍候再试');
				}
			}else{
				$this->error2($data->geterror2());
			}
			
			
		}else{
			$this->display();
		}
	}
	public function setinc(){
		if(session('gid')==1){
			$this->error2('测试用户还不能使用哦');
		}
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$check=M('Lottery')->where($where)->find();
		if($check==false)$this->error2('非法操作');
		$user=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
		$group=M('User_group')->where(array('id'=>$user['gid']))->find();
		
		if($user['activitynum']>=$group['activitynum']){
			$this->error2('测试用户还不能使用哦');
		}
		$data=M('Lottery')->where($where)->setInc('status');
		if($data!=false){
			$this->success2('恭喜你,活动已经开始');
		}else{
			$this->error2('服务器繁忙,请稍候再试');
		}

	}
	public function setdes(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$check=M('Lottery')->where($where)->find();
		if($check==false)$this->error2('非法操作');
		$da['status']='0';
		$data=M('Lottery')->where($where)->save($da);
		if($data!=false){
			$this->success2('活动已经结束','index.php?g=User&m=Guajiang&a=index&token='.$_SESSION['token']);
		}else{
			$this->error2('服务器繁忙,请稍候再试','index.php?g=User&m=Guajiang&a=index&token='.$_SESSION['token']);
		}
	
	}
	public function edit(){
		if(IS_POST){
			$data=D('Lottery');
			$_POST['id']=$this->_get('id');
			$_POST['token']=session('token');
			$where=array('id'=>$_POST['id'],'token'=>$_POST['token'],'type'=>2);
			$_POST['statdate']=strtotime($_POST['statdate']);
			$_POST['enddate']=strtotime($_POST['enddate']);			
			$check=$data->where($where)->find();
			if($check==false)$this->error2('非法操作');
			if($data->create()){				
				if($id=$data->where($where)->save($_POST)){
					$data1['pid']=$_POST['id'];
					$data1['module']=$name;
					$data1['token']=session('token');
					$da['keyword']=$_POST['keyword'];
					M('Keyword')->where($data1)->save($da);
					$this->success2('修改成功');
				}else{
					$this->error2('操作失败');
				}
			}else{
				$this->error2($data->geterror2());
			}
			
		}else{
			$id=$this->_get('id');
			$where=array('id'=>$id,'token'=>session('token'),'type'=>2);
			$data=M('Lottery');
			$check=$data->where($where)->find();
			if($check==false)$this->error2('非法操作');
			$lottery=$data->where($where)->find();		
			$this->assign('vo',$lottery);
			//dump($lottery);
			$this->display('add');
		}
	
	}
	public function del(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$data=M('Lottery');
		$check=$data->where($where)->find();
		if($check==false)$this->error2('非法操作');
		$back=$data->where($wehre)->delete();
		if($back==true){
			M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Lottery'))->delete();
			$this->success2('删除成功');
		}else{
			$this->error2('操作失败');
		}
	
	
	}
	
	public function sendprize(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$data['sendtime'] = time();
		$data['sendstutas'] = 1;
		$back = M('Lottery_record')->where($where)->save($data);
		if($back==true){
			$this->success2('成功发奖');
		}else{
			$this->error2('操作失败');
		}
	}
	
	public function sendnull(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$data['sendtime'] = '';
		$data['sendstutas'] = 0;
		$back = M('Lottery_record')->where($where)->save($data);
		if($back==true){
			$this->success2('已经取消');
		}else{
			$this->error2('操作失败');
		}
	}
}


?>