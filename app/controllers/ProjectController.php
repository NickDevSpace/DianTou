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


        $where = "state in ('05','07','09') ";
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
        }



        $plist = Project::whereRaw($where, $params)->simplePaginate(12);;
        //dd(Project::find(1)->toArray());
        //dd($list->toArray());

        $industry_list = Industry::where('parent', '=', 'I')->where('enabled', '=', 'Y')->get();
        //dd($all_industries->toArray());
        $state_list = array(array('state_code'=>'05','state_name'=>'预约中'), array('state_code'=>'07', 'state_name'=>'融资中'), array('state_code'=>'09', 'state_name'=>'融资成功'));

        $cates = array('industry_list'=>$industry_list->toArray(), 'state_list'=>$state_list);

        return View::make('projects.project-index', array('cates'=>$cates, 'params'=>array('p_industry' => $p_industry, 'p_state'=>$p_state, 'p_w'=>$p_w), 'plist'=>$plist));
	}


	
	public function getCreate()
	{
		//
        $user = Auth::user();

        $province_select = Province::all();

        $industry_select = Industry::where('parent', '=', 'I')->where('enabled', '=', 'Y')->get();

        return View::make('projects.project-create', array('user'=>$user,
                                                            'province_select' => $province_select,
                                                            'industry_select' => $industry_select));

	}


	
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
		
		//融资信息
		$project->total_quota = Input::get('total_quota');
		$project->retain_quota = Input::get('retain_quota');
		$project->raise_quota = Input::get('raise_quota');
		$project->part_count = Input::get('part_count');
		$project->quota_of_part = Input::get('quota_of_part');
		$project->raise_days = Input::get('raise_days');
		$project->raise_start_date = Input::get('raise_start_date');
		$project->raise_end_date = Input::get('raise_end_date');
        $project->app_flag = 'Y';       //必须允许预约
        $project->app_margin_flag = 'Y';        //预约必须要交保证金
        $project->app_margin_ratio = 0.1;       //保证金比例10%
        $project->allow_nolocal = Input::get('allow_nolocal', 'Y');
        $project->app_open_part_count = Input::get('app_open_part_count');
		
		
		//公司信息
        $project->has_company = Input::get('has_company', 'N');
		$project->company_name = Input::get('company_name');
		$project->legal_person = Input::get('legal_person');
		$project->startup_date = Input::get('startup_date');
		$project->registered_address = Input::get('registered_address');
		$project->legal_id_card = Input::get('legal_id_card');
		$project->legal_cre_rpt = Input::get('legal_cre_rpt');
		$project->biz_lic = Input::get('biz_lic');
		$project->biz_lic_copy = Input::get('biz_lic_copy');
		$project->tax_reg_card = Input::get('tax_reg_card');
		$project->tax_reg_card_copy = Input::get('tax_reg_card_copy');
		$project->org_code_cert = Input::get('org_code_cert');
		$project->org_code_cert_copy = Input::Get('org_code_cert_copy');
		$project->finance_rpt = Input::get('finance_rpt');
		$project->hyg_lic = Input::get('hyg_lic');
		$project->company_photo = Input::get('company_photo');
		
		
		$project->state = '07';
		$project->user_id = Auth::id();

        $project->save();

        return Redirect::route('projects.show', $project->id);
	}


	
	public function getShow($id)
	{
		$project = Project::find($id);
        return View::make('projects.project-show', array('project' => $project));
	}


	
	public function getEdit($id)
	{
		//
	}


	
	public function postUpdate($id)
	{
		//
	}


	
	public function postDelete($id)
	{
		//
	}


}
