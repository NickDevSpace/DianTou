<?php

class PrivateMessageController extends \BaseController {

	
	public function postSend(){
		$inputs = array(
			'to_user' => Input::get('to_user'),
			'content' => Input::get('content')
		);
		
		$validator = Validator::make(
            $inputs,
            array(
				'to_user' => 'required|integer',
				'content' => 'required'
            )
        );

        if(!$validator->fails()){
			$pm = new PrivateMessage();
			$pm->from_user = Auth::id();
			$pm->to_user = $inputs['to_user'];
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
					->whereIn('id', $pm_ids)->where('to_user', $uid)
					->update(array('is_read' => 'Y'));
		
		if($affected == count($pm_ids)){
			return Response::json(array('errno'=>'SUCCESS', 'data'=>array('effected'=>$affected)));
		}
		
		return Response::json(array('errno'=>'COMPLETE', 'message'=>array('effected'=>$affected)));
		
	}
	
	public function postDeleteRead(){
		$pm_ids = Input::get('pm_ids');
		$uid = Auth::id();
		
		$affected = DB::table('private_messages')
					->whereIn('id', $pm_ids)->where('to_user', $uid)
					->delete();
					
		if($affected == count($pm_ids)){
			return Response::json(array('errno'=>'SUCCESS', 'data'=>array('effected'=>$affected)));
		}
		
		return Response::json(array('errno'=>'COMPLETE', 'message'=>array('effected'=>$affected)));
	}
	
	public function postDeleteSent(){
		$pm_ids = Input::get('pm_ids');
		$uid = Auth::id();
		
		$affected = DB::table('private_messages')
					->whereIn('id', $pm_ids)->where('from_user', $uid)
					->delete();
					
		if($affected == count($pm_ids)){
			return Response::json(array('errno'=>'SUCCESS', 'data'=>array('effected'=>$affected)));
		}
		
		return Response::json(array('errno'=>'COMPLETE', 'message'=>array('effected'=>$affected)));
	}
	
	public function getUnreadMessageCount(){
		$mcnt = PrivateMessage::where('to_user', '=', Auth::id())->where('is_read','=','N')->count();
		return Response::json(array('errno'=>'SUCCESS', 'data'=>array('message_count'=>$mcnt)));
	}
	
	public function getShowMessage(){
		$pm_id = Input::get('pm_id');
		$msg = PrivateMessage::where('id', '=', $pm_id)->get();
		return Response::json(array('errno'=>'SUCCESS', 'data'=>array('message'=>$msg)));
	}


}
