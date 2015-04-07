<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/7
 * Time: 20:55
 */

class SystemMessageService {

    /**
     * 程序用于发送给指定某个用户系统消息
     * @param $user_id
     * @param $title
     * @param $content
     */
    public static function send($user_id, $title, $content){
        $message = new SystemMessage();
        $message->title = $title;
        $message->content = $content;
        $message->send_type = '3';      //指定会员发送
        $message->send_time = date('Y-m-d H:i:s', time());
        $message->sender = 0;   //表示系统自动发送
        $message->save();

        $delivery = new SystemMessageDelivery();
        $delivery->message_id = $message->id;
        $delivery->receiver = $user_id;
        $delivery->save();
    }
} 