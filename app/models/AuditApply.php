<?php

class AuditApply extends \Eloquent {
	protected $fillable = [];

    public function submitUser(){
        return $this->hasOne('User', 'id', 'submit_user');
    }

    public function obj(){
        if($this->obj_type == 'USER_CERTIFY'){
            return $this->hasOne('User', 'id', 'obj_id');
        }else if($this->obj_type == 'PROJECT_AUDIT'){
            return $this->hasOne('Project', 'id', 'obj_id');
        }
    }


}