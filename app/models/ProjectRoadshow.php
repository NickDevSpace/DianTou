<?php

class ProjectRoadshow extends \Eloquent {
	protected $fillable = [];

    public function project(){
        return $this->hasOne('Project', 'id', 'project_id');
    }

    public function roadshowScene(){
        return $this->hasOne('RoadshowScene', 'id', 'roadshow_scene_id');
    }
}