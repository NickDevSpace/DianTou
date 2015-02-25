<?php

class ProjectController extends \BaseController {

	
	public function index()
	{
		//
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
		$project->total_amt = Input::get('total_amt');
		$project->retain_amt = Input::get('retain_amt');
		$project->fin_amt = Input::get('fin_amt');
		$project->share_count = Input::get('share_count');
		$project->amt_per_share = Input::get('amt_per_share');
		$project->fin_days = Input::get('fin_days');
		$project->fin_start_date = Input::get('fin_start_date');
		$project->fin_end_date = Input::get('fin_end_date');
		
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
		
		$project->state = 1;
		
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
