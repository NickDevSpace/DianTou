<?php

class PrivateMessageController extends \BaseController {

	
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
			return Response::json(array('errno'=>'SUCCESS', 'data'=>array('id'=>$pm->id)));
		}
		
		return Response::json(array('errno'=>'FAILED', 'message'=>'FAILED'));
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
