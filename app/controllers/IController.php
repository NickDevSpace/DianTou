<?php

class IController extends \BaseController {

	
	public function getAccountInfo(){
		$user = Auth::user();
		$province_select = Province::all();
		$city_select = City::where('province_code', '=', $user->province_code)->get();
		//dd($city_select);
		return View::make('i.acct-info', array('menu'=>'account', 'user'=>$user, 'province_select'=>$province_select, 'city_select'=>$city_select));
	}
	
	public function postAccountInfo(){
		$user = Auth::user();
		$user->nickname = Input::get('nickname');
		$user->province_code = Input::get('province_code');
		$user->city_code = Input::get('city_code');
        $user->introduction = Input::get('introduction');
		
		//return bool
		$ret = $user->save();
		
		return Redirect::action('IController@getAccountInfo')->with('message', '保存成功！');
		//return View::make('i.info', array('user'=>$user, 'province_select'=>$province_select, 'city_select'=>$city_select));
	}

    public function getAccountAvatar(){
        $user = Auth::id();
        return View::make('i.acct-avatar', array('menu'=>'account', 'user'=>$user));
    }

    public function postAccountAvatar(){
        $AVATAR_DIR = Config::get('app.user_avatar_dir');
        if (!file_exists($AVATAR_DIR)) {
            @mkdir($AVATAR_DIR);
        }

        $jpeg_quality = 100;

        $dst100 = $AVATAR_DIR.'/'.'avatar_u'.Auth::id().'_100.jpg';
        $dst55 = $AVATAR_DIR.'/'.'avatar_u'.Auth::id().'_55.jpg';


        $ret =  ImageUtil::cropImage(Input::get('path'), Input::get('x'), Input::get('y'), 100, 100, Input::get('w'), Input::get('h'), $dst100);

        if($ret == true){
            $user = Auth::user();
            $user->avatar = $dst100;
            $user->save();
            return Redirect::action('IController@getAccountAvatar')->with('message', '保存成功！');
        }else{
            return Redirect::action('IController@getAccountAvatar')->with('message', '保存失败！');
        }
    }

	
	public function getAccountAuth(){
		$user = Auth::user();
		return View::make('i.acct-auth', array('menu'=>'account', 'user'=>$user));
	}
	
	public function postAccountAuth(){
//        $inputs  = array('real_name' => Input::get('real_name'),
//                        'crdt_id' => Input::get('crdt_id'),
//                        'crdt_photo_a' => Input::get('crdt_photo_a'),
//                        'crdt_photo_b' => Input::get('crdt_photo_b'),
//                        'mobile' => Input::get('mobile'),
//                        'v_code' => Input::get('v_code'));
//
//        $user = Auth::user();
//        if($user->is_verified == 'N'){
//
//            if(SmsVerificationService::verifyCode($inputs['v_code']) == true){
//                $user->real_name = $inputs['real_name'];
//                $user->crdt_id = $inputs['crdt_id'];
//                $user->crdt_photo_a = $inputs['crdt_photo_a'];
//                $user->crdt_photo_b = $inputs['crdt_photo_b'];
//                $user->mobile = $inputs['mobile'];
//                $user->save();
//                return Redirect::action('IController@getAccountAuth')->with('message', '认证成功！');
//            }
//        }else{
//            return Redirect::action('IController@getAccountAuth')->with('message', '操作失败！您已认证过！');
//        }


	}
	
	public function getAccountPasswd(){
		return View::make('i.acct-passwd', array('menu'=>'account'));
	}
	
	public function postAccountPasswd(){
		$inputs = array(
            'passwd' => Input::get('passwd'),
			'newpasswd' => Input::get('newpasswd'),
            'newpasswd_confirmation' => Input::get('newpasswd_confirmation')
        );
        $validator = Validator::make(
            $inputs,
            array(
                'passwd' => 'required|min:6',
				'newpasswd' => 'required|min:6|confirmed',
				'newpasswd_confirmation' => 'required|min:6'
            )
        );

        if(!$validator->fails()){
			$user = Auth::user();
			$user->password = Hash::make($inputs['newpasswd']);
            $user->save();
			return Redirect::action('IController@getAccountPasswd')->with('message', '修改成功！');
        }
		return Redirect::action('IController@getAccountPasswd')->with('message', '修改失败！');
	}
	
	public function getProjectMy(){
		$uid = Auth::id();
		$projects = Project::where('user_id', '=', $uid)->simplePaginate(10);
		return View::make('i.project-my', array('menu'=>'project', 'projects'=>$projects));
	}
	
	public function getProjectFollow(){

		$follows = Follow::with('Project')->where('user_id','=',Auth::id())->simplePaginate(10);
		return View::make('i.project-follow', array('menu'=>'project', 'follows'=>$follows));
	}
	
