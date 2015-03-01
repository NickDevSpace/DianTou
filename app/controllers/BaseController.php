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

    protected function toSelectable($data, $key_name, $val_name, $header_value){
        $for_select = array();
        foreach($data as $d){
            $for_select[$d->$key_name] = $d->$val_name;
        }
        return $for_select;
    }

}

Form::macro('amSelect', function($option)
{
    $list = $option['list'];
    $value_field = $option['value_field'];
    $text_field = $option['text_field'];
    $header_text = isset($option['header_text']) ? $option['header_text'] : null;
    $selected = isset($option['selected']) ? $option['selected'] : null;
    $id = isset($option['id']) ? $option['id'] : null;
    $class = isset($option['class']) ? $option['class'] : null;
    $name = isset($option['name']) ? $option['name'] : null;
	$required = (isset($option['required'])&&$option['required'] == 'true') ? 'required':'';

	if(trim($value_field) == '' || trim($text_field) == '')
		$list = array();
		
    $html = '<select';
    if($id != null){
        $html .= ' id="'.$id.'"';
    }
    if($class != null){
        $html .= ' class="'.$class.'"';
    }
    if($name != null){
        $html .= ' name="'.$name.'"';
    }
    $html .= ' '.$required.' >';
    if($header_text != null){
        $html .= '<option' .' value="">' . $header_text . '</option>';
    }
    foreach($list as $i){
        $html .= '<option value="' .$i[$value_field]. '"';
        if($i[$value_field] === $selected){
            $html .= ' selected="selected"';
        }
        $html .= '>' .$i[$text_field]. '</option>';
    }

    $html .= '</select>';

    return $html;
});