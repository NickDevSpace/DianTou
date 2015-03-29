<?php

class HelpController extends \BaseController {

	public function getIndex(){
		return View::make('help.001');
	}
	
	public function getShow($id){
		return View::make('help.'.$id);
	}


}
