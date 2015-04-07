<?php

class ProjectController extends \BaseController {

    /**
     * 搜索逻辑参考的美团，存在bug：直接访问project/index，不填搜索框，直接点某行业报错
     * @param null $p_w
     * @param null $p_industry
     * @param null $p_state
     * @return mixed
     *
     */
	public function getIndex($p_industry = null, $p_state = null,$p_w = null)
	{

        //$cate_ind = Input::get('cate_ind', '');
        //$cate_state = Input::get('cate_state', '');
        if(Input::get('w') != null){
            $p_w = Input::get('w');
            $p_industry = null;
            $p_state = null;
        }


        $where = "state in ('ROADSHOW','APPOINTMENT','RAISE','RAISE_SUCCESS') ";
        $params = array();
        if($p_state != null && $p_state != 'all'){
            $where .= "and state = ? ";
            array_push($params, $p_state);
        }
        if($p_industry != null && $p_industry != 'all'){
            $where .= "and industry_code like ? ";
            array_push($params, $p_industry.'%');
        }
        if($p_w != null){
            $where .= "and concat(project_name,sub_title) like ? ";
            array_push($params, '%'.$p_w.'%');

            //增加搜索日志
            $search_log = new SearchLog();
            $search_log->keyword = $p_w;
            $search_log->user_id = Auth::id();
            $search_log->save();
        }



        $plist = Project::whereRaw($where, $params)->simplePaginate(12);;
        //dd(Project::find(1)->toArray());
        //dd($list->toArray());

        $industry_list = Industry::where('parent', '=', 'I')->where('enabled', '=', 'Y')->get();
        //dd($all_industries->toArray());
        $state_list = array(array('state_code'=>'ROADSHOW', 'state_name'=>'路演中'), array('state_code'=>'APPOINTMENT','state_name'=>'预约中'), array('state_code'=>'RAISE', 'state_name'=>'融资中'), array('state_code'=>'RAISE_SUCCESS', 'state_name'=>'融资成功'));

        $cates = array('industry_list'=>$industry_list->toArray(), 'state_list'=>$state_list);

        return View::make('projects.project-index', array('cates'=>$cates, 'params'=>array('p_industry' => $p_industry, 'p_state'=>$p_state, 'p_w'=>$p_w), 'plist'=>$plist));
	}


	//项目基本信息表单
	public function getCreate()
	{
		//
        $user = Auth::user();

        $province_select = Province::all();

        $industry_select = Industry::where('parent', '=', 'I')->where('enabled', '=', 'Y')->get();

        return View::make('projects.project-create', array('user-mgr'=>$user,
                                                            'province_select' => $province_select,
                                                            'industry_select' => $industry_select));

	}



	//项目基本信息保存
	public function postSave()
	{
        $project = new Project();
		$project->project_no = date('YmdHis', time());
        $project->project_name = Input::get('project_name');
        $project->project_cover = Input::get('project_cover');
        $project->sub_title = Input::get('sub_title');
        $project->industry_code = Input::get('industry_code');
        $project->province_code = Input::get('province_code');
        $project->city_code = Input::get('city_code');
        $project->address = Input::get('address');
		$project->detail = Input::get('detail');
        $project->business_plan = Input::get('business_plan');




		//公司信息
//        $project->has_company = Input::get('has_company', 'N');
//		$project->company_name = Input::get('company_name');
//		$project->legal_person = Input::get('legal_person');
//		$project->startup_date = Input::get('startup_date');
//		$project->registered_address = Input::get('registered_address');
//		$project->legal_id_card = Input::get('legal_id_card');
//		$project->legal_cre_rpt = Input::get('legal_cre_rpt');
//		$project->biz_lic = Input::get('biz_lic');
//		$project->biz_lic_copy = Input::get('biz_lic_copy');
//		$project->tax_reg_card = Input::get('tax_reg_card');
//		$project->tax_reg_card_copy = Input::get('tax_reg_card_copy');
//		$project->org_code_cert = Input::get('org_code_cert');
//		$project->org_code_cert_copy = Input::Get('org_code_cert_copy');
//		$project->finance_rpt = Input::get('finance_rpt');
//		$project->hyg_lic = Input::get('hyg_lic');
//		$project->company_photo = Input::get('company_photo');


		$project->state = '01';
		$project->user_id = Auth::id();

        $project->save();

        return Redirect::action('ProjectController@getFinancingInfo', array('project_id'=>$project->id));
	}


