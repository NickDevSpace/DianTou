<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function toSelectable($data, $key_name, $val_name){
        $for_select = array();
        foreach($data as $d){
            $for_select[$d->$key_name] = $d->$val_name;
        }
        return $for_select;
    }

}
