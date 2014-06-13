<?php
class UsersAction extends BaseAction{
	public function index(){
		header("Location: /");
	}

	public function checklogin(){
		$db=D('Users');
		$where['username']=$this->_post('username','trim');
		
		$pwd=$this->_post('password','trim,md5');
		$res=$db->where($where)->find();
		if($res&&($pwd===$res['password'])){
			if($res['status']==0){
				$this->error('请联系在线客户，为你人工审核帐号');exit;
			}
            if(time() > $res['viptime']){
                $this->error('您的账号已到期,请联系在线客户');exit;
            }
            $userModel = M('Wxuser');
            $wxuser = $userModel->where(array('uid'=>$res['id']))->find();
            session('token',$wxuser['token']);
			session('uid',$res['id']);
			session('gid',$res['gid']);
			session('uname',$res['username']);
			session('name',$wxuser['name']);
			session('fakeid',$wxuser['fakeid']);
			$info=M('user_group')->find($res['gid']);
			session('diynum',$res['diynum']);
			session('connectnum',$res['connectnum']);
			session('activitynum',$res['activitynum']);
			session('viptime',$res['viptime']);
			session('gname',$info['name']);
			$tt=getdate();
			if($tt['mday']===1){
				$data['id']=$res['id'];
				$data['imgcount']=0;
				$data['textcount']=0;
				$data['musiccount']=0;
				$data['activitynum']=0;
				$db->save($data);
			}
		
	
			
			
			$this->success('登录成功',U('index.php?g=User&m=Home&a=index'));
		}else{
			$this->error('帐号密码错误',U('Index/login'));
		}
	}
	
	public function checkreg(){
		$db=D('Users');
        C('TOKEN_ON',false);
		$info=M('User_group')->find(1);
        $_POST['viptime'] = time()+3600*24*7;
		if($db->create()){
			$id=$db->add();
			if($id){
                /*
				if(C('ischeckuser')){
					$this->success('注册成功,请联系在线客服审核帐号',U('User/Index/index'));exit;
				}
                */
				session('uid',$id);
				session('gid',1);
				session('uname',$_POST['username']);
				session('diynum',0);
				session('connectnum',0);
				session('activitynum',0);
				session('gname',$info['name']);
		
					
				$this->success('注册成功',U('User/Index/index'),false);
			}else{
				$this->error('注册失败','http://www.wapwei.com/zhuce',false);
			}
		}else{
			$this->error($db->getError(),'http://www.wapwei.com/zhuce',false);
		}
	}
	
	public function checkpwd(){

		$where['username']=$this->_post('username');
		$where['email']=$this->_post('email');
		$db=D('Users');
		$list=$db->where($where)->find();
		if($list==false) $this->error('邮箱和帐号不正确',U('Index/regpwd'));
		
		$smtpserver = C('email_server'); 
		$port = C('email_port');
		$smtpuser = C('email_user');
		$smtppwd = C('email_pwd');
		$mailtype = "TXT";
		$sender = C('email_user');
		$smtp = new Smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender); 
		$to = $list['email']; 
		$subject = C('pwd_email_title');
		$code = C('site_url').U('Index/resetpwd',array('uid'=>$list['id'],'code'=>md5($list['id'].$list['password'].$list['email']),'resettime'=>time()));
		$fetchcontent = C('pwd_email_content');
		$fetchcontent = str_replace('{username}',$where['username'],$fetchcontent);
		$fetchcontent = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$fetchcontent);
		$fetchcontent = str_replace('{code}',$code,$fetchcontent);
		$body=$fetchcontent;
		//$body = iconv('UTF-8','gb2312',$fetchcontent);
		$send=$smtp->sendmail($to,$sender,$subject,$body,$mailtype);
		$this->success('请访问你的邮箱 '.$list['email'].' 验证邮箱后登录!<br/>');
		
	}
	
	public function resetpwd(){
		$where['id']=$this->_post('uid','intval');
		$where['password']=$this->_post('password','md5');
		if(M('Users')->save($where)){
			$this->success('修改成功，请登录！',U('Index/login'));
		}else{
			$this->error('密码修改失败！',U('Index/index'));
		}
	}
	
}