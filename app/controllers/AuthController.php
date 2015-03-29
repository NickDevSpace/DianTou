<?php

class AuthController extends \BaseController {

    /**
     * 注册首页，默认显示个人账户注册
     * @return mixed
     */
    public function getReg(){

        return  View::make('auth.priv-reg-1');
    }

    /**
     * 点击下一步，验证短信验证码是否输入正确，
     * 正确的话重定向到getPriAcctReg
     */
    public function postCheckPrivReg(){
        $account = Input::get('account');
        $v_code = Input::get('v_code');

        if($account != null && SmsVerificationService::verifyCode($account, $v_code)) {
            Session::put('reg.account', $account);
            return Redirect::action('AuthController@getCreatePrivAcct');
        }
        dd('ERROR_ACCOUNT_OR_VCODE_NOT_VALID');
        //return Redirect::action('AuthController@getPrivAcctForm');
    }

    /**
     * 填写个人账户基本信息
     */
    public function getCreatePrivAcct(){
        if(Session::get('reg.account') != null){
            $account = Session::get('reg.account');

            $province_select = Province::all();

            $industry_select = Industry::where('parent', '=', 'I')->where('enabled', '=', 'Y')->get();
            return View::make('auth.priv-reg-2', array('account' => $account, 'province_select'=>$province_select, 'industry_select'=>$industry_select));
        }

        dd('ERROR_VCODE_NOT_VALID');

    }

