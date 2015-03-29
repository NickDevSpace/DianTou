<?php

class AppointmentController extends \BaseController {

    /**
     * ajax预约
     * @return mixed
     */
	public function getMakeApp()
	{
		$inputs = array(
			'project_id' => Input::get('project_id')
		);
		
		$project = DB::table('projects')->where('id', $inputs['project_id'])->first();
		
		if(!$project){ //如果找不到符合条件的项目，则抛错
            return Response::json(array('errno' => 'ERROR_PROJECT_NOT_FOUND', 'message' => '预约项目未找到'));
		}
		
		if($project->app_flag != '1' || $project->state != '05'){  //如果项目不处于预约状态或不支持预约
            return Response::json(array('errno' => 'ERROR_PROJECT_NOT_FOR_APPOINTMENT', 'message' => '预约目前不支持预约'));
		}
		
		$app = Appointment::where('project_id', '=', $project->id)->where('user_id', '=', Auth::id())->first();
		
		if(!$app){ //如果客户还没有过sub
			$app = new Appointment();
			$app->project_id = $inputs['project_id'];
            $app->user_id = Auth::id();
			$app->save();
            return Response::json(array('errno' => 'SUCCESS', 'message' => '预约成功'));
		}else{
            return Response::json(array('errno' => 'ERROR_ALREADY_HAS_AN_APPOINTMENT', 'message' => '您已预约过，无需重复预约'));
		}

	}


    /**
     * ajax撤销预约
     * @return mixed
     */
	public function getCancelApp(){
        $inputs = array(
            'project_id' => Input::get('project_id')
        );
		
		$app = Appointment::where('project_id', '=', $inputs['project_id'])->first();
		
		if(!$app){
            return Response::json(array('errno' => 'ERROR_APPOINTMENT_NOT_FOUND', 'message' => '您还未预约该项目，无需撤销预约'));
		}

        $app->delete();

        return Response::json(array('errno' => 'SUCCESS', 'message' => '撤销预约成功'));
	}
	


}
