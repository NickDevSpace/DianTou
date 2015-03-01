<?php

class IController extends \BaseController {

	
	public function getInfo(){
		$user = Auth::user();
		$province_select = Province::all();
		$city_select = City::where('province_code', '=', $user->province_code)->get();
		//dd($city_select);
		return View::make('i.info', array('user'=>$user, 'province_select'=>$province_select, 'city_select'=>$city_select));
	}
	
	public function postInfo(){
		$user = Auth::user();
		$user->nickname = Input::get('nickname');
		$user->email = Input::get('email');
		$user->sex = Input::get('sex');
		$user->province_code = Input::get('province_code');
		$user->city_code = Input::get('city_code');
		$user->address = Input::get('address');
		
		//return bool
		$ret = $user->save();
		
		return Redirect::action('IController@getInfo')->with('message', '保存成功！');
		//return View::make('i.info', array('user'=>$user, 'province_select'=>$province_select, 'city_select'=>$city_select));
	}
	
	public function getAuth(){
		$user = Auth::user();
		return View::make('i.auth', array('user'=>$user));
	}
	
	public function postAuth(){
	
	}
	
	public function getPasswd(){
		return View::make('i.passwd');
	}
	
	public function postPasswd(){
	
	}
	
	
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

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

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
