<?php

class RoadshowSceneController extends \BaseController {


    public function getSceneApply(){
        $project_id = Input::get('project_id');

        $project = Project::find($project_id);

        if($project == null || $project->user_id != Auth::id()){
            dd('ERROR_SYSTEM_ERROR');
        }

        $roadshow_scenes = RoadshowScene::where('province_code','=',$project->province_code)
                                        ->where('city_code', '=', $project->city_code)
                                        ->orderBy('scene_date', 'desc')->simplePaginate(20);


        return View::make('roadshow.roadshow-apply', array('project'=>$project, 'roadshow_scenes'=>$roadshow_scenes));
    }

    public function postSceneApply(){
        $project_id = Input::get('project_id');
        $roadshow_scene_id = Input::get('roadshow_scene_id');


        $project = Project::findOrFail($project_id);
        $roadshow_scene = RoadshowScene::findOrFail($roadshow_scene_id);

        if($project->state != 'AUDIT_PASS' || $project->user_id != Auth::id()){
            dd('ERROR_SYSTEM_ERROR');
        }

        $seated = $roadshow_scene->projectRoadshows->count();
        if($seated >= $roadshow_scene->seats){
            dd('ERROR_SEATS_IS_FULL');
        }


        //保存申请信息
        $roadshow = new ProjectRoadshow();
        $roadshow->project_id = $project_id;
        $roadshow->roadshow_scene_id = $roadshow_scene_id;
        $roadshow->show_seq = $roadshow_scene->$seated + 1;
        $roadshow->save();

        //更新项目状态
        $project->state = 'ROADSHOW';
        $project->save();

        //项目里程碑
        $event = new ProjectLifeEvent();
        $event->project_id = $project->id;
        $event->event_type = 'ROADSHOW';
        $event->event_desc = '项目路演';
        $event->event_date = $roadshow_scene->scene_date;
        $event->save();

        return View::make('roadshow.roadshow-apply-result', array('roadshow_scene'=>$roadshow_scene));

    }

    public function getSceneDetail($id){
        $roadshow_scene = RoadshowScene::findOrFail($id);

        if($roadshow_scene == null){
            dd('ERROR_SYSTEM_ERROR');
        }

        return View::make('roadshow.roadshow-scene-detail', array('roadshow_scene'=>$roadshow_scene));



    }


	


}
