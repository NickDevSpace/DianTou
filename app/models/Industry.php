<?php

class Industry extends \Eloquent {
	protected $fillable = [];

    protected $visible = array('industry_code', 'industry_name', 'parent');

    public function parentIndustry(){
        return $this->hasOne('Industry', 'industry_code', 'parent');
    }
}