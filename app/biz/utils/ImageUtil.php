<?php
/**
 * Created by PhpStorm.
 * User: Cc
 * Date: 2015-5-4
 * Time: 19:30
 */

class ImageUtil {
    public static function createImage($image_path){
        $size=getimagesize($image_path);
        $image = null;
        switch($size["mime"]){
            case "image/jpeg":
                $image = imagecreatefromjpeg($image_path); //jpeg file
                break;
            case "image/gif":
                $image = imagecreatefromgif($image_path); //gif file
                break;
            case "image/png":
                $image = imagecreatefrompng($image_path); //png file
                break;
            default:
                break;
        }
        return $image;
    }

    /**
     * @param $im
     * @param $maxwidth
     * @param $maxheight
     * @param $name
     * @param $filetype
     */
    public static function resizeImage($im,$maxwidth,$maxheight,$name,$filetype,$quality)
    {
        $pic_width = imagesx($im);
        $pic_height = imagesy($im);
        $resizewidth_tag = false;
        $resizeheight_tag = false;

        if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
        {
            if($maxwidth && $pic_width>$maxwidth)
            {
                $widthratio = $maxwidth/$pic_width;
                $resizewidth_tag = true;
            }

            if($maxheight && $pic_height>$maxheight)
            {
                $heightratio = $maxheight/$pic_height;
                $resizeheight_tag = true;
            }

            if($resizewidth_tag && $resizeheight_tag)
            {
                if($widthratio<$heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }

            if($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;

            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;

            if(function_exists("imagecopyresampled"))
            {
                $newim = imagecreatetruecolor($newwidth,$newheight);
                imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
            }
            else
            {
                $newim = imagecreate($newwidth,$newheight);
                imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
            }

            $name = $name.$filetype;
            imagejpeg($newim,$name,$quality);
            imagedestroy($newim);
        }
        else
        {
            $name = $name.$filetype;
            imagejpeg($im,$name,$quality);
        }
    }

    public static function cropImage($src_path, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h, $dst_path){
        $size=getimagesize($src_path);
        $img_r = null;
        switch($size["mime"]){
            case "image/jpeg":
                $img_r = imagecreatefromjpeg($src_path); //jpeg file
                break;
            case "image/gif":
                $img_r = imagecreatefromgif($src_path); //gif file
                break;
            case "image/png":
                $img_r = imagecreatefrompng($src_path); //png file
                break;
            default:
                break;
        }

        if($img_r == null){
            return false;
        }


        $dst_r = ImageCreateTrueColor($dst_w, $dst_h);

        imagecopyresampled($dst_r,$img_r,0,0,$src_x,$src_y,
            $dst_w,$dst_h,$src_w,$src_h);

        imagejpeg($dst_r,$dst_path,100);

        return true;
    }
}