<?php

class RoadshowManageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$query_params['province_code'] = Input::get('province_code');
        $query_params['city_code'] = Input::get('city_code');
        $query_params['start_date'] = Input::get('start_date', '1899-12-31');
        $query_params['end_date'] = Input::get('end_date', '2999-12-31');
        $query_params['keyword'] = Input::get('keyword', '');

        $query = RoadshowScene::whereRaw('concat(title,detail) like \'%'.$query_params['keyword'].'%\'')
                                ->where('scene_date', '>=', $query_params['start_date'])
                                ->where('scene_date', '<=', $query_params['end_date']);

        if($query_params['province_code'] != null){
            $query->where('province_code', '=', $query_params['province_code']);
        }
        if($query_params['city_code'] != null){
            $query->where('city_code', '=', $query_params['city_code']);
        }

        //dd($query->toSql());
        $results = $query->simplePaginate(10);


        $province_select = Province::all();
        $city_select = array();
        if($query_params['province_code'] != null){
            $city_select = City::where('province_code','=',$query_params['province_code'])->get();
        }

        return View::make('admin.roadshow.index', array('query_params' => $query_params, 'province_select'=>$province_select, 'city_select'=>$city_select, 'results' => $results));

    }

    public function getCreate(){
        $province_select = Province::all();
        $city_select = array();
        return View::make('admin.roadshow.create', array('province_select'=>$province_select, 'city_select'=>$city_select));
    }

    public function postSave(){

        $inputs = array('province_code' => Input::get('province_code'),
                        'city_code' => Input::get('city_code'),
                        'scene_date' => Input::get('scene_date'),
                        'title' => Input::get('title'),
                        'address' => Input::get('address'),
                        'seats' => Input::get('seats'),
                        'detail' => Input::get('detail'));
        $roadshow = new RoadshowScene();
        $roadshow->province_code = $inputs['province_code'];
        $roadshow->city_code = $inputs['city_code'];
        $roadshow->scene_date = $inputs['scene_date'];
        $roadshow->title = $inputs['title'];
        $roadshow->address = $inputs['address'];
        $roadshow->seats = $inputs['seats'];
        $roadshow->detail = $inputs['detail'];
        $roadshow->create_user = Auth::id();

        $roadshow->save();

        return Redirect::action('RoadshowManageController@getIndex')->with('message', '新增成功！');

    }
    public function getManage($id){
        $project = Project::findOrFail($id);

        return View::make('admin.project.manage', array('project' => $project));


    }

}
