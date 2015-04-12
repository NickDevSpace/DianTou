<?php

class AdminAuditController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getUserCertify()
	{
        $query = array();
        $query['account'] = Input::get('account') == null ? '' : Input::get('account');

        $audit_applies = AuditApply::where('obj_type','=','USER_CERTIFY')
                                    ->where('audit_state', '=', '0')
                                    ->simplePaginate(10);

        //$users = User::where('verification_state', '=', '2')->where('account', 'like', '%'.$query['account'].'%')->simplePaginate(12);
        //$total = User::where('verification_state', '=', '2')->where('account', 'like', '%'.$query['account'].'%')->count();
        return View::make('admin.audit.user-certify-index', array('audit_applies'=>$audit_applies));
	}

    public function getUserCertifyDetail($id){
        if($id == null){
            dd('ERROR_USER_ID_NOT_VALID');
        }

        $audit_apply = AuditApply::find($id);

        $user = $audit_apply->obj;


        return View::make('admin.audit.user-certify-detail', array('audit_apply_id'=>$audit_apply->id, 'user'=>$user));


    }

    public function postDoUserCertify(){
        $audit_apply_id = Input::get('audit_apply_id');
        $audit_state = Input::get('audit_state');
        $audit_comment = Input::get('audit_comment');
        if($audit_state == null || $audit_apply_id == null)
            dd('ERROR_PARAMS_NOT_VALID');

        //保存审批信息
        $audit_apply = AuditApply::findOrFail($audit_apply_id);
        $audit_apply->audit_comment = $audit_comment;
        $audit_apply->audit_user = Auth::id();
        $audit_apply->audit_time = date('Y-m-d H:i:s', time());
        $audit_apply->audit_state = $audit_state == '1' ? '1':'2';
        $audit_apply->save();

        //更新用户认证状态
        $user = $audit_apply->obj;
        $user->verification_state = $audit_state == '1' ? '4':'3';
        $user->save();

        //发送系统消息
        $user_id = Auth::id();
        $title = '实名认证审核结果';
        if($audit_state == '1'){
            $content = '亲爱的'.Auth::user()->nickname.'：您好！恭喜您已顺利通过点投网实名认证，现在，您可以发起您的梦想或投资您喜欢的项目了哦~';
        }else{
            $content = '亲爱的'.Auth::user()->nickname.'：您好！很遗憾您的实名认证未通过审核！点投网审核意见如下：'.$audit_comment.'<br/>您可以尝试修改完善申请信息，重新发起审核申请。';
        }
        SystemMessageService::send($user_id, $title, $content);

        return Redirect::action('AdminAuditController@getUserCertify')->with('message', '操作成功');


    }

    public function getProjectAudit(){
        $query = array();
        $query['keyword'] = Input::get('keyword') == null ? '' : Input::get('keyword');

        $audit_applies = AuditApply::where('obj_type','=','PROJECT_AUDIT')
                                    ->where('audit_state', '=', '0')
                                    ->simplePaginate(10);



        //$projects = Project::where('state', '=', 'SUBMIT_AUDIT')->where('project_name', 'like', '%'.$query['keyword'].'%')->simplePaginate(12);
        //$total = Project::where('state', '=', 'SUBMIT_AUDIT')->where('project_name', 'like', '%'.$query['keyword'].'%')->count();
        return View::make('admin.audit.project-audit-index', array('audit_applies'=>$audit_applies));
    }

    public function getProjectAuditDetail($id){
        if($id == null){
            dd('ERROR_ID_NOT_VALID');
        }

        $audit_apply = AuditApply::find($id);

        $project = $audit_apply->obj;

        return View::make('admin.audit.project-audit-detail', array('audit_apply_id'=> $audit_apply->id, 'project'=>$project));


    }

    public function postDoProjectAudit(){
        $audit_apply_id = Input::get('audit_apply_id');
        $audit_state = Input::get('audit_state');
        $audit_comment = Input::get('audit_comment');
        if($audit_state == null || $audit_apply_id == null)
            dd('ERROR_PARAMS_NOT_VALID');

        if($audit_state == '1'){
            //保存审批信息
            $audit_apply = AuditApply::findOrFail($audit_apply_id);
            $audit_apply->audit_comment = $audit_comment;
            $audit_apply->audit_user = Auth::id();
            $audit_apply->audit_time = date('Y-m-d H:i:s', time());
            $audit_apply->audit_state = '1';
            $audit_apply->save();

            //更新项目审核状态
            $project = $audit_apply->obj;
            $project->state = 'AUDIT_PASS';
            $project->save();

            //发送系统消息
            $user_id = Auth::id();
            $title = '项目审核结果';
            $content = '亲爱的'.Auth::user()->nickname.'：您好！恭喜您，您的项目《'.$project->project_name.'》已顺利通过点投网审核！祝您圆梦成功！';
            SystemMessageService::send($user_id, $title, $content);

            //项目里程碑
            $event = new ProjectLifeEvent();
            $event->project_id = $project->id;
            $event->event_type = 'ONLINE';
            $event->event_desc = '项目上线';
            $event->event_date = date('Y-m-d', time());
            $event->save();

        }else{
            //保存审批信息
            $audit_apply = AuditApply::findOrFail($audit_apply_id);
            $audit_apply->audit_comment = $audit_comment;
            $audit_apply->audit_user = Auth::id();
            $audit_apply->audit_time = date('Y-m-d H:i:s', time());
            $audit_apply->audit_state = '2';
            $audit_apply->save();

            //更新项目审核状态
            $project = $audit_apply->obj;
            $project->state = 'AUDIT_FAILED';
            $project->save();

            //发送系统消息
            $user_id = Auth::id();
            $title = '项目审核结果';
            $content = '亲爱的'.Auth::user()->nickname.'：您好！很遗憾，您的项目《'.$project->project_name.'》未通过点投网审核！点投网审核意见如下：'.$audit_comment.'<br/>您可以尝试修改项目信息，重新发起审核申请，祝您圆梦成功！';
            SystemMessageService::send($user_id, $title, $content);
        }



        return Redirect::action('AdminAuditController@getProjectAudit')->with('message', '操作成功');
    }

    public function getRoadshowAudit(){
//        $table->integer('project_id');
//        $table->integer('roadshow_scene_id');
//        $table->integer('show_seq');
//        $table->string('show_video')->nullable();
//        $table->text('show_detail')->nullable();
//        $table->string('rate')->nullable();     //A+ A A- B+ B B-
//        $table->char('attended',1)->default('N');       //是否出席
//        $table->char('end_flag',1)->default('N');
        $query_params['province_code'] = Input::get('province_code');
        $query_params['city_code'] = Input::get('city_code');
        $query_params['start_date'] = Input::get('start_date', '1899-12-31');
        $query_params['end_date'] = Input::get('end_date', '2999-12-31');
        $query_params['keyword'] = Input::get('keyword', '');


        $project_roadshows = ProjectRoadshow::with('roadshowScene')->whereHas('RoadshowScene', function($q){
             $q->where('scene_date', '<=', date('Y-m-d', time()));
        })->simplePaginate(10);


        $province_select = Province::all();
        $city_select = array();
        return View::make('admin.audit.roadshow-audit-index', array('query_params' => $query_params, 'province_select' => $province_select, 'city_select' => $city_select, 'project_roadshows'=> $project_roadshows));


    }

    public function getRoadshowAuditDetail($id){
            $project_roadshow = ProjectRoadshow::with('project')->find($id);

            return View::make('admin.audit.roadshow-audit-detail', array('project_roadshow' => $project_roadshow));

    }


}
