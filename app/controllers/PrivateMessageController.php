<?php

class PrivateMessageController extends \BaseController {

	public function postPmUserList(){

        $sql = 'select b.id as sender_id, b.nickname as sender_name, sum(case when a.read_by_receiver = \'N\' then 1 else 0 end) as unread_cnt, max(a.id) from '.
                'private_messages a '.
                'inner join '.
                'users b on a.sender = b.id '.
                'where a.receiver = '. Auth::id().' '.
                'group by b.id, b.nickname '.
                'order by max(a.id) desc';


        $user_list = DB::select(DB::raw($sql));

        return Response::json(array('errno'=>'0', 'user_list'=>$user_list));
    }

    public function postPmHistory(){

        $opp_user_id = Input::get('opp_user_id');
        $min_msg_id = Input::get('min_msg_id');
        $max_msg_id = Input::get('max_msg_id');
        $before_after = Input::get('before_after');
        $fetch_size =  Input::get('fetch_size');
        $receiver_id = Auth::id();


        $msg = array();
        if($before_after == 'before'){
            $msg = PrivateMessage::whereIn('sender', array($opp_user_id, Auth::id()))
                ->whereIn('receiver', array($opp_user_id, Auth::id()))
                ->where('id', '<', $min_msg_id)->orderBy('id', 'desc')->take($fetch_size)->get();
            $msg = array_reverse($msg->toArray());

        }else if($before_after == 'after'){
            $msg = PrivateMessage::whereIn('sender', array($opp_user_id, Auth::id()))
                ->whereIn('receiver', array($opp_user_id, Auth::id()))
                ->where('id', '>', $max_msg_id)->orderBy('id')->take(-1)->get();
        }else if($before_after == 'init'){
            //将该发送者发送的未读消息置为已读
            PrivateMessage::where('sender', '=', $opp_user_id)->where('receiver', '=', Auth::id())->where('read_by_receiver', 'N')
                            ->update(array('read_by_receiver'=> 'Y'));
            //获取消息
            $msg = PrivateMessage::whereIn('sender', array($opp_user_id, Auth::id()))
                ->whereIn('receiver', array($opp_user_id, Auth::id()))
                ->orderBy('id', 'desc')->take($fetch_size)->get();
            $msg = array_reverse($msg->toArray());
        }else{
            return Response::json(array('errno'=>'1', 'message'=>'ERROR_PARAMS_NOT_VALID'));
        }

        //dd($msg[0]->sender->id);
        return Response::json(array('errno'=>'0', 'result'=>$msg));
    }

	public function postSend(){
		$inputs = array(
			'receiver' => Input::get('receiver'),
			'content' => Input::get('content')
		);
		
		$validator = Validator::make(
            $inputs,
            array(
				'receiver' => 'required|integer',
				'content' => 'required'
            )
        );

        if(!$validator->fails()){
			$pm = new PrivateMessage();
			$pm->sender = Auth::id();
			$pm->receiver = $inputs['receiver'];
			$pm->content = $inputs['content'];
			$pm->save();
			return Response::json(array('errno'=>'0', 'data'=>array('id'=>$pm->id)));
		}
		
		return Response::json(array('errno'=>'1', 'message'=>'FAILED'));
	}
	
	/**
	*	标记为已读，参数为私信id的数组
	*
	**/
	public function postMarkRead(){
		$pm_ids = Input::get('pm_ids');
		$uid = Auth::id();
		
		$affected = DB::table('private_messages')
					->whereIn('id', $pm_ids)->where('receiver', $uid)
					->update(array('read_by_receiver' => 'Y'));
		
		if($affected == count($pm_ids)){
			return Response::json(array('errno'=>'SUCCESS', 'data'=>array('effected'=>$affected)));
		}
		
		return Response::json(array('errno'=>'COMPLETE', 'message'=>array('effected'=>$affected)));
		
	}
	
	public function postDeleteRead(){
		$pm_ids = Input::get('pm_ids');
		$uid = Auth::id();
		
		$affected = DB::table('private_messages')
					->whereIn('id', $pm_ids)->where('receiver', $uid)
					->update('del_by_reveiver', 'Y');
					
		if($affected == count($pm_ids)){
			return Response::json(array('errno'=>'SUCCESS', 'data'=>array('effected'=>$affected)));
		}
		
		return Response::json(array('errno'=>'COMPLETE', 'message'=>array('effected'=>$affected)));
	}
	
	public function postDeleteSent(){
		$pm_ids = Input::get('pm_ids');
		$uid = Auth::id();
		
		$affected = DB::table('private_messages')
					->whereIn('id', $pm_ids)->where('sender', $uid)
					->update('del_by_sender', 'Y');
					
		if($affected == count($pm_ids)){
			return Response::json(array('errno'=>'SUCCESS', 'data'=>array('effected'=>$affected)));
		}
		
		return Response::json(array('errno'=>'COMPLETE', 'message'=>array('effected'=>$affected)));
	}
	
	public function getUnreadMessageCount(){
		$mcnt = PrivateMessage::where('receiver', '=', Auth::id())->where('read_by_receiver','=','N')->count();
		return Response::json(array('errno'=>'SUCCESS', 'data'=>array('message_count'=>$mcnt)));
	}
	
	public function getShowMessage(){
		$pm_id = Input::get('pm_id');
		$msg = PrivateMessage::where('id', '=', $pm_id)->get();
		return Response::json(array('errno'=>'SUCCESS', 'data'=>array('message'=>$msg)));
	}


}
