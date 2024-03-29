<?php
class FangAction extends BaseAction{

    public $token;
    public $Fang;
    public $Fang_hu;
    public $Fang_photo;
    public $Fang_effect;
    public $Fang_dianping;
    public $wecha_id;
    public $Fang_yuyue;
    public $Fang_yuyue_order;

    public function __construct(){

        parent::__construct();
        $this->token=session('token');
        // $this->token = $this->_get('token');
        $this->assign('token',$this->token);
        $this->Fang=M('fang');
        $this->Fang_hu=M('fang_hu');
        $this->Fang_photo=M('fang_photo');
        $this->Fang_dianping=M('fang_dianping');
        $this->Fang_effect=M('fang_effect');

        $this->wecha_id	= $this->_get('wecha_id');
        if (!$this->wecha_id){
            $this->wecha_id='null';
        }
        $this->assign('wecha_id',$this->wecha_id);
        $this->Fang_yuyue=M('yuyue');
        $this->Fang_yuyue_order=M('yuyue_order');
        $this->type='Fang';



    }

    public function index(){
        $where=array('token'=> $this->_get('token'));
        $wecha_id = $this->_get('wecha_id');
        //print_r($wecha_id);die;
        $data=$this->Fang->where($where)->field('id,slide1,slide2,slide3')->find();
        $id = $this->Fang_yuyue->where(array('token'=>$this->_get('token'),'type'=>$this->type))->field('id')->find();
        $this->assign('id',$id);
        $this->assign('data',$data);
        $this->display();

    }
    //楼盘简介
    public function index_info(){
        $pid = $this->_get('pid');
        $token = $this->_get('token');
        if(!empty($pid)){
            $where=array('id'=> $this->_get('pid'));
        }else{
            $where=array('token'=> $this->_get('token'));
        }
        $data=$this->Fang->where($where)->find();
        $data['lou_info'] = stripslashes($data['lou_info']);
        $data['hu_info'] = stripslashes($data['hu_info']);
        $data['jiao_info'] = stripslashes($data['jiao_info']);
        $data['url'] = "http://map.baidu.com/?location=".$data['longitude'].",".$data['latitude'];
        $this->assign('data',$data);
        $this->display();
    }
    //户型简介
    public function hu_index(){
        $pid = $this->_get('pid');
        $token = $this->_get('token');
        if(!empty($pid)){
            $where=array('pid'=> $this->_get('pid'));
        }else{
            $where=array('token'=> $this->_get('token'));
        }
        $data=$this->Fang->where(array('id'=>$this->_get('pid')))->field('title,hu_top_topic')->find();
        //print_r($data);die;
        $arr = $this->Fang_hu->where($where)->select();
        $this->assign('data',$data);
        $this->assign('arr',$arr);
        $this->display();
    }
    //楼盘户型图
    public function hu_photo(){
        $where = array('id' => $this->_get('id'));
        $arr = $this->Fang_hu->where($where)->find();
        //print_r($arr);die;
        $this->assign('arr',$arr);
        $this->display();

    }
    //楼盘户型全景图
    public function panoramic_photo(){

        $this->display();

    }
    //楼盘相册
    public function photo_index(){
        $pid = $this->_get('pid');
        $token = $this->_get('token');
        if(!empty($pid)){
            $where=array('pid'=> $this->_get('pid'));
        }else{
            $where=array('token'=> $this->_get('token'));
        }
        $data = $this->Fang_photo->where($where)->order('show_order desc')->select();
        //print_r($data);die;
        $this->assign('data',$data);
        $this->display();
    }
    //相册显示
    public function photo_info(){

        $where = array('id' =>$this->_get('id'));

        $data = $this->Fang_photo->where($where)->field('topic1,topic2,topic3,topic4,topic5,topic6,topic7,topic8')->find();
        //print_r($data);die;
        $this->assign('data',$data);
        $this->display();
    }
    //印象管理
    public function effect_index(){
        $pid = $this->_get('pid');
        $token = $this->_get('token');
        if(!empty($pid)){
            $where=array('pid'=> $this->_get('pid'));
            $wher = array('pid' => $this->_get('pid'),'show'=>1);
        }else{
            $where=array('token'=> $this->_get('token'));
            $wher = array('token' => $this->_get('token'),'show'=>1);
        }
        $data = $this->Fang_dianping->where($where)->order('show_order desc')->select();

        $arr = $this->Fang_effect->where($wher)->order('show_order desc')->select();
        //print_r($arr);die;
        $sum = $this->Fang_effect->where($wher)->field('effect')->select();
        //print_r($sum);die;
        $sums=0;
        foreach($sum as $key=>$val){
            $sums=$sums+$val['effect'];
        }

        foreach($arr as $key=>$val){
            $arr[$key]['sum']=intval($val['effect']/$sums*100);

        }


        $this->assign('arr',$arr);

        $this->assign('data',$data);
        $this->display();

    }
    public function news(){
        $News=M('img');
        $Classify = M('classify');
        $where = array('pid' => $this->_get('pid'));
        $list = $News->where($where)->field('id,pic,title,text,uptatetime')->select();
        $arr = $Classify->where($where)->order('sorts desc')->field('img,url,info')->find();
        //print_r($arr);die;
        foreach($list as $key => $value){
            $list[$key]['uptatetime']=date('Y-m-d',$value['uptatetime']);
        }

        //print_r($list);die;
        $this->assign('list',$list);
        $this->assign('arr',$arr);
        $this->display();
    }
    public function news_info(){
        $where = array('pid' => $this->_get('pid'),'id' =>$this->_get('id'));
        $News=M('img');
        $data=$News->where($where)->field('pic,title,info,uptatetime')->find();

        $data['uptatetime']=date('Y-m-d',$data['uptatetime']);

        $this->assign('data',$data);
        $this->display();

    }
    public function yuyue_index(){
        $pid = $this->_get('id');
        $where = array('id'=>$pid);
        //print_r($where);die;
        $data = $this->Fang_yuyue->where($where)->find();
        $info = M('yuyue_setcin')->where(array('pid'=>$pid,'type'=>$this->type))->select();
        //echo 11;print_r($data);die;
        $data['count'] = $this->Fang_yuyue_order->where(array('token'=> $this->_get('token'),'pid'=>$pid))->count();
        $data['token'] = $this->_get('token');
        $data['wecha_id'] = $this->_get('wecha_id');
        //print_r($info);die;
        $this->assign('data', $data);
        $this->assign('info', $info);
        $this->display();
    }
    public function yuyue_info(){
        //echo 11;die;
        $pid = $this->_get('id');
        $id = $this->_get('aid');
        $where = array('token'=> $this->_get('token'),'id'=>$pid);

        $cast = array(
            'token'=> $this->_get('token'),
            'wecha_id'=> $this->_get('wecha_id')
        );
        $info = M('yuyue_setcin')->where(array('id'=>$id))->find();
        $info['sheng']=$info['yuanjia']-$info['youhui'];
        $data = $this->Fang_yuyue->where($where)->find();
        for($i=1;$i<6;$i++){
            if(!empty($info['pic'.$i])){
                $info['pic'][]=$info['pic'.$i];
                unset($info['pic'.$i]);
            }
        }
        //print_r($data);print_r($info);die;
        $data['token'] = $this->_get('token');
        $data['wecha_id'] = $this->_get('wecha_id');
        $wap= M('setinfo')->where(array('type'=>$this->type,'pid'=>$pid))->select();
        $str=array();
        foreach($wap as $v){
            if($v['kind']==5){
                $str["message"]=$v["name"];
            }
            else{
                $str[$v["name"]]=$v["value"];
            }
        }
        //print_r($str);die;
        $arr= M('setinfo')->where(array('kind'=>'3','type'=>$this->type,'pid'=>$pid))->select();
        $list= M('setinfo')->where(array('kind'=>'4','type'=>$this->type,'pid'=>$pid))->select();
        $list_arr =array();
        $i=0;
        foreach($list as $v){
            $list[$i]['value']= explode("|",$v['value']);
            $i++;
        }
        //print_r($info);die;
        $this->assign('type',$this->type);
        $this->assign('str', $str);
        $this->assign('arr',$arr);
        $this->assign('list',$list);
        $this->assign('list_arr',$list);
        $this->assign('data', $data);
        $this->assign('info', $info);
        $this->display();
    }

