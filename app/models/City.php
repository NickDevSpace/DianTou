<?php

class City extends \Eloquent {
	protected $fillable = [];

    protected $visible = array('city_code', 'city_name', 'province_code');
}