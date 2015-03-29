<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function province(){
        return $this->hasOne('Province', 'province_code', 'province_code');
    }

    public function city(){
        return $this->hasOne('City', 'city_code', 'city_code');
    }

    public function userinfo()
    {
        if($this->user_type == '1') {
            return $this->hasOne('UserinfoPrivate', 'user_id', 'id');
        }else{
            return $this->hasOne('UserinfoEnterprise', 'user_id', 'id');
        }
    }

    public function systemMessages()
    {
        return $this->belongsToMany('SystemMessage', 'system_message_deliveries', 'receiver', 'message_id');
    }


}
