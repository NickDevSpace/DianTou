<?php

class Financing extends \Eloquent {
	protected $fillable = [];

    public function project(){
        return $this->belongsTo('Project', 'project_no', 'project_no');
    }
}