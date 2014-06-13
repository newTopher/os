<?php
class GuajiangAction extends BaseAction{
	public function index(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
	 
		$token	  =  $this->_get('token');
		$wecha_id = $this->_get('wecha_id');
	
		$id 	  = $this->_get('id');

		$redata	  = M('Lottery_record');
		$where	  = array('token'=>$token,'wecha_id'=>$wecha_id,'lid'=>$id,'type'=>2);
		$record   = $redata->where($where)->find();		
		if($record == Null){
			//$redata->add($where);
			//sleep(1);
			$record =$redata->where($where)->find();
		} 

		$Lottery =	M('Lottery')->where(array('id'=>$id,'token'=>$token,'type'=>2,'status'=>1))->find(); 
                $db=M('Lottery');
		$data = array();

		if ($Lottery['enddate'] < time()) {
			 $data['usenums'] = 3;
			 $data['endinfo'] = $Lottery['endinfo'];
			 $this->assign('Guajiang',$data);
			 $this->display();
			 exit();
		}
			if ($record['islottery'] == 1) {
				
				$data['usenums'] = 2;
				$data['sncode']	 = $record['sn'];
				$data['uname']	 = $record['wecha_name'];
				$data['prize'] 	 = $record['prize'];
				$data['winprize']	= '您已经中过奖了';
			}else{
			
				if ($record['usenums'] >= $Lottery['canrqnums'] ) {
					//次数已经达到限定
					$data['usenums'] = 1;
					$data['winprize']	= '抽奖次数已用完';
				}else{
					
					M('Lottery_record')->where(array('id'=>$record['id']))->setInc('usenums');
					$record = M('Lottery_record')->where(array('id'=>$record['id']))->find();
					$prize_arr = array( 
					    '0' => array('id'=>1,'prize'=>'一等奖','v'=>1), 
					    '1' => array('id'=>2,'prize'=>'二等奖','v'=>5), 
					    '2' => array('id'=>3,'prize'=>'三等奖','v'=>10),
					    '3' => array('id'=>4,'prize'=>'谢谢参与','v'=>12)
					);

					foreach ($prize_arr as $key => $val) { 
					    $arr[$val['id']] = $val['v']; 
					} 
			 		if ($Lottery['allpeople'] == 1) {
	 
						if ($Lottery['fistlucknums'] <= $Lottery['fistnums']) {
							$rid = 1;	
						}else{
							$rid = 4;	
						}			
					 
					}else{
						$rid = $this->get_rand($arr); 
                                                $data['joinnum'] = $Lottery['joinnum']+1;
                                                $db->where('id='.$Lottery['id'])->save($data);  
					}
					
				
					$winprize = $prize_arr[$rid-1]['prize'];
					$zjl = false;
					
					switch($rid){
						case 1:
								 
							if ($Lottery['fistlucknums'] > $Lottery['fistnums']) {
								 $zjl = false; 
								 $winprize = '谢谢参与';
							}else{
								
								$zjl	= true;						
							    M('Lottery')->where(array('id'=>$id))->setInc('fistlucknums');
							}
						break;
							
						case 2:
							if ($Lottery['secondlucknums'] > $Lottery['secondnums']) {
									$zjl = false;
									$winprize = '谢谢参与';
							}else{
								//判断是否设置了2等奖&&数量
								if(empty($Lottery['second']) && empty($Lottery['secondnums'])){
									$zjl = false;
									$winprize = '谢谢参与';
								}else{ //输出中了二等奖
									$zjl	= true;						
									M('Lottery')->where(array('id'=>$id))->setInc('secondlucknums');
								}	 
								
							}
						break;
							
						case 3:
							if ($Lottery['thirdlucknums'] > $Lottery['thirdnums']) {
								 $zjl = false;
								 $winprize = '谢谢参与';
							}else{
								if(empty($Lottery['third']) && empty($Lottery['thirdnums'])){
									$zjl = false;
									$winprize = '谢谢参与';
								}else{  
									$zjl	= true;						
									M('Lottery')->where(array('id'=>$id))->setInc('thirdlucknums');
								}	 
								
							}
						break;
							
						default:
								$zjl = false;
								$winprize = '谢谢参与';
								break;
					}
				
				//$data['prizeid']  	= $rid;
				$data['zjl'] 		= $zjl;
				$data['wecha_id']	= $record['wecha_id'];		
				$data['lid']		= $record['lid'];			
				$data['winprize']	= $winprize;
                 
			} //end if;
		} // end first if; 
		
		$data['usecout'] 	= $record['usenums'];
		$data['canrqnums']	= $Lottery['canrqnums'];
		$data['fist'] 		= $Lottery['fist'];
		$data['second'] 	= $Lottery['second'];
		$data['third'] 		= $Lottery['third'];
		$data['fistnums'] 	= $Lottery['fistnums'];
		$data['secondnums'] = $Lottery['secondnums'];
		$data['thirdnums'] 	= $Lottery['thirdnums'];		
		$data['info']		= $Lottery['info'];
		$data['txt']		= $Lottery['txt'];
		$data['sttxt']		= $Lottery['sttxt'];
		$data['title']		= $Lottery['title'];
		$data['statdate']	= $Lottery['statdate'];
		$data['enddate']	= $Lottery['enddate'];
                $data['click'] = $Lottery['click']+1;
                
                $db->where('id='.$Lottery['id'])->save($data); 
		$this->assign('Guajiang',$data);
		$this->display();
		
	}
	
	protected function get_rand($proArr) { 
		    $result = ''; 
		    $proSum = array_sum($proArr); 
		    foreach ($proArr as $key => $proCur) { 
		        $randNum = mt_rand(1, $proSum); 
		        if ($randNum <= $proCur) { 
		            $result = $key; 
		            break; 
		        } else { 
		            $proSum -= $proCur; 
		        } 
		    } 
		    unset ($proArr);
		    return $result; 
	} 
	

	public function add(){
		if($_POST['action'] ==  'add'  ){
			$lid 				= $this->_post('lid');
			$wechaid 			= $this->_post('wechaid');
			$data['phone'] 		= $this->_post('tel');
			$data['wecha_name'] = $this->_post('wxname');
			$data['prize'] = $this->_post('prize');
			$data['islottery'] 	= 1;
			$data['time']		= time();
			$data['sn']			= uniqid();
			$rollback = M('Lottery_record')->where(array('lid'=> $lid,
				'wecha_id'=>$wechaid))->save($data);
			echo'{"success":1,"msg":"恭喜！尊敬的'.$data['wecha_name'].'请您保持手机通畅！请您牢记的领奖号:'.$data['sn'].'"}';
			exit;
		}

		$record = M('Lottery_record');
		$data['phone'] 		= $this->_post('tel');
		$data['wecha_name'] = $this->_post('wxname');
		$data['prize'] = $this->_post('prize');
		$data['islottery'] 	= 1;
		$data['time']		= time();
		$data['sn']			= uniqid();
		$rollback = $record->where(array('lid'=>$this->_post('lid') ,
				'wecha_id'=>$this->_post('wechaid') ))->save($data);


	}
	
}
?>