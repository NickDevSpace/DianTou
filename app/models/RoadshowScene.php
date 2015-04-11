<?php

class RoadshowScene extends \Eloquent {
	protected $fillable = [];

    public function province()
    {
        return $this->hasOne('Province', 'province_code', 'province_code');
    }

    public function city()
    {
        return $this->hasOne('City', 'city_code', 'city_code');
    }

    public function projectRoadshows(){
        return $this->hasMany('ProjectRoadshow', 'roadshow_scene_id', 'id');
    }
}