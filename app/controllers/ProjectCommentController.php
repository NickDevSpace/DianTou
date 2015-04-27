<?php

class ProjectCommentController extends \BaseController {

    public function postSave(){
        $project_id = Input::get('project_id');
        $replay_to = Input::get('replay_to');
        $content = Input::get('content');

        $comment = new ProjectComment();
        $comment->project_id = $project_id;
        $comment->content = $content;
        $comment->user_id = Auth::id();
        $comment->replay_to = $replay_to;

        $comment->save();

        return Response::json(array('errno'=>'SUCCESS', 'message'=> 'ERROR_FOLLOW_ALREADY_EXISTS'));

    }
	


}
