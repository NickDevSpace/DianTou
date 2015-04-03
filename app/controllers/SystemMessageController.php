<?php

class SystemMessageController extends \BaseController {

	public function postDeleteDeliveries(){
        $delivery_ids = Input::get('delivery_ids');
        if($delivery_ids == null || count($delivery_ids) == 0){
            return Response::json(array('errno'=>'ERROR_DELIVERY_ID_INVALID'));
        }

        SystemMessageDelivery::whereIn('id',$delivery_ids)->update(array('is_deleted'=>'Y'));

        return Response::json(array('errno'=>'SUCCESS'));
    }

    public function postMarkReadDeliveries(){
        $delivery_ids = Input::get('delivery_ids');
        if($delivery_ids == null || count($delivery_ids) == 0){
            return Response::json(array('errno'=>'ERROR_DELIVERY_ID_INVALID'));
        }

        SystemMessageDelivery::whereIn('id',$delivery_ids)->update(array('is_read'=>'Y'));

        return Response::json(array('errno'=>'SUCCESS'));
    }


}
