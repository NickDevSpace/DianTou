<?php

class PrivateMessage extends \Eloquent {
	protected $fillable = [];
	
	public function Sender()
    {
        return $this->hasOne('User', 'id', 'sender');
    }
	
	public function Receiver()
	{
        return $this->hasOne('User', 'id', 'receiver' );
    }

}