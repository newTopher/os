<?php
/**
 *语音回复
**/
class ClassifyAction extends UserAction{
	public function index(){
		$db=D('Classify');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('sorts desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	
	public function add(){
		$this->display();
	}
	
	public function edit(){
		$id=$this->_get('id','intval');
		$info=M('Classify')->find($id);
		$this->assign('info',$info);
		$this->display();
	}
	
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function insert(){
		$this->all_insert();
	}
	public function upsave(){
		$this->all_save();
	}
	
	 public function getCatid(){	
	   $sid=$_GET['pp'];
	   $where['token']=session('token');
      if ($sid=="微汽车" or $sid=="微会员" or $sid=="微房产" or $sid=="微医疗" or $sid=="微美容"
          or $sid=="微喜帖" or $sid=="微食品" or $sid=="微健身" or $sid=="微政务" or $sid=="微旅游" or $sid=="微花店")
      {  $c= M("ctourl");
	   $where['name']=$sid;
	   $data=$c->where($where)->select();	   
	   echo json_encode($data);}
	   
	   if ($sid=="刮刮卡")
      {  $c= M("lottery");
	   $where['type']=2;
	   $data=$c->where($where)->select();	   
	   echo json_encode($data);}
     if ($sid=="微投票")
     {  $c= M("Vote");
         $data=$c->where($where)->select();
         echo json_encode($data);
     }
     if ($sid=="微相册")
     {  $c= M("Photo");
         $data=$c->where($where)->select();
         echo json_encode($data);
     }
     if ($sid=="微表单")
     {  $c= M("Selfform");
         $data=$c->where($where)->select();
         echo json_encode($data);
     }

     if ($sid=="微信墙")
     {  $c= M("Wxq");
         $data=$c->where($where)->select();
         echo json_encode($data);
     }

     if ($sid=="微全景")
     {  $c= M("Panorama");
         $data=$c->where($where)->select();
         echo json_encode($data);
     }
     if ($sid=="微预约")
     {  $c= M("Yuyue");
         $data=$c->where($where)->select();
         echo json_encode($data);
     }
         if ($sid=="大转盘")
      {  $c= M("lottery");
	   $where['type']=1;
	   $data=$c->where($where)->select();	   
	   echo json_encode($data);} 
	   
	  if ($sid=="优惠券")
      {  $c= M("lottery");
	   $where['type']=3;
	   $data=$c->where($where)->select();	   
	   echo json_encode($data);} 
	   
	     if ($sid=="砸金蛋")
      {  $c= M("lottery");
	   $where['type']=4;
	   $data=$c->where($where)->select();	   
	   echo json_encode($data);} 		
	  // $c= M("Car_cx");
	   //$where['token']=session('token');
	   //$where['pp']=$sid;
	   //$data=$c->where($where)->select();	   
	   //echo json_encode($data);
  }
	
	
}
?>