    //添加订单
    public function yuyue_add(){
        //print_r($_POST);die;
        if(IS_POST){
            $url = U($this->type.'/yuyue_order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid']));
            $url = substr($url,1);
            $_POST['date']= date("Y-m-d H:i:s",time());
            if($this->Fang_yuyue_order->add($_POST)){
                $json = array(
                    'error'=> 1,
                    'msg'=> '添加成功！',
                    'url'=> $url,
                );
                echo  json_encode($json);
            }else{
                $json = array(
                    'error'=> 0,
                    'msg'=> '添加失败！',
                    'url'=> $url,
                );
                echo  json_encode($json);
            }
        }
    }

    //订单列表
    public function yuyue_order(){
        /*$id = $this->_get('id');
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $where = array(
            'wecha_id'=> $wecha_id,
            'pid'=> $id
        );
        $data = $this->Fang_yuyue_order->where($where)->select();
        $info= $this->Fang_yuyue->where(array('token'=> $this->_get('token'),'id'=>$id))->find();
        //print_r($data);die;
        $this->assign('data',$data);
        $this->assign('info',$info);
        $this->display();*/

        $id = $this->_get('id');
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $where = array(
            'wecha_id'=> $wecha_id,
            'pid'=> $id
        );
        $data = $this->Fang_yuyue_order->where($where)->order('id desc')->select();
        $info= $this->Fang_yuyue->where(array('token'=> $this->_get('token'),'id'=>$id))->find();
        //print_r($data);die;
        $this->assign('data',$data);
        $this->assign('info',$info);
        $this->display();
    }

    //修改订单视图
    public function yuyue_set(){
        $id = $this->_get('id');
        $pid = $this->_get('pid');

        $cast = array(
            'token'=> $this->_get('token'),
            'wecha_id'=> $this->_get('wecha_id')
        );
        $data = M('yuyue_order')->where(array('id'=>$id))->find();
        $info = M('yuyue_setcin')->where(array('name'=>$data['kind']))->find();
        $info['sheng']=$info['yuanjia']-$info['youhui'];

        //print_r($data);print_r($info);die;
        $copyright=$this->Fang_yuyue->where(array('token'=> $this->_get('token'),'id'=>$pid))->find();
        $data['copyright']=$copyright['copyright'];
        //print_r($copyright);die;
        $data['token'] = $this->_get('token');
        $data['wecha_id'] = $this->_get('wecha_id');
        $wap= M('setinfo')->where(array('token'=> $this->token,'type'=>$this->type,'pid'=>$pid))->select();
        $str=array();
        foreach($wap as $v){
            if($v['kind']==5){
                $str["message"]=$v["name"];
            }
            else{
                $str[$v["name"]]=$v["value"];
            }
        }
        //print_r($str);die;
        $arr= M('setinfo')->where(array('token'=>$this->token,'kind'=>'3','type'=>$this->type,'pid'=>$pid))->select();
        $list= M('setinfo')->where(array('token'=>$this->token,'kind'=>'4','type'=>$this->type,'pid'=>$pid))->select();
        $list_arr =array();
        $i=0;
        foreach($list as $v){
            $list[$i]['value']= explode("|",$v['value']);
            $i++;
        }
        //print_r($list);die;

        $text=$data['fieldsigle'];
        $down=$data['fielddownload'];
        $text=substr($text,1);
        $down=substr($down,1);
        $text=explode('$',$text);
        $down=explode('$',$down);
        $detail=array();
        $i=1;
        foreach($text as $v){
            $detail['text'][$i]=explode('#',$v);
            $i++;
        }
        $i=1;
        foreach($down as $v){
            $detail['down'][$i]=explode('#',$v);
        }
        //print_r($detail);die;

        $this->assign('detail', $detail);

        $this->assign('str', $str);
        $this->assign('arr',$arr);
        $this->assign('list',$list);
        $this->assign('list_arr',$list);
        $this->assign('data', $data);
        $this->assign('info', $info);
        $this->display();
    }

    //修改订单
    public function yuyue_runSet(){

        $id = $_GET['id'];
        if(IS_POST){
            $url = U($this->type.'/yuyue_order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
            $url = substr($url,1);
            $where = array(
                'id' =>$id
            );
            $_POST['date']= date("Y-m-d H:i:s",time());
            if($this->Fang_yuyue_order->where($where)->save($_POST)){
                $json = array(
                    'error'=> 1,
                    'msg'=> '修改成功！',
                    'url'=> $url,
                );
                echo  json_encode($json);
            }else{
                $json = array(
                    'error'=> 0,
                    'msg'=> '修改失败！',
                    'url'=> $url,
                );
                echo  json_encode($json);
            }
        }

    }

    //删除订单
    public function yuyue_del(){
        if(IS_POST){
            $url = U($this->type.'/yuyue_order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
            $url = substr($url,1);
            $where = array(
                'id' =>$_POST['id']
            );
            if($this->Fang_yuyue_order->where($where)->delete()){
                $json = array(
                    'error'=> 1,
                    'msg'=> '删除成功！',
                    'url'=> $url
                );
                echo  json_encode($json);
            }else{
                $json = array(
                    'error'=> 0,
                    'msg'=> '删除失败！',
                    'url'=> $url
                );
                echo  json_encode($json);
            }
        }
    }

}

?>