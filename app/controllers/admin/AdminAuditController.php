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

    public function getRoadshowAcceptance(){
        $query_params['province_code'] = Input::get('province_code');
        $query_params['city_code'] = Input::get('city_code');
        $query_params['start_date'] = Input::get('start_date');
        $query_params['end_date'] = Input::get('end_date');
        $query_params['keyword'] = Input::get('keyword');


        $project_roadshows = ProjectRoadshow::with('roadshowScene')->whereHas('RoadshowScene', function($q) use($query_params){
                                                $q->where('scene_date', '<=', date('Y-m-d', time()));
                                                if($query_params['province_code'] != null && $query_params['province_code'] != ''){
                                                    $q->where('province_code', '=', $query_params['province_code']);
                                                }
                                                if($query_params['city_code'] != null && $query_params['city_code'] != ''){
                                                    $q->where('city_code', '=', $query_params['city_code']);
                                                }
                                                if($query_params['start_date'] != null){
                                                    $q->where('scene_date', '>=', $query_params['start_date']);
                                                }
                                                if($query_params['end_date'] != null){
                                                    $q->where('scene_date', '<=', $query_params['end_date']);
                                                }
                                            })
                                            ->with('project')->whereHas('Project', function($q) use($query_params){
                                                $q->where('project_name', 'like', '%'.$query_params['keyword'].'%');
                                            })->simplePaginate(10);

        $province_select = Province::all();
        $city_select = City::where('province_code','=',$query_params['province_code'])->get();

        return View::make('admin.audit.roadshow-acceptance-index', array('query_params' => $query_params, 'province_select' => $province_select, 'city_select' => $city_select, 'project_roadshows'=> $project_roadshows));


    }

    public function getRoadshowDoAcceptance($id){
            $project_roadshow = ProjectRoadshow::with('project')->find($id);

            return View::make('admin.audit.roadshow-do-acceptance', array('project_roadshow' => $project_roadshow));

    }

    //保存验收结果
    public function postRoadshowDoAcceptance(){
        $inputs = array(
            'project_roadshow_id' => Input::get('project_roadshow_id'),
            'accept_state' => Input::get('accept_state'),
            'attended' => Input::get('attended'),
            'show_video' => Input::get('show_video'),
            'show_detail' => Input::get('show_detail'),
            'point' => Input::get('point'),
            'next_state' => Input::get('next_state')
        );

        $project_roadshow = ProjectRoadshow::findOrFail($inputs['project_roadshow_id']);

        $project_roadshow->accept_state = $inputs['accept_state'];
        $project_roadshow->attended = $inputs['attended'];
        $project_roadshow->show_video = $inputs['show_video'];
        $project_roadshow->show_detail = $inputs['show_detail'];
        $project_roadshow->point = $inputs['point'];
        $project_roadshow->next_state = $inputs['next_state'];
        $project_roadshow->accept_state = $inputs['accept_state'];
        $project_roadshow->accept_user = Auth::id();
        $project_roadshow->save();

        //确认完成
        if($inputs['accept_state'] == '3'){
            $project = Project::findOrFail($project_roadshow->project_id);
            $project->state = $inputs['next_state'];

            switch($inputs['next_state']){
                case 'RAISE':{
                    //修改项目信息
                    $project->raise_start_date = DateUtil::today();
                    $project->raise_end_date = DateUtil::addDays(DateUtil::today(),$project->raise_days );
                    $project->save();

                    //发送系统消息
                    $user_id = Auth::id();
                    $title = '项目路演验收结果';
                    $content = "亲爱的".Auth::user()->nickname."：您好！恭喜您，您的项目《".$project->project_name."》路演已顺利通过点投网验收！项目已进入\"融资\"状态！";
                    SystemMessageService::send($user_id, $title, $content);

                    //项目里程碑
                    $event = new ProjectLifeEvent();
                    $event->project_id = $project->id;
                    $event->event_type = 'RAISE';
                    $event->event_desc = '开始融资';
                    $event->event_date = date('Y-m-d', time());
                    $event->save();

                    break;
                }
                case 'END':{
                    //修改项目信息
                    $project->save();

                    //发送系统消息
                    $user_id = Auth::id();
                    $title = '项目路演验收结果';
                    $content = "亲爱的".Auth::user()->nickname."：您好！很遗憾，您的项目《".$project->project_name."》路演未通过点投网验收，项目已进入\"结束\"状态！感谢您对点投网的支持！";
                    SystemMessageService::send($user_id, $title, $content);

                    //项目里程碑
                    $event = new ProjectLifeEvent();
                    $event->project_id = $project->id;
                    $event->event_type = 'END';
                    $event->event_desc = '项目结束';
                    $event->event_date = date('Y-m-d', time());
                    $event->save();

                    break;
                }
                default: {}

            }

            return Redirect::action('AdminAuditController@getRoadshowAcceptance')->with('message', '验收成功');
        }else{
            return Redirect::action('AdminAuditController@getRoadshowAcceptance')->with('message', '保存成功');
        }
    }

    public function getRoadshowAcceptanceDetail($id){
        $project_roadshow = ProjectRoadshow::with('project')->with('roadshowScene')->findOrFail($id);

        return View::make('admin.audit.roadshow-acceptance-detail', array('project_roadshow' => $project_roadshow));

    }


}