    /**
     * 提交注册，保存个人账户基本信息
     * 注册成功，跳转到欢迎页面，并询问是否马上进行实名认证
     */
    public function postSavePrivAcct(){
        $inputs = array(
            'account' => Input::get('account'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'nickname' => Input::get('nickname'),
            'province_code' => Input::get('province_code'),
            'city_code' => Input::get('city_code')
        );
        $validator = Validator::make(
            $inputs,
            array(
                'account' => 'numeric',
                'password' => 'required|min:6|confirmed',
                'nickname' => 'required|alpha_dash',
                'province_code' => 'alpha_num',
                'city_code' => 'alpha_num'
            )
        );

        if(!$validator->fails()){
            $user = new User();
            $user->account = $inputs['account'];
            $user->password = Hash::make($inputs['password']);
            $user->nickname = $inputs['nickname'];
            $user->province_code = $inputs['province_code'];
            $user->city_code = $inputs['city_code'];
            $user->user_type = '1';
            $user->save();

            $userinfo = new UserinfoPrivate();
            $userinfo->user_id = $user->id;
            $userinfo->mobile = $user->account;
            $userinfo->save();

            Auth::loginUsingId($user->id);

            return  View::make('auth.priv-reg-3');

        }else{
            return Redirect::action('AuthController@getCreatePrivAcct');
        }
    }

    /**
     * 点击“企业账户”选项卡，进入本页面
     * 填写邮箱，点下一步，post到postEntReg
     */
    public function getEntReg(){
        return  View::make('auth.ent-reg-1');
    }

    /**
     * 生成邮件验证链接，要求去邮箱验证邮件，点击链接，返回继续注册
     */
    public function postEntReg(){
        $email = Input::get('account');
        $back_url = action('AuthController@getCheckEntReg');

        EmailVerificationService::genVEmail($email, $back_url);

        $mail_host = 'http://mail.'.substr($email, strpos($email, '@') + 1);
        return View::make('auth.ent-reg-2', array('mail_host'=>$mail_host));
    }
    /**
     * 点击下一步，验证短信验证码是否输入正确，
     * 正确的话重定向到getPriAcctReg
     */
    public function getCheckEntReg(){
        $token = Input::get('token');

        if($token != null) {
            $account = EmailVerificationService::verifyEmail($token);
            if($account != null){

                Session::put('reg.account', $account);
                return Redirect::action('AuthController@getCreateEntAcct');
            }
        }
        dd('ERROR_TOKEN_NOT_VALID');
        //return Redirect::action('AuthController@getPrivAcctForm');
    }

    /**
     *
     */
    public function getCreateEntAcct(){
        if(Session::get('reg.account') != null){
            $account = Session::get('reg.account');

            $province_select = Province::all();

            $industry_select = Industry::where('parent', '=', 'I')->where('enabled', '=', 'Y')->get();
            return View::make('auth.ent-reg-3', array('account' => $account, 'province_select'=>$province_select, 'industry_select'=>$industry_select));
        }

        dd('ERROR_ACCOUNT_NOT_SET');
    }


    public function postSaveEntAcct(){
        $inputs = array(
            'account' => Input::get('account'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'province_code' => Input::get('province_code'),
            'city_code' => Input::get('city_code')
        );
        $validator = Validator::make(
            $inputs,
            array(
                'account' => 'email',
                'password' => 'required|min:6|confirmed',
                'province_code' => 'alpha_num',
                'city_code' => 'alpha_num'
            )
        );

        if(!$validator->fails()){
            $user = new User();
            $user->account = $inputs['account'];
            $user->password = Hash::make($inputs['password']);
            $user->province_code = $inputs['province_code'];
            $user->city_code = $inputs['city_code'];
            $user->user_type = '2';     //企业账户
            $user->save();

            $userinfo = new UserinfoEnterprise();
            $userinfo->user_id = $user->id;
            $userinfo->email = $user->account;
            $userinfo->save();

            Auth::loginUsingId($user->id);

            return  View::make('auth.ent-reg-4');

        }else{
            return Redirect::action('AuthController@getCreateEntAcct');
        }

    }

    /**
     * 个人实名认证页面
     * @return mixed
     */
    public function getPrivAuth(){
        return  View::make('auth.priv-auth');
    }

    /**
     * 保存个人实名认证信息，将个人用户的认证状态改为待审核
     * 通过审核以后的账户方可进行投资或融资
     */
    public function postPrivAuth(){
        $inputs  = array('real_name' => Input::get('real_name'),
                        'sex' => Input::get('sex'),
                        'birthday' => Input::get('birthday'),
                        'crdt_id' => Input::get('crdt_id'),
                        'crdt_photo_a' => Input::get('crdt_photo_a'),
                        'crdt_photo_b' => Input::get('crdt_photo_b')
        );

        $user = Auth::user();
        if($user->verification_state == '1' || $user->verification_state == '3'){       //未验证或验证未通过

                $user->userinfo['real_name'] = $inputs['real_name'];
                $user->userinfo['sex'] = $inputs['sex'];
                $user->userinfo['birthday'] = $inputs['birthday'];
                $user->userinfo['crdt_id'] = $inputs['crdt_id'];
                $user->userinfo['crdt_photo_a'] = $inputs['crdt_photo_a'];
                $user->userinfo['crdt_photo_b'] = $inputs['crdt_photo_b'];
                $user->verification_state = '2';        //把状态改为待审核
                $user->userinfo->save();
                $user->save();
                return Redirect::action('IController@getAccountAuth')->with('message', '提交成功！');

        }else{
            return Redirect::action('IController@getAccountAuth')->with('message', '操作失败！您已认证过或正在审核，不可重复认证！');
        }
    }

    public function getEntAuth(){
        if(Auth::user()->user_type == '2') {
            return View::make('auth.ent-auth');
        }else{
            return Redirect::route('error-401');
        }
    }

    public function postEntAuth(){
        $inputs  = array('company_name' => Input::get('company_name'),
                        'startup_dt' => Input::get('startup_dt'),
                        'legal_name' => Input::get('legal_name'),
                        'legal_crdt_id' => Input::get('legal_crdt_id'),
                        'legal_crdt_photo_a' => Input::get('legal_crdt_photo_a'),
                        'legal_crdt_photo_b' => Input::get('legal_crdt_photo_b'),
                        'biz_lic_id' => Input::get('biz_lic_id'),
                        'biz_exp_dt' => Input::get('biz_exp_dt'),
                        'address' => Input::get('address'),
                        'telephone' => Input::get('telephone'),
                        'business_scope' => Input::get('business_scope'),
                        'biz_lic_addr' => Input::get('biz_lic_addr'),
                        'biz_lic_photo' => Input::get('biz_lic_photo'),
                        'biz_lic_photo_sealed' => Input::get('biz_lic_photo_sealed'),
                        'org_code' => Input::get('org_code'),
                        'reg_capital' => Input::get('reg_capital')
        );

        $user = Auth::user();
        if($user->verification_state == '1' || $user->verification_state == '3'){       //未验证或验证未通过

            $user->userinfo['company_name'] = $inputs['company_name'];
            $user->userinfo['startup_dt'] = $inputs['startup_dt'];
            $user->userinfo['legal_name'] = $inputs['legal_name'];
            $user->userinfo['legal_crdt_id'] = $inputs['legal_crdt_id'];
            $user->userinfo['legal_crdt_photo_a'] = $inputs['legal_crdt_photo_a'];
            $user->userinfo['legal_crdt_photo_b'] = $inputs['legal_crdt_photo_b'];
            $user->userinfo['biz_lic_id'] = $inputs['biz_lic_id'];
            $user->userinfo['biz_exp_dt'] = $inputs['biz_exp_dt'];
            $user->userinfo['address'] = $inputs['address'];
            $user->userinfo['telephone'] = $inputs['telephone'];
            $user->userinfo['business_scope'] = $inputs['business_scope'];
            $user->userinfo['biz_lic_addr'] = $inputs['biz_lic_addr'];
            $user->userinfo['biz_lic_photo'] = $inputs['biz_lic_photo'];
            $user->userinfo['biz_lic_photo_sealed'] = $inputs['biz_lic_photo_sealed'];
            $user->userinfo['org_code'] = $inputs['org_code'];
            $user->userinfo['reg_capital'] = $inputs['reg_capital'];
            $user->verification_state = '2';        //把状态改为待审核
            $user->userinfo->save();
            $user->save();
            return Redirect::action('IController@getAccountAuth')->with('message', '提交成功！');

        }else{
            return Redirect::action('IController@getAccountAuth')->with('message', '操作失败！您已认证过或正在审核，不可重复认证！');
        }
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
        $inputs = array(
            'account' => Input::get('account'),
            'password' => Input::get('password'),
            'remember' => Input::get('remember-me') == null ? false : true
        );
        $validator = Validator::make(
            $inputs,
            array(
                'account' => 'required',
                'password' => 'required|min:6'
            )
        );
        if(!$validator->fails()){
            if (Auth::attempt(array('account' => $inputs['account'], 'password' => $inputs['password'], 'active' => 'Y'), $inputs['remember']))
            {
                $user = Auth::user();
                $user->last_login = new DateTime();
                $user->last_login_ip = Request::ip();
                $user->save();
                return Redirect::route('home');
            }else{
                return Redirect::route('auth.login');
            }
        }else{
            return Redirect::route('auth.login')->withErrors($validator);
        }


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
