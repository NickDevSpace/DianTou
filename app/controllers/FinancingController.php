<?php

class FinancingController extends \BaseController {

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
        $project_id = Input::get('project_id');
        $project = Project::find($project_id);
        return View::make('financings.financing-create', array('project'=>$project));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $project_no = Input::get('project_no');
        $financing_seq = 1;
        $financial_needs = Input::get('financial_needs');
        $transfer_ratio = Input::get('transfer_ratio');
        $min_sub_amt = Input::get('min_sub_amt');
        $capital_usage = Input::get('capital_usage');
        $financing_days = Input::get('financing_days');
        $state = '1';
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
