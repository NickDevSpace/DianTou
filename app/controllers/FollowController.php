<?php

class FollowController extends \BaseController {


    /**
     * 创建关注（较完善）
     * @return mixed
     */
    public function postCreateFollow(){
        $project_id = Input::get('project_id');

        $project = Project::find($project_id);

        if($project == null){
            return Response::json(array('error'=>1, 'message'=> 'ERROR_PROJECT_NOT_FOUND'));
        }

        $follow = Follow::where('project_id','=',$project_id)->where('user_id','=',Auth::id())->first();

        if($follow != null){
            return Response::json(array('error'=>1, 'message'=> 'ERROR_FOLLOW_ALREADY_EXISTS'));
        }

        //如果还没有关注
        $follow = new Follow();
        $follow->project_id = $project_id;
        $follow->user_id = Auth::id();
        $follow->save();

        return Response::json(array('error'=>0, 'message'=> 'OK'));
    }

    /**
     * 取消关注（较完善）
     */
    public function postDeleteFollow($id){
        $follow = Follow::find($id);

        if($follow != null){
            $follow->delete();
        }
        return Response::json(array('error'=>0, 'message'=> 'OK'));
    }


}
