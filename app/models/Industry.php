<?php

class Industry extends \Eloquent {
	protected $fillable = [];

    protected $visible = array('industry_code', 'industry_name', 'parent');
}