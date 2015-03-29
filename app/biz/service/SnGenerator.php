<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/25
 * Time: 18:34
 */

class SnGenerator {

    public static function getOrderSn()
    {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);
        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }
} 