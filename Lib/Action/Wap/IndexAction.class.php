<?php
class IndexAction extends BaseAction{
	private $tpl;	//微信公共帐号信息
	private $info;	//分类信息
	private $wecha_id;
	private $copyright;
	private $pre_url ;
	public function _initialize(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$where['token']=$this->_get('token','trim');
		$tpl=D('Wxuser')->where($where)->find();
		$info=M('Classify')->where(array('token'=>$this->_get('token'),'status'=>1))->order('sorts desc')->select();
		$gid=D('Users')->field('gid')->find($tpl['uid']);
		$copy=D('User_group')->field('iscopyright')->find($gid['gid']);	//查询用户所属组
		$this->copyright=$copy['iscopyright'];
		$this->wecha_id=$this->_get('wecha_id','intval');
		for ($i=0; $i < count($info); $i++) { 
				if(strpos($info[$i]['url'],'m=Lottery'))
			    	$info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Guajiang')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Product')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Card')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Selfform')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Car_baoyang')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Coupon')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Zadan')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Medical')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Vote')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
				else if (strpos($info[$i]['url'],'m=Reservation')) 
			        $info[$i]['url'] .= '&wecha_id='.$this->_get('wecha_user');
								
				
			}
		$this->info=$info;
		$this->tpl=$tpl;
	}
	
	
	public function classify(){
		$this->assign('info',$this->info);
		
		$this->display($this->tpl['tpltypename']);
	}
	
	public function index(){
        $where['token']=$this->_get('token');
        $this->pre_url = substr($_SERVER["HTTP_REFERER"],20);
        $flash=M('Flash')->where($where)->select();
        $speeddial=M('speeddial')->where($where)->find();
		$count=count($flash);
		$this->assign('flash',$flash);
		$this->assign('info',$this->info);
		$this->assign('num',$count);
		$this->assign('tpl',$this->tpl);
		$this->assign('speeddial',$speeddial);
		$this->assign('copyright',$this->copyright);
		$this->display($this->tpl['tpltypename']);
	}
	
	public function lists(){
		$where['token']=$this->_get('token','trim');
		$db=D('Img');
		$p=$this->_get('p','intval',0);
		if($p) $p-=1;
		$where['classid']=$this->_get('classid','intval');
		$res=$db->where($where)->limit(($p*5).',5')->select();
		$count=$db->where($where)->count();
		$p+=1;
		$this->assign('page',(ceil($count/5)));
		$this->assign('p',$p);
		
		$phpSelf = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
		$queryString = '';
		if (!empty($_SERVER['QUERY_STRING']))
		{
		 $queryString = '?' . $_SERVER['QUERY_STRING'];
		}
        $this->assign('pre_url',($phpSelf . $queryString));
		
		$this->assign('info',$this->info);
		$this->assign('tpl',$this->tpl);
		$this->assign('res',$res);
		$this->assign('copyright',$this->copyright);
		$this->display($this->tpl['tpllistname']);
	}
	
	public function content(){
		$db=M('Img');
		$where['token']=$this->_get('token','trim');
		$where['id']=array('neq',(int)$_GET['id']);
		$lists=$db->where($where)->limit(5)->order('uptatetime')->select();

		$where['id']=$this->_get('id','intval');
		$res=$db->where($where)->find();
		$this->assign('info',$this->info);	//分类信息
		$this->assign('lists',$lists);		//列表信息
		$this->assign('res',$res);			//内容详情;
		$this->assign('tpl',$this->tpl);
		$this->assign('copyright',$this->copyright);	//版权是否显示
		$this->display($this->tpl['tplcontentname']);
                $data['click'] = $res['click']+1;
                $db->where('id='.$where['id'])->save($data); 

	}

    public function yifujin_baojia(){
        $db=M('Img');
        $where['token']=$this->_get('token','trim');
        //$where['id']=array('neq',(int)$_GET['id']);
        $where['id']=42;
        $lists=$db->where($where)->limit(5)->order('uptatetime')->select();
        //$where['id']=$this->_get('id','intval');
        $where['id']=42;
        $res=$db->where($where)->find();
        $this->assign('info',$this->info);	//分类信息
        $this->assign('lists',$lists);		//列表信息
        $this->assign('res',$res);			//内容详情;
        $this->assign('tpl',$this->tpl);
        $this->assign('copyright',$this->copyright);	//版权是否显示
        $this->display('baojia_content');
        $data['click'] = $res['click']+1;
        $db->where('id='.$where['id'])->save($data);

    }

    public function yifujin_baojia2(){
        $db=M('Img');
        $where['token']=$this->_get('token','trim');
        //$where['id']=array('neq',(int)$_GET['id']);
        $where['id']=49;
        $lists=$db->where($where)->limit(5)->order('uptatetime')->select();
        //$where['id']=$this->_get('id','intval');
        $where['id']=49;
        $res=$db->where($where)->find();
        $this->assign('info',$this->info);	//分类信息
        $this->assign('lists',$lists);		//列表信息
        $this->assign('res',$res);			//内容详情;
        $this->assign('tpl',$this->tpl);
        $this->assign('copyright',$this->copyright);	//版权是否显示
        $this->display('baojia_content2');
        $data['click'] = $res['click']+1;
        $db->where('id='.$where['id'])->save($data);

    }
	
	public function flash(){
		$where['token']=$this->_get('token','trim');
		$flash=M('Flash')->where($where)->select();
		$count=count($flash);
		$this->assign('flash',$flash);
		$this->assign('info',$this->info);
		$this->assign('num',$count);
		$this->display('ty_index');
	}
	
}