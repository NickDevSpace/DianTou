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
		$user->email = Input::get('email');
		$user->sex = Input::get('sex');
		$user->province_code = Input::get('province_code');
		$user->city_code = Input::get('city_code');
		$user->address = Input::get('address');
		
		//return bool
		$ret = $user->save();
		
		return Redirect::action('IController@getAccountInfo')->with('message', '保存成功！');
		//return View::make('i.info', array('user'=>$user, 'province_select'=>$province_select, 'city_select'=>$city_select));
	}
	
	public function getAccountAuth(){
		$user = Auth::user();
		return View::make('i.acct-auth', array('menu'=>'account', 'user'=>$user));
	}
	
	public function postAccountAuth(){
		
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
		$uid = Auth::id();
		$projects = DB::table('projects')
					->join('follows', function($join) use($uid)
					{
						$join->on('projects.id', '=', 'follows.project_id')
							 ->where('projects.user_id', '=', $uid);
					})
					->select('projects.*')
					->simplePaginate(10);
		return View::make('i.project-follow', array('menu'=>'project', 'projects'=>$projects));
	}
	
	public function getProjectApp(){
		$uid = Auth::id();
		$results = DB::table('projects')
					->join('appointments', function($join) use($uid)
					{
						$join->on('projects.id', '=', 'appointments.project_id')
							 ->where('appointments.user_id', '=', $uid)->where('appointments.state', '=' ,'1');
					})
					->select('projects.*', 'appointments.app_amt', 'appointments.app_share', 'appointments.app_time', 'appointments.state')
					->simplePaginate(10);
		return View::make('i.project-app', array('menu'=>'project', 'results'=>$results));
	}
	
	public function getProjectSub(){
		$uid = Auth::id();
		$results = DB::table('projects')
					->join('subscriptions', function($join) use($uid)
					{
						$join->on('projects.id', '=', 'subscriptions.project_id')
							 ->where('subscriptions.user_id', '=', $uid)->where('subscriptions.state', '=' ,'1');
					})
					->select('projects.*', 'subscriptions.sub_amt', 'subscriptions.sub_share', 'subscriptions.sub_time', 'subscriptions.state')
					->simplePaginate(10);
		return View::make('i.project-sub', array('menu'=>'project', 'results'=>$results));
	}
	
	public function getMessagePrivate(){

		
		//获取未读私信
        $sql = 'select b.id as sender_id, b.nickname as sender_name, sum(case when a.read_by_receiver = \'N\' then 1 else 0 end) as unread_cnt, max(a.created_at) last_time from '.
            'private_messages a '.
            'inner join '.
            'users b on a.sender = b.id '.
            'where a.receiver = '. Auth::id().' '.
            'group by b.id, b.nickname '.
            'order by max(a.created_at) desc';


        $msg_list = DB::select(DB::raw($sql));

        //return Response::json(array('errno'=>'0', 'msg_list'=>$msg_list));

		//$results = PrivateMessage::where('receiver','=', Auth::id())->where('read_by_receiver', '=', 'N')->simplePaginate(10);

        //dd(count($results));
		return View::make('i.message-private', array('menu'=>'message', 'msg_list'=>$msg_list));
	}
	
	public function getMessageSystem(){
		$results = array();
		return View::make('i.message-system', array('menu'=>'message', 'results'=>$results));
	}
	
	public function getMessageRead(){
	
		$results = array();
		
		//获取已读私信
		$results = PrivateMessage::where('receiver','=', Auth::id())->where('read_by_receiver', '=', 'Y')->simplePaginate(10);
		
		return View::make('i.message-read', array('menu'=>'message', 'results'=>$results));
	}
	


}
