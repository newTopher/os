<?php
class AlipayAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $alipayConfig;
	public function __construct(){
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->token){
			//
			$product_cart_model=M('product_cart');
			$out_trade_no = $this->_get('out_trade_no');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
			if (!$order){
				$order=$product_cart_model->where(array('id'=>intval($this->_get('out_trade_no'))))->find();
			}
			$this->token=$order['token'];
		}
		//读取支付宝配置
		$alipay_config_db=M('Alipay_config');
		$this->alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();
	}
	public function pay(){
	$price=$_GET['price'];
		$orderName=$_GET['orderName'];
		$orderid=$_GET['orderid'];
		if (!$orderid){
			$orderid=$_GET['single_orderid'];//单个订单
		}
		//
		$alipayConfig=$this->alipayConfig;
		//
		if(!$price)exit('必须有价格才能支付');
		import("@.ORG.Alipay.alipay_submit");
		
	
	
		
		$format = "xml";
//必填，不需要修改

//返回格式
$v = "2.0";
//必填，不需要修改

//请求号
$req_id = date('Ymdhis');
//必填，须保证每次请求都是唯一

//**req_data详细信息**

//服务器异步通知页面路径
$notify_url = C('site_url').'/index.php/Wap/Alipay/notify_url';
//需http://格式的完整路径，不允许加?id=123这类自定义参数

//页面跳转同步通知页面路径
$call_back_url = C('site_url').'/index.php/Wap/Alipay/return_url';
//需http://格式的完整路径，不允许加?id=123这类自定义参数

//操作中断返回地址
$merchant_url = "http://127.0.0.1:8800/WS_WAP_PAYWAP-PHP-UTF-8/xxxx.php";
//用户付款中途退出返回商户的地址。需http://格式的完整路径，不允许加?id=123这类自定义参数

//卖家支付宝帐户
$seller_email =trim($alipayConfig['name']);
//必填

//商户订单号
$out_trade_no = $orderid;
//商户网站订单系统中唯一订单号，必填

//订单名称
$subject = $orderName;
//必填

//付款金额
$total_fee = floatval($price);
//必填

//请求业务参数详细
$req_data = '<direct_trade_create_req><notify_url>' . $notify_url . "</notify_url><call_back_url>" . $call_back_url . "</call_back_url><seller_account_name>" . $seller_email . "</seller_account_name><out_trade_no>" . $out_trade_no . "</out_trade_no><subject>" . $subject . "</subject><total_fee>" . $total_fee . "</total_fee><merchant_url>" . $merchant_url . "</merchant_url></direct_trade_create_req>";
//必填

/************************************************************/

//构造要请求的参数数组，无需改动
$para_token = array(
		"service" => "alipay.wap.trade.create.direct",
		"partner" => trim($alipayConfig['pid']),
		"sec_id" => "MD5",
		"format"	=> $format,
		"v"	=> $v,
		"req_id"	=> $req_id,
		"req_data"	=>$req_data,
		"_input_charset"	=> strtolower('utf-8')
);

//建立请求
$alipaySubmit = new AlipaySubmit($this->setconfig());
$html_text = $alipaySubmit->buildRequestHttp($para_token);
//var_dump($para_token) ;
//exit();
//URLDECODE返回的信息
$html_text = urldecode($html_text);

//exit($html_text);

//解析远程模拟提交后返回的信息
$para_html_text = $alipaySubmit->parseResponse($html_text);

//获取request_token
$request_token = $para_html_text['request_token'];


/**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************/

//业务详细
$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
//必填

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "alipay.wap.auth.authAndExecute",
		"partner" => trim($alipayConfig['pid']),
		"sec_id" => 'MD5',
		"format"	=> $format,
		"v"	=> $v,
		"req_id"	=> $req_id,
        "req_data"	=> $req_data,
		"_input_charset"	=> 'utf-8'
);

//建立请求
$alipaySubmit = new AlipaySubmit($this->setconfig());
$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '确认');
echo $html_text;
	}
		
				
		
	
	public function setconfig(){
		$alipay_config['partner']		= trim($this->alipayConfig['pid']);
		//安全检验码，以数字和字母组成的32位字符
		$alipay_config['key']			= trim($this->alipayConfig['key']);
		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		//签名方式 不需修改
		$alipay_config['sign_type']    = 'MD5';
		//字符编码格式 目前支持 gbk 或 utf-8
		$alipay_config['input_charset']= 'utf-8';
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = getcwd().'\\Lib\\ORG\\Alipay\\cacert.pem';
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';		
		return $alipay_config;
	}
	//同步数据处理
	public function return_url (){
import("@.ORG.Alipay.alipay_notify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$verify_result = $alipayNotify->verifyReturn();	
		if($verify_result) {
			$out_trade_no = $this->_get('out_trade_no');
			//支付宝交易号
			$trade_no =  $this->_get('trade_no');
			//交易状态
			$result = $_GET['result'];
			
				$product_cart_model=M('product_cart');
				$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
				$sepOrder=0;
				if (!$order){
					$order=$product_cart_model->where(array('id'=>$out_trade_no))->find();
					$sepOrder=1;
				}
				if($order){
					if($order['paid']==1){exit('该订单已经支付,请勿重复操作');}
					if (!$sepOrder){
						$product_cart_model->where(array('orderid'=>$out_trade_no))->setField('paid',1);
					}else {
						$product_cart_model->where(array('id'=>$out_trade_no))->setField('paid',1);
					}
					
					//if($back!=false&&$add!=false){
						$this->redirect(U('Product/my',array('token'=>$order['token'],'wecha_id'=>$order['wecha_id'],'success'=>1)));
					//}else{
						//$this->error('充值失败,请在线客服,为您处理',U('User/Index/index'));
					//}
				}else{						
					exit('订单不存在：'.$out_trade_no);
				}
			
			
		}else {
			exit('不存在的订单');
		}
	}
	public function notify_url(){
	echo "success"; 
		eixt();	
	}
	
}
?>