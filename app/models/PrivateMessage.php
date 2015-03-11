<?php

class PrivateMessage extends \Eloquent {
	protected $fillable = [];
	
	public function sender()
    {
        return $this->hasOne('User', 'sender', 'sender');
    }
	
	public function receiver()
	{
        return $this->hasOne('User', 'id', 'receiver');
    }

}