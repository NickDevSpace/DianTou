<?php

class AppointmentController extends \BaseController {

	
	public function getMakeApp()
	{
		$inputs = array(
			'project_id' => Input::get('project_id'),
			'app_part_count' => Input::get('app_part_count')
		);
		
		$project = DB::table('projects')->where('id', $inputs['project_id'])->first();
		
		if(!$project){ //如果找不到符合条件的项目，则抛错
			dd('ERROR_PROJECT_NOT_FOUND');
		}
		
		if($project->app_flag != '1' || $project->state != '05'){  //如果项目不处于预约状态或不支持预约
			dd('ERROR_PROJECT_NOT_FOR_APPOINTMENT');
		}
		
		$app = Appointment::where('project_id', '=', $p->id)->where('user_id', '=', Auth::id())->first();
		
		if(!$app){ //如果客户还没有过sub
			$app = new Appointment();
			$app->project_id = $inputs['project_id'];
			$app->app_part_count = $inputs['app_part_count'];
			$app->app_amt = $inputs['app_part_count'] * $project->quota_of_part;
			$app->app_share = $app->app_amt / $project->total_quota;
			$app->app_state = '1';
			$app->app_time = date('Y-m-d H:i:s', time());
			$app->user_id = Auth::id();
			$app->save();
			dd('SUCCESS');
		}else{  //已经存在一条，则更新
			dd('ERROR_ALREADY_HAS_AN_APPOINTMENT');
		}
		
		dd(':(');
	}


	public function getCancelApp(){
		$id = Input::get('sub_id');
		
		$app = Appointment::where('id', '=', $id)->first();
		
		if(!$app){
			dd('ERROR_APPOINTMENT_NOT_FOUND');
		}
		
		if($app->state != '1'){		//如果预约的状态不为正常，则取消该条预约失败
			dd('ERROR_APPOINTMENT_STATE_ILLEGAL');
		}
		
		$app->state = '2';		//将该笔预约的状态更改为已撤销，等待退款
		
		$app->save();
		
		dd('SUCCESS');
	}
	


}
