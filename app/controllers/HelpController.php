<?php

class HelpController extends \BaseController {

	public function getIndex(){
		return View::make('help.dtgqzcjj');
	}
	
	public function getShow($id){
		return View::make('help.'.$id);
	}


}
