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

        $users = User::where('verification_state', '=', '2')->where('account', 'like', '%'.$query['account'].'%')->simplePaginate(12);
        $total = User::where('verification_state', '=', '2')->where('account', 'like', '%'.$query['account'].'%')->count();
        return View::make('admin.audit.user-certify-index', array('query'=>$query, 'users'=>$users, 'total'=> $total));
	}

    public function getUserCertifyDetail($id){
        if($id == null){
            dd('ERROR_USER_ID_NOT_VALID');
        }

        $user = User::where('id', '=', $id)->first();

        return View::make('admin.audit.user-certify-detail', array('user'=>$user));


    }

    public function postDoUserCertify(){
        $user_id = Input::get('user_id');
        $audit_flag = Input::get('audit_flag');

        if($audit_flag == null || $user_id == null)
            dd('ERROR_PARAMS_NOT_VALID');

        $user = User::where('id', '=', $user_id)->first();

        if($user == null)
            dd('ERROR_USER_NOT_FOUND');

        if($audit_flag == '1'){
            $user->verification_state = '4';        //通过
        }else{
            $user->verification_state = '3';        //不通过
        }

        $user->save();

        return Redirect::action('AdminAuditController@getUserCertify');


    }





}
