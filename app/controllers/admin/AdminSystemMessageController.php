<?php

class AdminSystemMessageController extends \BaseController
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $query = array();
        $query['w'] = Input::get('w') == null ? '' : Input::get('w');

        $messages = SystemMessage::where('title', 'like', '%' . $query['w'] . '%')->orWhere('content', 'like', '%' . $query['w'] . '%')
            ->orderBy('send_time', 'desc')
            ->simplePaginate(10);
        $total = SystemMessage::where('title', 'like', '%' . $query['w'] . '%')->orWhere('content', 'like', '%' . $query['w'] . '%')->count();
        return View::make('admin.sm.index', array('query' => $query, 'messages' => $messages, 'total' => $total));
    }

    public function getCreate(){

        return View::make('admin.sm.create');
    }

    public function postSave(){
        $inputs = array('title' => Input::get('title'),
                        'content' => Input::get('content'),
                        'send_type' => Input::get('send_type')
                        );

        $message = new SystemMessage();
        $message->title = $inputs['title'];
        $message->content = $inputs['content'];
        $message->send_type = $inputs['send_type'];
        $message->send_time = date('Y-m-d H:i:s', time());
        $message->sender = Auth::id();
        $message->save();

        $id = $message->id;
        $sql = "";
        if($inputs['send_type'] == '1'){        //全部用户

            $sql = "insert into system_message_deliveries(message_id, receiver, created_at, updated_at) ".
                    "select ".$id.", id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP from users where active = 'Y' and user_level = 1 ";

        }else if($inputs['send_type'] == '2'){      //全部个人用户

            $sql = "insert into system_message_deliveries(message_id, receiver, created_at, updated_at) ".
                "select ".$id.", id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP from users where active = 'Y' and user_type = '1' and user_level = 1 ";

        }else if($inputs['send_type'] == '3'){      //全部企业用户

            $sql = "insert into system_message_deliveries(message_id, receiver, created_at, updated_at) ".
                "select ".$id.", id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP from users where active = 'Y' and user_type = '2' and user_level = 1 ";

        }


        DB::update(DB::raw($sql));

        return Redirect::action('AdminSystemMessageController@getIndex')->with('message', '发送成功！');
    }

    public function postDelete(){
        $id = Input::get('id');
        if($id == null)
            dd('ERROR_MESSAGE_ID_INVALID');

        $ret = SystemMessage::where('id', '=', $id)->delete();
        $ret2 = SystemMessageDelivery::where('message_id', '=', $id)->delete();

        return Response::json(array('errno' => 'SUCCESS', 'message'=>$ret."   ".$ret2));
    }

    public function getView($id){
        if($id == null)
            dd('ERROR_MESSAGE_ID_INVALID');

        $msg = SystemMessage::where('id','=',$id)->first();
        return View::make('admin.sm.detail', array('msg' => $msg));
    }

    public function getTest(){
        DB::update(DB::raw('select * from users'));
    }


}
