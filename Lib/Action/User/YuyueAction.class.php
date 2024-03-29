<?php
//web
class YuyueAction extends UserAction{
    public $token;
    public $Yuyue_model;
    public $yuyue_order;
    //public $type;
    //public $selfform_input_model;
    //public $selfform_value_model;
    public function _initialize() {
        parent::_initialize();


        $this->Yuyue_model=M('Yuyue');
        $this->yuyue_order=M('Yuyue_order');
        //$this->selfform_input_model=M('Selfform_input');
        //$this->selfform_value_model=M('Selfform_value');
        $this->token=session('token');
        $this->assign('token',$this->token);
        $this->assign('module','Yuyue');
        $this->type="Yuyue";
        //dump($_SESSION);die;
    }

    //预约列表
    public function index(){

        // $where=array('token'=>$this->token);
        // if(IS_POST){
        // $key = $this->_post('searchkey');
        // if(empty($key)){
        // $this->error2("关键词不能为空");
        // }
        // $where['title|man_name|girl_name|message|address'] = array('like',"%$key%");
        // $list = $this->Yuyue_model->where($where)->order('time DESC')->select();
        // $count      = $this->Yuyue_model->where($where)->count();
        // $Page       = new Page($count,20);
        // $show       = $Page->show();
        // $this->assign('key',$key);
        // }else {
        // $count      = $this->Yuyue_model->where($where)->count();
        // $Page       = new Page($count,20);
        // $show       = $Page->show();
        // $list = $this->Yuyue_model->where($where)->order('starttime DESC')->select();
        // }
        // $this->assign('list',$list);
        // $this->assign('page',$show);
        // $this->display();
        $where = array('token'=> $this->token,'type'=>$this->type);//2013-12-21
        $count      = $this->Yuyue_model->where($where)->count();
        $Page       = new Page($count,20);
        $show       = $Page->show();
        $data = $this->Yuyue_model->where($where)->order('id desc')->select();

        //$type='Yiliao';
        //$this->assign('type',$type);
        $this->assign('page',$show);
        $this->assign('data',$data);
        $this->display();



    }

    //添加预约
    public function add(){

        $_POST['token'] = $this->token;
        $_POST['type']=$this->type; //2013-12-21
        $lbs=M("Company")->where(array('token'=>$this->token))->select();
        $arr=array();
        foreach($lbs as $v){
            $arr[$v['catid']]=array('catid'=>$v['catid'],'address'=>$v['address'],'phone'=>$v['tel'],'latitude'=>$v['latitude'],'longitude'=>$v['longitude']);
        }

        if(IS_POST){
            if($_POST["lbs"]==1){
                $cid=$_POST['cid'];
                $_POST['phone']=$arr[$cid-1]['phone'];
                $_POST['address']=$arr[$cid-1]['address'];
                $_POST['longitude']=$arr[$cid-1]['longitude'];
                $_POST['latitude']=$arr[$cid-1]['latitude'];
                //print_r($_POST);die;
            }
            if($id = $this->Yuyue_model->add($_POST)){
                $keyword_model=M('Keyword');
                $key = array(
                    'keyword'=>$_POST['keyword'],
                    'pid'=>$id,
                    'token'=>$this->token,
                    'module'=> $this->type
                );
                $keyword_model->add($key);
                $this->success2('添加成功！',U($this->type.'/index',array('token'=>$this->token)),false);
            }else{
                $this->error2('添加失败！',false);
            }
        }else{
            $set=array();
            $set['time']=time()+10*24*3600;
            $this->assign('set',$set);
            $this->assign('arr',$arr);
            $this->display('set');
        }
    }