    //融资需求表单-第二步
    public function getFinancingInfo($project_id){
        $project = Project::find($project_id);
        return View::make('projects.project-financing-info', array('project'=>$project));

    }

    //保存融资需求
    public function postFinancingInfo(){
        $project_id = Input::get('project_id');
        $save_action = Input::get('save_action');

        if($save_action == 'back'){
            return Redirect::action('ProjectController@getEdit', array('project_id'=>$project_id));
        }


        $project = Project::find($project_id);

        //融资信息
        $project->raise_quota = Input::get('raise_quota');
        $project->retain_stockholder = Input::get('retain_stockholder');
        $project->assign_share = Input::get('assign_share');
        $project->assign_copies = Input::get('assign_copies');
        $project->quota_of_copy = Input::get('quota_of_copy');
        $project->raise_days = Input::get('raise_days');
        $project->app_flag = 'Y';       //必须允许预约
        $project->allow_nolocal = Input::get('allow_nolocal', 'Y');

        $project->save();

        return Redirect::action('ProjectController@getConfirmInfo', array('project_id'=>$project->id));

    }

    //确认信息  第三步
    public function getConfirmInfo($project_id){

        $project = Project::find($project_id);

        return View::make('projects.project-confirm-info', array('project'=>$project));
    }

    public function postConfirmInfo(){
        $project_id = Input::get('project_id');
        $save_action = Input::get('save_action');

        if($save_action == 'back'){
            return Redirect::action('ProjectController@getFinancingInfo', array('project_id'=>$project_id));
        }

        $project = Project::find($project_id);

        if($save_action == 'draft'){
            $project->state = 'SAVE_DRAFT';     //保存草稿
        }else if($save_action == 'submit'){
            $project->state = 'SUBMIT_AUDIT';     //提交审核

            $audit_apply = new AuditApply();
            $audit_apply->obj_id = $project->id;
            $audit_apply->obj_type = 'PROJECT_AUDIT';
            $audit_apply->obj_snapshot = $project->toJson();
            $audit_apply->submit_user = Auth::id();
            $audit_apply->submit_time = date('Y-m-d H:i:s', time());
            $audit_apply->audit_state = '0';
            $audit_apply->save();
        }

        $project->save();

        return View::make('projects.project-save-finished', array('save_action'=>$save_action));
    }


    public function getShow($id)
	{
		$project = Project::find($id);
        return View::make('projects.project-show', array('project' => $project));
	}


	
	public function getEdit($id)
	{
		$project = Project::find($id);

        $province_select = Province::all();
        $city_select = City::where('province_code','=',$project->province_code)->get();
        $industry_select = Industry::where('parent', '=', 'I')->where('enabled', '=', 'Y')->get();
        $sub_industry_select = Industry::where('parent', '=', $project->industry['parent'])->where('enabled', '=', 'Y')->get();


        //dd($sub_industry_select->toArray());

        return View::make('projects.project-edit', array('project' => $project,
                                                        'province_select' => $province_select,
                                                        'city_select' => $city_select,
                                                        'industry_select' => $industry_select,
                                                        'sub_industry_select' => $sub_industry_select
                                                        )
                        );
	}


	
	public function postUpdate()
	{
        $project_id = Input::get('project_id');

        $project = Project::find($project_id);

        $project->project_name = Input::get('project_name');
        $project->project_cover = Input::get('project_cover');
        $project->sub_title = Input::get('sub_title');
        $project->industry_code = Input::get('industry_code');
        $project->province_code = Input::get('province_code');
        $project->city_code = Input::get('city_code');
        $project->address = Input::get('address');
        $project->detail = Input::get('detail');
        $project->business_plan = Input::get('business_plan');


        $project->save();

        return Redirect::action('ProjectController@getFinancingInfo', array('project_id'=>$project->id));
	}


	
	public function postDelete($id)
	{
		//
	}


}
