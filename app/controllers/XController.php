<?php

/**
 * Class XController
 * 用于前台一些异步请求
 */
class XController extends \BaseController {


    /**
     * @return mixed
     * 根据省份code获取其下城市
     */
    public function getGetCityList(){
        $province_code = Input::get('province_code');
        $cities = City::where('province_code', '=', $province_code)->where('enabled', '=', 'Y')->get();
        return Response::json($cities);
    }

    /**
     * @return mixed
     * 根据行业大类code来获取其下小类
     */
    public function  getGetIndustryList(){
        $parent = Input::get('parent');
        $industries = Industry::where('parent', '=', $parent)->where('enabled', '=', 'Y')->get();
        return Response::json($industries);

    }

    public function postProjectCoverUpload(){

        if (Input::hasFile('project_cover'))
        {
            $TMP_DIR = Config::get('app.tmpUploadDir');

            if (!file_exists($TMP_DIR)) {
                @mkdir($TMP_DIR);
            }

            $cleanupTargetDir = true; // Remove old files
            $maxFileAge = 5 * 3600; // Temp file age in seconds

            if ($cleanupTargetDir) {
                if (!is_dir($TMP_DIR) || !$dir = opendir($TMP_DIR)) {
                    return Response::json(array('errno'=>1, 'message'=> 'Failed to open temp directory'));
                }

                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $TMP_DIR . DIRECTORY_SEPARATOR . $file;

                    // Remove temp file if it is older than the max age and is not the current file
                    if (@filemtime($tmpfilePath) < time() - $maxFileAge) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            }

            $file = Input::file('project_cover');


            if(!$file->isValid()){
                return Response::json(array('errno'=>2, 'message'=> 'File not valid'));
            }

            $newFileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($TMP_DIR, $newFileName);
            return Response::json(array('errno'=>0, 'path'=>$TMP_DIR.'/'.$newFileName));
        }

        return Response::json(array('errno'=>3, 'message'=> 'File is not uploaded'));

    }

    public function postProjectCoverCrop(){
        $PROJECT_DIR = Config::get('app.project_resource_dir');
        if (!file_exists($PROJECT_DIR)) {
            @mkdir($PROJECT_DIR);
        }
        $targ_w = 460;
        $targ_h = 350;
        $jpeg_quality = 90;

        $src = Input::get('path');
        $dst = $PROJECT_DIR.'/'.pathinfo($src, PATHINFO_BASENAME);
        $img_r = imagecreatefromjpeg($src);
        $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

        imagecopyresampled($dst_r,$img_r,0,0,Input::get('x'),Input::get('y'),
            $targ_w,$targ_h,Input::get('w'),Input::get('h'));

        imagejpeg($dst_r,$dst,$jpeg_quality);
        return Response::json(array('errno'=>0, 'path'=>$dst));
    }

    public function postProjectResourceUpload(){

        if (Input::hasFile('res_file'))
        {
            $SAVE_DIR = Config::get('app.project_resource_dir');

            if (!file_exists($SAVE_DIR)) {
                @mkdir($SAVE_DIR);
            }

            $file = Input::file('res_file');


            if(!$file->isValid()){
                return Response::json(array('errno'=>1, 'message'=> 'ERROR_FILE_NOT_VALID'));
            }

            $newFileName = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
            $file->move($SAVE_DIR, $newFileName);
            return Response::json(array('errno'=>0, 'path'=>$SAVE_DIR.'/'.$newFileName, 'res_name'=>Input::get('res_name')));

        }

        return Response::json(array('errno'=>2, 'message'=> 'FILE_NOT_UPLOADED'));
    }

    public function postProjectShowUpload(){
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );

        $max_size = 1000000;

        if (Input::hasFile('imgFile'))
        {
            $SAVE_DIR = Config::get('app.project_show_dir');

            if (!file_exists($SAVE_DIR)) {
                @mkdir($SAVE_DIR);
            }

            $file = Input::file('imgFile');


            if(!$file->isValid()){
                return Response::json(array('error'=>1, 'message'=> 'ERROR_FILE_NOT_VALID'));
            }

            if($file->getSize() > $max_size){
                return Response::json(array('error'=>2, 'message'=> 'ERROR_FILE_TOO_LARGE'));
            }

            if(in_array($file->getClientOriginalExtension(), $ext_arr[Input::get('dir')]) === false) {
                return Response::json(array('error'=>3, 'message'=> 'ERROR_FILE_TYPE_NOT_VALID'));
            }

            $newFileName = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
            $file->move($SAVE_DIR, $newFileName);
            return Response::json(array('error'=>0, 'url'=>'/'.$SAVE_DIR.'/'.$newFileName));

        }

        return Response::json(array('error'=>2, 'message'=> 'FILE_NOT_UPLOADED'));
    }



}
