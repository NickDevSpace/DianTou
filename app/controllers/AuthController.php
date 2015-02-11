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
        $mobile = Input::get('mobile');
        $password = Input::get('password');
        $nickname = Input::get('nickname');
        $province_code = Input::get('province_code');
        $city_code = Input::get('city_code');

        $user = new User();
        $user->mobile = $mobile;
        $user->password = Hash::make($password);
        $user->nickname = $nickname;
        $user->province_code = $province_code;
        $user->city_code = $city_code;
        $user->save();

        Auth::loginUsingId($user->id);
        return Redirect::route('home');
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
