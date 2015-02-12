<?php

class AuthController extends \BaseController {


    public function getRegister(){
        $province_data = Province::all();
        $province_select = parent::toSelectable($province_data, 'province_code', 'province_name');
        $city_data = City::all();
        $city_select = parent::toSelectable($city_data, 'city_code', 'city_name');
        return  View::make('auth.register', array('province_select' => $province_select, 'city_select' => $city_select));
    }

    public function postRegister(){
        $inputs = array(
            'mobile' => Input::get('mobile'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'nickname' => Input::get('nickname'),
            'province_code' => Input::get('province_code'),
            'city_code' => Input::get('city_code')
        );
        $validator = Validator::make(
            $inputs,
            array(
                'mobile' => 'numeric',
                'password' => 'required|min:6|confirmed',
                'nickname' => 'required|alpha_dash',
                'province_code' => 'alpha_num',
                'city_code' => 'alpha_num'
            )
        );

        if(!$validator->fails()){
            $user = new User();
            $user->mobile = $inputs['mobile'];
            $user->password = Hash::make($inputs['password']);
            $user->nickname = $inputs['nickname'];
            $user->province_code = $inputs['province_code'];
            $user->city_code = $inputs['city_code'];
            $user->save();

            Auth::loginUsingId($user->id);
            return Redirect::route('home');
        }else{
            return Redirect::route('auth.register')->withErrors($validator);;
        }


    }
    public function getLogin()
    {
        return View::make('auth.login');
    }

    /**
     * Login action
     * @return Redirect
     */
    public function postLogin()
    {

        $mobile = Input::get('mobile');
        $password = Input::get('password');

        if (Auth::attempt(array('mobile' => $mobile, 'password' => $password)))
        {
            return Redirect::route('home');
        }

        return Redirect::route('auth.login');
    }

    /**
     * Logout action
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('auth.login');
    }


}
