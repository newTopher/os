<?php
//wap留言模块

class LiuyanAction extends BaseAction{
	public $token;
	public $wecha_id;
	public function __construct(){
		parent::__construct();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		$this->token = $this->_get('token');
		$this->assign('token',$this->token);
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='null';
		}
		$this->assign('wecha_id',$this->wecha_id);
		
	}

	//留言列表视图
	public function index(){
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		$this->uid = session('uid');
		$this->createtime = time();
		$db = M('liuyan');
		$rep = M('reply_info');
		$this->repic = $rep->where(array('infotype'=> "Liuyan", 'token'=> $this->token))->field('picurl')->find();
		$this->info = $db->order('createtime')->where(array('token'=> $this->token))->order('createtime DESC')->select();
		$this->display();

	}


	
	public function add(){
		if($_POST['action'] == 'liuyan'){
			
			$db = M('liuyan');

			if($db->add($_POST)){
				echo '留言成功';
			}else{
				echo '留言失败';
			}
		}
	}
	
	
	//删除留言处理
	public function del(){
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		$db = M('liuyan');
		$id = $_GET['id'];
		if(IS_GET){
			$db = M('Liuyan');
			$db->delete($id);
			
			header("location:".U('Liuyan/index',array('token'=> $this->token, 'wecha_id'=> $this->wecha_id)));
		}


}

















}







?>