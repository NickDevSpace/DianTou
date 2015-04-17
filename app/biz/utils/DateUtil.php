<?php
/**
 * Created by PhpStorm.
 * User: Cc
 * Date: 2015-4-15
 * Time: 16:27
 */

class DateUtil {

    public static function today(){
        return date('Y-m-d', time());
    }

    public static function addDays($ymd_date, $add_days){
        return date('Y-m-d',strtotime('+'.$add_days.' day',strtotime($ymd_date)));
    }

    /**
     * @param $future_date 未来日期
     * @return float 返回离$future_date还差几天
     */
    public static function leftDays($future_date){
        $d1=strtotime(date("Y-m-d"));
        $d2=strtotime($future_date);
        return round(($d2-$d1)/3600/24);
    }
}