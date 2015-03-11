<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/10
 * Time: 22:07
 */

class SmsVerificationService {

    public function genVCode($length = 6, $valid_time = 60){
        //如果session中60秒内已经有验证码，说明前台用户是故意短时间内请求发送多个验证码，则予以拒绝
        if(Session::get('v_code') && Session::get('v_code_exp_time')){
            if(time() <= Session::get('v_code_exp_time'))
                return false;
        }

        $v_code = str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);

        //然后这里调用短信接口发送短信
        //...

        Session::put('v_code', $v_code);
        Session::put('v_code_exp_time', time() + $valid_time);

        return $v_code;

    }

    public function verifyCode($v_code){
        if(Session::get('v_code') && Session::get('v_code_exp_time')){
            if(Session::get('v_code') == $v_code)
                return true;
        }

        return false;
    }
} 