	public function getProjectSub(){
		$uid = Auth::id();

        $dataset = "select p.id, p.project_name, p.raised_bal, p.raise_quota, p.raise_end_date, p.state, s.total_sub_amt, s.total_sub_share, s.max_sub_time ".
                    "from projects p ".
                    "inner join ".
                    "( ".
                    "select project_id, sum(sub_amt) total_sub_amt, sum(sub_share) total_sub_share, max(sub_time) max_sub_time ".
                    "from subscriptions ".
                    "where user_id = 1 and state = '2' ".
                    "group by project_id ".
                    ") s on p.id = s.project_id ";

        $results = DB::table(DB::raw("($dataset) as t"))
            ->orderBy("t.max_sub_time", "desc")->simplePaginate(10);


		return View::make('i.project-sub', array('menu'=>'project', 'results'=>$results));
	}
	
	public function getMessagePrivate(){

		//获取未读私信
//        $sql = 'select b.id as sender_id, b.nickname as sender_name, sum(case when a.read_by_receiver = \'N\' then 1 else 0 end) as unread_cnt, max(a.created_at) last_time from '.
//            'private_messages a '.
//            'inner join '.
//            'users b on a.sender = b.id '.
//            'where a.receiver = '. Auth::id().' '.
//            'group by b.id, b.nickname '.
//            'order by max(a.created_at) desc';
//
//        $msg_list = DB::select(DB::raw($sql));


//        $msg_list = DB::table('private_messages as a')
//            ->join('users as b', 'b.id','=','a.sender')
//            ->select(DB::raw('b.id as sender_id, b.nickname as sender_name, sum(case when a.read_by_receiver = \'N\' then 1 else 0 end) as unread_cnt, max(a.created_at) as last_time'))
//            ->where('a.receiver', '=', Auth::id())
//            ->groupBy('b.id','b.nickname')
//            ->orderBy(DB::raw('max(a.created_at)'), 'desc')
//            ->simplePaginate(10);

//        $first = DB::table('private_messages')
//                    ->select(DB::raw('sender opp, max(created_at) max_time'))
//                    ->whereRaw('receiver = ' .Auth::id())
//                    ->groupBy('sender');
//
//        $second = DB::table('private_messages')
//                    ->select(DB::raw('receiver opp, max(created_at) max_time'))
//                    ->whereRaw('sender = '.Auth::id())
//                    ->groupBy('receiver')->union($first);
//
//        $query = DB::table(DB::raw('(' . $second->toSql() . ') as a'))
//                    ->selectRaw('opp, max(max_time) max_time')
//                    ->groupBy('opp')
//                    ->get();
//
//        var_dump($query);
//        dd();

        //以下这条语句包含了对方发来的和用户发给别人的所有会话
        //时间长了肯定会有效率问题
        $uid = Auth::id();
        $dataset = "select a.opp sender_id, b.nickname sender_name, a.unread_cnt, a.max_time last_time from ".
                "(".
                "   select (case when receiver = $uid then sender else receiver end) as opp, sum(case when receiver = $uid and read_by_receiver = 'N' then 1 else 0 end) unread_cnt, max(created_at) max_time ".
                "   from private_messages ".
                "   where receiver = $uid or sender = $uid ".
                "   group by (case when receiver = $uid then sender else receiver end) ".
                ") a ".
                "inner join ".
                "users b on a.opp = b.id ".
                "order by a.max_time desc, a.unread_cnt desc ";

        $msg_list = DB::table(DB::raw("($dataset) as t"))
            ->orderBy("t.last_time", "desc")->orderBy("t.unread_cnt", "desc")->simplePaginate(10);
        return View::make('i.mp-list', array('menu'=>'message', 'messages'=>$msg_list));
	}
	
	public function getMessageSystem(){
		$results = array();
        /*DB::table('system_message_deliveries')
            ->join('system_messages', 'system_messages.id', '=', 'system_message_deliveries.message_id')
            ->where('system_message_deliveries.receiver', '=', Auth::id())
            ->orderBy('system_message_deliveries.send_time', 'desc')
            ->select('users.id', 'contacts.phone', 'orders.price')
            ->simplePaginate(10);*/

        $messages = Auth::user()->systemMessages()->where('is_deleted','=','N')->orderBy('send_time','desc')->simplePaginate(5);
		return View::make('i.ms-list', array('menu'=>'message', 'messages'=>$messages));
	}
	
	public function getMessageSystemDetail($id){
        if($id == null)
            dd('ERROR_ID_INVALID');

        $md = SystemMessageDelivery::where('id','=',$id)->first();


        if($md->is_read == 'N'){
            $md->is_read = 'Y';
            $md->save();
        }

        $msg = SystemMessage::where('id','=',$md->message_id)->first();

        return View::make('i.ms-detail', array('menu'=>'message', 'msg'=>$msg));
    }

    //个人中心-投资记录
    public function getSubHistory(){
        $subs = Subscription::where('user_id', '=', Auth::id())->orderBy('sub_time','desc')->simplePaginate(10);
        return View::make('i.sub-list', array('menu'=>'sub', 'subs'=>$subs));
    }
	


}