    //修改预约
    public function set(){

        $id = intval($this->_get('id'));
        $checkdata = $this->Yuyue_model->where(array('id'=>$id))->find();
        if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error2("没有相应记录.您现在可以添加.",U($this->type.'/add'),false);
        }
        $lbs=M("Company")->where(array('token'=>$this->token))->select();
        $arr=array();
        foreach($lbs as $v){
            $arr[$v['catid']]=array('catid'=>$v['catid'],'address'=>$v['address'],'phone'=>$v['tel'],'latitude'=>$v['latitude'],'longitude'=>$v['longitude']);
        }
        if(IS_POST){
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
            $check=$this->Yuyue_model->where($where)->find();
            if($check==false)$this->error2('非法操作',U($this->type.'/index',array('token'=>$this->token)),false);
            if($this->Yuyue_model->create()){
                if($_POST["lbs"]==1){
                    $cid=$_POST['cid'];
                    $_POST['phone']=$arr[$cid-1]['phone'];
                    $_POST['address']=$arr[$cid-1]['address'];
                    $_POST['longitude']=$arr[$cid-1]['longitude'];
                    $_POST['latitude']=$arr[$cid-1]['latitude'];
                }
                //print_r($_POST);die;
                if($this->Yuyue_model->where($where)->save($_POST)){
                    $this->success2('修改成功',U($this->type.'/index',array('token'=>$this->token)),false);
                    $keyword_model=M('Keyword');
                    $keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>$this->type))->save(array('keyword'=>$_POST['keyword']));
                }else{
                    $this->error2('操作失败',U($this->type.'/index',array('token'=>$this->token)),false);
                }
            }else{
                $this->error2($this->Yuyue_model->geterror2(),U($this->type.'/index',array('token'=>$this->token)),false);
            }
        }else{
            $this->assign('isUpdate',1);
            $this->assign('set',$checkdata);
            $this->assign('arr',$arr);
            $this->assign('act',$id);
            $this->display();

        }
    }
    //删除预约
    public function del(){
        if($_REQUEST['token']!=$this->token){$this->error2('非法操作');}
        $id = intval($_REQUEST['id']);
        if(IS_POST){
            $where=array('id'=>$id,'token'=>$this->token);
            $wher=array('pid'=>$id,'token'=>$this->token);
            $check=$this->Yuyue_model->where($where)->find();
            if($check==false)   $this->error2('非法操作');
            $back=$this->Yuyue_model->where($where)->delete();
            if($back==true){
                M('Yuyue_order')->where($wher)->delete();
                M('Setinfo')->where($wher)->delete();
                M('Keyword')->where(array('token'=>$this->token,'pid'=>$id,'module'=>$this->type))->delete();
                $this->success2('操作成功',U($this->type.'/index',array('token'=>$this->token)));
            }else{
                $this->error2('服务器繁忙,请稍后再试',U($this->type.'/index',array('token'=>$this->token)));
            }
        }
    }
    //订单列表显示
    public function infos(){
        // $where['xid'] = $this->_get('id');
        // $where['token'] = $this->_get('token');
        // if(IS_POST){

        // $key = $this->_post('searchkey');
        // if(empty($key)){
        // $this->error2("关键词不能为空");
        // }

        // $where['name|content'] = array('like',"%$key%");
        // $list = M('Zhufu')->where($where)->order('time DESC')->select();
        // $count      = M('Zhufu')->where($where)->count();
        // $Page       = new Page($count,20);
        // $show       = $Page->show();
        // $this->assign('key',$key);
        // }else {
        // $count      = M('Zhufu')->where($where)->count();

        // $Page       = new Page($count,20);
        // $show       = $Page->show();
        // $list=M('Zhufu')->where($where)->order('time DESC')->select();
        // }

        // $this->assign('list',$list);
        // $this->assign('page',$show);
        // $this->display();
        $where = array('token'=> $this->token,'pid'=>$this->_get('id'));
        $data = $this->yuyue_order->where($where)->order('id desc')->select();
        $count = $this->yuyue_order->where($where)->count();
        $Page = new Page($count,20);
        $show = $Page->show();

        $this->assign('page',$show);
        $this->assign('data', $data);

        $this->display();

    }

    //订单详细信息
    public function infos_detail(){
        $where = array('token'=> $this->token,'id'=>$this->_get('id'));
        $data = $this->yuyue_order->where($where)->order('id desc')->select();
        $info=$data[0]['fieldsigle'].$data[0]['fielddownload'];
        $info=substr($info,1);
        $info=explode('$',$info);
        $detail=array();
        foreach($info as $v){
            $detail['info'][]=explode('#',$v);
        }
        $detail['all']=$data[0];

        $this->assign('detail', $detail);
        $this->display();
    }

    //删除订单
    public function delinfos(){
        if($this->_get('token')!=$this->token){$this->error2('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){
            $where=array('id'=>$id,'token'=>$this->token);
            $check=M('yuyue_order')->where($where)->find();
            if($check==false)   $this->error2('非法操作');
            $back=M('yuyue_order')->where($where)->delete();
            if($back==true){
                $this->success2('操作成功',U($this->type.'/infos',array('token'=>$this->token,'id'=>$check['pid'])));
            }else{
                $this->error2('服务器繁忙,请稍后再试',U($this->type.'/infos',array('token'=>$this->token,'id'=>$check['xid'])));
            }
        }
    }

    //处理订单
    public function setType(){
        if($this->_get('token')!=$this->token){$this->error2('非法操作');}
        $id = intval($this->_get('id'));
        $type = intval($this->_get('type'));
        $pid = intval($this->_get('pid'));
        if(IS_GET){
            $where = array(
                'id'=> $id,
                'token'=> $this->token,
            );
            $data = array(
                'type'=> $type
            );
            if($this->yuyue_order->where($where)->setField($data)){
                $this->success2('修改成功！',U($this->type.'/infos',array('id'=>$pid,'token'=>$this->token)));
            }else{
                $this->error2('修改失败！');
            }
        }
    }

    public function inputs(){
        $where['xid'] = $this->_get('id');
        $where['token'] = $this->_get('token');
        if(IS_POST){
            $key = $this->_post('searchkey');
            if(empty($key)){
                $this->error2("关键词不能为空");
            }

            $where['name'] = array('like',"%$key%");
            $list = M('Canyu')->where($where)->order('time DESC')->select();
            $count      = M('Canyu')->where($where)->count();
            $Page       = new Page($count,20);
            $show       = $Page->show();
            $this->assign('key',$key);
        }else {
            $count      = M('Canyu')->where($where)->count();

            $Page       = new Page($count,20);
            $show       = $Page->show();
            $list=M('Canyu')->where($where)->order('time DESC')->select();
        }
        $num = 0;
        foreach($list as $key=>$val){
            $num += $val['number'];
        }

        $this->assign('num',$num);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    //类型设置
    public function setcin(){
        $id = $this->_get('id');
        $cin=M('yuyue_setcin');
        $data=$cin->where(array('type'=>$this->type,'pid'=>$id))->select();
        //print_r($data);die;
        $this->assign('id',$id);
        $this->assign('data',$data);
        $this->display();
    }

    //增加类型
    public function addcin(){
        $id = $this->_get('id');
        $cin=M('yuyue_setcin');
        if(IS_POST){
            $_POST['pid']=$id;
            $_POST['type']=$this->type;
            if($cin->add($_POST)){
                //print_r($_POST);die;
                $this->success2('添加成功！',U($this->type.'/setcin',array('id'=>$id,'token'=>$this->token)));
            }else{
                $this->error2('添加失败！');
            }
        }else{
            $this->assign('id',$id);
            $this->display();
        }

    }

    //修改类型
    public function updatecin(){
        $id = $this->_get('id');
        $pid = $this->_get('aid');
        $cin=M('yuyue_setcin');
        $data=$cin->where(array('id'=>$id))->find();

        if(IS_POST){
            //print_r($_POST);die;
            if($cin->where(array('id'=>$id))->save($_POST)){
                $this->success2('修改成功！',U($this->type.'/setcin',array('id'=>$pid,'token'=>$this->token)));
            }else{
                $this->error2('修改失败！');
            }
        }else{
            $this->assign('data',$data);
            $this->assign('id',$pid);
            $this->display('addcin');
        }
    }

    //删除类型
    public function delcin(){
        if($this->_get('token')!=$this->token){$this->error2('非法操作');}
        $id = intval($this->_get('id'));
        $pid = intval($this->_get('aid'));
        $cin=M('yuyue_setcin');

        if(IS_GET){
            $where=array('id'=>$id);
            $check=$cin->where($where)->find();
            if($check==false)   $this->error2('非法操作');
            $back=$cin->where($where)->delete();
            if($back==true){
                $this->success2('操作成功',U($this->type.'/setcin',array('id'=>$pid,'token'=>$this->token)));
            }else{
                $this->error2('服务器繁忙,请稍后再试');
            }
        }

    }

    //订单设置
    public function setinfo(){
        $_POST['token'] = $this->token;
        $pid = $this->_get('id');
        //print_r($_GET["token"]);die;
        //$setinfo=M('setinfo');
        $setinfo=M('Setinfo');
        $data=$setinfo->where(array('token'=>$this->token,'type'=>$this->type,'pid'=>$pid))->select();
        //$nums=$setinfo->where(array('token'=>$_GET["token"]))->count();
        $str=array();
        if(!empty($data)){
            foreach($data as $v){
                $str[$v["name"]]=$v["value"];
            }
        }else{
            $str=array("person" => 1 ,"phone" => 1 ,"date" => 1 ,"time" => 1,);
            $setinfo->add(array('token'=>$this->token,'name'=>'person','value'=>1,'kind'=>1,'type'=>$this->type,'pid'=>$pid));
            $setinfo->add(array('token'=>$this->token,'name'=>'phone','value'=>1,'kind'=>1,'type'=>$this->type,'pid'=>$pid));
            $setinfo->add(array('token'=>$this->token,'name'=>'date','value'=>1,'kind'=>2,'type'=>$this->type,'pid'=>$pid));
            $setinfo->add(array('token'=>$this->token,'name'=>'time','value'=>1,'kind'=>2,'type'=>$this->type,'pid'=>$pid));
        }
        $this->assign('data',$str);
        $arr=$setinfo->where(array('token'=>$this->token,'kind'=>'3','type'=>$this->type,'pid'=>$pid))->select();
        if(empty($arr[0][name])){
            $arr[0][name]="您要预约的医师";
            $arr[0][value]="请输入您要预约的医师名字";
        }

        $this->assign('arr',$arr);
        $list=$setinfo->where(array('token'=>$this->token,'kind'=>'4','type'=>$this->type,'pid'=>$pid))->select();
        if(empty($list[0][name])){
            $list[0][name]="医疗科目";
            $list[0][value]="门诊|急诊|口腔科|神经科";
        }
        //print_r($list);die;
        $this->assign('list',$list);
        $line=$setinfo->where(array('token'=>$this->token,'kind'=>'5','type'=>$this->type,'pid'=>$pid))->select();
        //print_r($line);die;
        //echo $line[0]['id'];die;
        $this->assign('line',$line);
        $check=0;
        //print_r($_POST["person"]);die;
        if(IS_POST){
            foreach($arr as $key=> $val){
                $id[]=$val['id'];
            }
            foreach($list as $key=> $val){
                $id[]=$val['id'];
            }
            for($i=0;$i<12;$i++){
                //echo $_POST['name'.$i];

                if($_POST['name'.$i]!=""){

                    //echo "/3333";
                    $count=$setinfo->count('id');
                    $add['value'] = 1;
                    $add['token'] = $_POST['token'];
                    $add['type'] = $this->type;
                    $add['id']=$_POST['id'.$i];
                    if(in_array($add['id'],$id)){
                        //echo $add['id']."kk";
                        $setinfo->save(array('id'=>$add['id'],'name'=>$_POST['name'.$i],'value'=>$_POST['content'.$i]));
                        $check++;
                    }else{
                        if($i<6){
                            //$add['orderid'] = $count;
                            $add['name']= $_POST['name'.$i];
                            $add['value'] = $_POST['content'.$i];
                            $add['kind']= '3';
                            $add['pid']=$pid;
                            //echo "die;";die;
                            $setinfo->add($add);
                            $check++;

                        }else{
                            $add['name']= $_POST['name'.$i];
                            $add['value'] = $_POST['content'.$i];
                            $add['kind']= '4';
                            $add['pid']= $pid;
                            $add['type'] = $this->type;
                            $setinfo->add($add);
                            $check++;

                        }
                    }

                }else{
                    $add['id']=$_POST['id'.$i];
                    if(in_array($add['id'],$id)){
                        $setinfo->where(array('id'=>$add['id']))->delete();
                        $check++;
                    }
                }

            }
            if(!empty($_POST['id'])){
                $setinfo->save(array('id'=>$_POST['id'],'name'=>$_POST['textname'],'pid'=>$pid));
                $check++;
                //echo '333';die;

            }else{
                $count=$setinfo->count('id');
                $add['token'] = $_POST['token'];
                $add['name'] = $_POST['textname'];
                $add['value'] = $_POST['text'];
                $add['kind'] = '5';
                $add['pid']= $pid;
                $add['type'] = $this->type;
                //print_r($add);die;
                $setinfo->add($add);

                $check++;
            }


        }
        if($check != 0 ){
            $setinfo->where(array('token'=>$this->token,'name'=>'person','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['person']));
            $setinfo->where(array('token'=>$this->token,'name'=>'phone','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['phone']));
            $setinfo->where(array('token'=>$this->token,'name'=>'date','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['date']));
            $setinfo->where(array('token'=>$this->token,'name'=>'time','type'=>$this->type,'pid'=>$pid))->save(array('value'=>$_POST['time']));

            $this->success2('修改成功！',U($this->type.'/index',array('token'=>$this->token)));die;
        }
        $this->display();
    }
}


?>