<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/10
 * Time: 22:07
 */

class SmsVerificationService {

    public static function genVCode($mobile, $length = 6, $valid_time = 60){
        //如果session中60秒内已经有验证码，说明前台用户是故意短时间内请求发送多个验证码，则予以拒绝
        if(Session::get('v_code') && Session::get('SMS_VERIFICATION.exp_time')){
            if(time() <= Session::get('SMS_VERIFICATION.exp_time'))
                return false;
        }

        $v_code = str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);

        //然后这里调用短信接口发送短信
        //...
        Session::put('SMS_VERIFICATION.mobile', $mobile);
        Session::put('SMS_VERIFICATION.v_code', $v_code);
        Session::put('SMS_VERIFICATION.exp_time', time() + $valid_time);

        return $v_code;

    }

    public static function verifyCode($mobile, $v_code){
        if(Session::get('SMS_VERIFICATION.mobile') && Session::get('SMS_VERIFICATION.v_code') && Session::get('SMS_VERIFICATION.exp_time')){
            if(Session::get('SMS_VERIFICATION.mobile') == $mobile && Session::get('SMS_VERIFICATION.v_code') == $v_code){
                Session::forget('SMS_VERIFICATION.mobile');
                Session::forget('SMS_VERIFICATION.v_code');
                Session::forget('SMS_VERIFICATION.exp_time');
                return true;
            }

        }

        return false;
    }
} 