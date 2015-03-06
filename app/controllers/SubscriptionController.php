<?php

class SubscriptionController extends \BaseController {

	
	public function getMakeSub(){
		$inputs = array(
			'project_id' => Input::get('project_id'),
			'sub_part_count' => Input::get('sub_part_count')
		);
		
		$project = Project::where('id', '=', $inputs['project_id'])->first();
		
		if(!$project){ //如果找不到符合条件的项目，则抛错
			dd('ERROR_PROJECT_NOT_FOUND');
		}
		
		if($project->state != '07'){  //如果项目不处于募集状态
			dd('ERROR_PROJECT_NOT_FOR_SUBSCRIPTION');
		}
		
		$sub = Subscription::where('project_id', '=', $p->id)->where('user_id', '=', Auth::id())->where('state', '<>', '1')->first();
		
		if(!$sub){ //如果客户还没有状态为正常的sub
			$sub = new Subscription();
			$sub->project_id = $inputs['project_id'];
			$sub->sub_part_count = $inputs['sub_part_count'];
			$sub->sub_amt = $inputs['sub_part_count'] * $project->quota_of_part;
			$sub->sub_share = $sub->sub_amt / $project->total_quota;
			$sub->state = '1';
			$sub->sub_time = date('Y-m-d H:i:s', time());
			$sub->user_id = Auth::id();
			$sub->save();
			dd('SUCCESS');
		}else{  //已经存在一条，则更新
			dd('ERROR_ALREADY_HAS_AN_SUBSCRIPTION');
		}
		
		dd(':(');
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
