<?php

class AdminProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$query_params['state'] = Input::get('state','');
        $query_params['keyword'] = Input::get('keyword','');

        $query = Project::whereRaw('1=1');

        if(isset($query_params['state']) && $query_params['state'] != ''){
            $query = $query->where('state','=',$query_params['state']);
        }
        if(isset($query_params['keyword']) && $query_params['keyword'] != ''){
            $query = $query->where('project_name','like','%'.$query_params['keyword'].'%');
        }

        $projects = $query->orderBy('created_at','desc')->simplePaginate(10);


        $state_select = SystemDict::where('dict_name','=','PROJECT_STATE')->where('enabled','=','Y')->get();

        return View::make('admin.project.index', array('query_params' => $query_params, 'state_select'=>$state_select, 'projects' => $projects));

    }

    public function getManage($id){
        $project = Project::findOrFail($id);

        return View::make('admin.project.manage', array('project' => $project));


    }

}
