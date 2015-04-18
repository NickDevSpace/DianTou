<?php

class Follow extends \Eloquent {
	protected $fillable = [];

    public function project(){
        return $this->hasOne('Project', 'id', 'project_id');
    }
}