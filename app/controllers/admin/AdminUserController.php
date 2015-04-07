<?php

class AdminUserController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $query = array();
        $query['account'] = Input::get('account') == null ? '' : Input::get('account');

        $users = User::where('account', 'like', '%'.$query['account'].'%')->simplePaginate(12);
        $total = User::where('account', 'like', '%'.$query['account'].'%')->count();
        return View::make('admin.user.index', array('query'=>$query, 'users'=>$users, 'total'=> $total));

	}

    public function getDetail($id){
        if($id == null){
            dd('ERROR_USER_ID_NOT_VALID');
        }

        $user = User::where('id', '=', $id)->first();

        return View::make('admin.user.detail', array('user'=>$user));
    }

    public function postLockUser(){
        $id = Input::get('id');

        $user = User::find($id);

        if($user == null){
            return Response::json(array('errno'=>'ERROR_USER_NOT_FOUND'));
        }

        $user->active = 'N';
        $user->save();

        return Response::json(array('errno'=>'SUCCESS'));

    }

    public function postUnlockUser(){
        $id = Input::get('id');

        $user = User::find($id);

        if($user == null){
            return Response::json(array('errno'=>'ERROR_USER_NOT_FOUND'));
        }

        $user->active = 'Y';
        $user->save();

        return Response::json(array('errno'=>'SUCCESS'));

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
