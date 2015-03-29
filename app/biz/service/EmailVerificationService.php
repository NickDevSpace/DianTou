<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/14
 * Time: 22:12
 */

class EmailVerificationService {

    public static function genVEmail($email, $back_url){
        $email = $email;
        $time = time();

        $token = md5($email.$time);
        $exp_time = $time + 60;      //一分钟过期
        Session::put('EmailVerification.email', $email);
        Session::put('EmailVerification.token', $token);
        Session::put('EmailVerification.exp_time', $exp_time);

        $verification_url = $back_url . '?token=' . $token;
        //调用发送邮件接口
        Mail::send('emails.auth.email-verification', array('verification_url'=>$verification_url, 'email'=>$email), function($message) use($email)
        {
            $message->to($email, $email)->subject('点投网注册验证');
        });

    }

    public static function verifyEmail($token){
        if(Session::get('EmailVerification.token') && Session::get('EmailVerification.exp_time')){
            $_token = Session::get('EmailVerification.token');
            $_exp_time = Session::get('EmailVerification.exp_time');
            if(time() <= $_exp_time && $token == $_token){
                $email = Session::get('EmailVerification.email');
                Session::forget('EmailVerification.email');
                Session::forget('EmailVerification.token');
                Session::forget('EmailVerification.exp_time');
                return $email;
            }
        }

        return null;

    }
} 