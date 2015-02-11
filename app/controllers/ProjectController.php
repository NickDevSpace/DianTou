<?php

class ProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $user = Auth::user();

        $stage_data = Dict::where('dict_name', '=', 'project_stage')->get();
        $stage_select = parent::toSelectable($stage_data, 'key', 'value');
        $province_data = Province::all();
        $province_select = parent::toSelectable($province_data, 'province_code', 'province_name');
        $city_data = City::all();
        $city_select = parent::toSelectable($city_data, 'city_code', 'city_name');
        return View::make('projects.project-create', array('user'=>$user,
                                                            'stage_select' => $stage_select,
                                                            'province_select' => $province_select,
                                                            'city_select' => $city_select));

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $project_name = Input::get('project_name');
        $cover_img = Input::get('cover_img');
        $big_point = Input::get('big_point');
        $project_stage = Input::get('project_stage');
        $team_size = Input::get('team_size');
        $industry_id = Input::get('industry_id');
        $province_code = Input::get('province_code');
        $city_code = Input::get('city_code');
        $address = Input::get('address');
        $business_plan_doc = Input::get('business_plan_doc');
        $video_url = Input::get('video_url');
        $user_demand = Input::get('user_demand');
        $solution = Input::get('solution');
        $solution_advantage = Input::get('solution_advantage');
        $market_analysis = Input::get('market_analysis');
        $development_plan = Input::get('development_plan');
        $other = Input::get('other');
        $project_album = Input::get('project_album');
        $revenue_driver = Input::get('revenue_driver');
        $cost_structure = Input::get('cost_structure');
        $financial_data = Input::get('financial_data');
        $profit_forecast = Input::get('profit_forecast');
        $team_members = Input::get('team_members');
        $has_company = Input::get('has_company');
        $company_info = Input::get('company_info');
        $state = 1;

        $project = new Project();
        $project->project_name = $project_name;
        $project->project_no = 'P'.date('YmdHis',time());
        $project->cover_img = $cover_img;
        $project->big_point = $big_point;
        $project->project_stage = $project_stage;
        $project->team_size = $team_size;
        $project->industry_id = $industry_id;
        $project->province_code = $province_code;
        $project->city_code = $city_code;
        $project->address = $address;
        $project->business_plan_doc = $business_plan_doc;
        $project->video_url = $video_url;
        $project->user_demand = $user_demand;
        $project->solution = $solution;
        $project->solution_advantage = $solution_advantage;
        $project->market_analysis = $market_analysis;
        $project->development_plan = $development_plan;
        $project->other = $other;
        $project->project_album = $project_album;
        $project->revenue_driver = $revenue_driver;
        $project->cost_structure = $cost_structure;
        $project->financial_data = $financial_data;
        $project->profit_forecast = $profit_forecast;
        $project->team_members = $team_members;
        $project->has_company = $has_company;
        $project->company_info = $company_info;
        $project->state = $state;
        $project->save();

        return Redirect::route('projects.show', $project->id);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = Project::find($id);
        return View::make('projects.project-show', array('project' => $project));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
