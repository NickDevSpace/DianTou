<?php

class PrivateMessage extends \Eloquent {
	protected $fillable = [];
	
	public function fromUser()
    {
        return $this->hasOne('User', 'id', 'from_user');
    }
	
	public function toUser()
	{
        return $this->hasOne('User', 'id', 'to_user' );
    }

}