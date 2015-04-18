<?php

class SubscriptionController extends \BaseController {

    /**
     * 点击认购，输入份数后进入此方法，改成post
     */
	public function postSaveSub(){
		$inputs = array(
			'project_id' => Input::get('project_id'),
			'sub_amt' => Input::get('sub_amt')
		);
		
		$project = Project::findOrFail($inputs['project_id']);
		
		if(!$project){ //如果找不到符合条件的项目，则提示错误页面
			dd('ERROR_PROJECT_NOT_FOUND');
		}
		
		if($project->state != 'RAISE'){  //如果项目不处于募集状态，则提示错误页面
			dd('ERROR_PROJECT_NOT_FOR_SUBSCRIPTION');
		}

        //如果当前所剩余份数小于请求份数，也提示错误，则提示错误页面
		

        //一切环境OK，继续
        //把唯一订单号放入用户session中
        if(!Session::get('SN.sub_order_sn')){
            Session::put('SN.sub_order_sn', SnGenerator::getOrderSn());
        }

        //查看表中是否已经存在这个订单号
        $sub = Subscription::where('sub_order', '=', Session::get('SN.sub_order_sn'))->first();
        if($sub){   //如果有
            if($sub->state == '2'){ //如果该笔已经付款完毕了，说明订单有问题，提示订单有问题
                Session::forget('SN.sub_order_sn');
                dd('ERROR_INVALID_ORDER_STATE');
            }
        }else{  //如果没有，则新建订单
            $sub = new Subscription();
        }

        //将原有的订单或新的订单修改成最新状态，这样就不浪费sub表的空间
        $sub->sub_order = Session::get('SN.sub_order_sn');
        $sub->project_id = $inputs['project_id'];
        $sub->user_id = Auth::id();
        $sub->sub_amt = $inputs['sub_amt'];
        $sub->save();
        //跳转到订单详细页面
        return Redirect::action('SubscriptionController@getSubDetail', array($sub->id));

	}

    public function getSubDetail($id){
        $sub = Subscription::with('project')->findOrFail($id);

        return View::make('subscriptions.order', array('sub'=>$sub));
    }

    /**
     * 点击立即支付按钮
     * @param $sub_order
     */
    public function postPaySub($sub_order){
        if($sub_order == null){
            dd('ERROR_ORDER_PARAM_NOT_VALID');
        }

        $sub = Subscription::where('sub_order','=',$sub_order)->first();

        $alipay_config = Config::get('app.alipay_config');


        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = Config::get('app.alipay_account');
        //必填
        //商户订单号
        $out_trade_no = $sub->sub_order;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = '股权认购';
        //必填
        //付款金额
        $total_fee = $sub->sub_amt;
        //必填
        //订单描述
        $body = '股权认购';
        //商品展示地址
        $show_url = 'xxxxx';
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type"	=> $payment_type,
            "notify_url"	=> $notify_url,
            "return_url"	=> $return_url,
            "seller_email"	=> $seller_email,
            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "total_fee"	=> $total_fee,
            "body"	=> $body,
            "show_url"	=> $show_url,
            "anti_phishing_key"	=> $anti_phishing_key,
            "exter_invoke_ip"	=> $exter_invoke_ip,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"post", "");
        echo $html_text;
    }
	
	/**
	*	取消一个认购，一般不支持取消
	**/
	public function getCancelSub(){
		$id = Input::get('sub_id');
		
		$sub = Subscription::where('id', '=', $id)->first();
		
		if(!$sub){
			dd('ERROR_SUBSCRIPTION_NOT_FOUND');
		}
		
		if($sub->state != '1'){		//如果认购的状态不为正常，则取消该条认购失败
			dd('ERROR_SUBSCRIPTION_STATE_ILLEGAL');
		}
		
		$sub->state = '2';		//将该笔认购的状态更改为已撤销，等待退款
		
		$sub->save();
		
		dd('SUCCESS');
		
	}
	


}
