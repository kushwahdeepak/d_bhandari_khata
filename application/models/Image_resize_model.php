<?php

ini_set('memory_limit', '-1');

Class Image_resize_model extends CI_Model
{   
    function __construct()
    {
        parent::__construct();
    }










    function resizeCustomImageWithoutResize($path="")
    {
        if (isset($_FILES['image']['name']) and ($_FILES['image']['name']!='')) 
        {
            $target_dir = $path;
            $thumb_dir = "images/walk_service_image_thumb/";
            $medium_thumb_dir = "images/walk_service_image_medium/";

            $date = new DateTime();
            $name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $path_parts = pathinfo($_FILES['image']['name']);
            $name = str_replace(" ", "", $name);
            $file_ext = $path_parts["extension"];
            $fileName = $name . "_" . "0" . "." . $path_parts["extension"];

            $target_dir = $target_dir.$fileName;

            if(move_uploaded_file($_FILES['image']["tmp_name"], $target_dir))
            { 
                 //file permission
                chmod ($target_dir, 0777);

                $image_type = pathinfo($target_dir, PATHINFO_EXTENSION);

                if (strtolower($image_type) == "jpg" || strtolower($image_type) == "jpeg")
                {

                    $orientation = 1;
                    if (function_exists('exif_read_data')) 
                    {
                       $exif = exif_read_data($target_dir, 'IFD0');
                       if (isset($exif['Orientation']))
                           $orientation = $exif['Orientation'];
                    } 
                    else if (preg_match('@\x12\x01\x03\x00\x01\x00\x00\x00(.)\x00\x00\x00@', file_get_contents($target_dir), $matches)) 
                    {
                       $orientation = ord($matches[1]);
                    }

                    $source = imagecreatefromjpeg($target_dir);

                    switch($orientation) 
                    {
                        case 8:
                            $rotate = imagerotate($source,90,0);
                            break;
                        case 3:
                            $rotate = imagerotate($source,180,0);
                            break;
                        case 6:
                            $rotate = imagerotate($source,-90,0);
                            break;
                        default:
                            $rotate = imagerotate($source,0,0);
                    }
                    imagejpeg($rotate, $target_dir);

                }


                if (strtolower($image_type) == "mp4" || strtolower($image_type) == "mov" || strtolower($image_type) == "3gp") {

                } else {

                    copy("$target_dir","$thumb_dir/$fileName");

                    $thumbnail = $thumb_dir.$fileName;

                    $large_width = $this->getWidth($target_dir);
                    $large_height = $this->getHeight($target_dir);

                    $max_width = 160; 
                    if ($large_width > $max_width)
                    {
                        $scale = $max_width/$large_width;
                        $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                    }
                    else
                    {
                        $scale = 1;
                        $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                    }


                    copy("$target_dir","$medium_thumb_dir/$fileName");

                    $thumbnail_medium = $medium_thumb_dir.$fileName;

                    $large_width = $this->getWidth($target_dir);
                    $large_height = $this->getHeight($target_dir);

                    $max_width = 1024; 
                    if ($large_width > $max_width)
                    {
                        $scale = $max_width/$large_width;
                        $this->resizeImage($thumbnail_medium,$large_width,$large_height,$scale);
                    }
                    else
                    {
                        $scale = 1;
                        $this->resizeImage($thumbnail_medium,$large_width,$large_height,$scale);
                    }

                }

                return $fileName;
            }
            return "";
        }
    }












    function resizeCustomImage($path="", $size="")
    {
        if (isset($_FILES['image']['name']) and ($_FILES['image']['name']!='')) 
        {

            $target_dir = $path;

            $date = new DateTime();
            $name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $path_parts = pathinfo($_FILES['image']['name']);
            $fileName = time().date('Y-m-d'). "_" . $size . "." . $path_parts["extension"];
            
            $target_dir = $target_dir.$fileName;

            if(move_uploaded_file($_FILES['image']["tmp_name"], $target_dir))
            { 
                 //file permission
                chmod ($target_dir, 0777);

                // for big img
                $large_width = $this->getWidth($target_dir);
                $large_height = $this->getHeight($target_dir);

                $max_width = $size; 
                if ($large_width > $max_width)
                {
                    $scale = $max_width/$large_width;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                else
                {
                    $scale = 1;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                return $fileName;
            }
            return "";
        }
    }






    function resizeCustomMultipleImages1($path="", $size="", $i=0)
    {
        if (isset($_FILES['gold_item_photo']['name'][$i]) and ($_FILES['gold_item_photo']['name'][$i]!='')) 
        {

            $target_dir = $path;

            $date = new DateTime();
            $name = pathinfo($_FILES['gold_item_photo']['name'][$i], PATHINFO_FILENAME);
            $path_parts = pathinfo($_FILES['gold_item_photo']['name'][$i]);
            $fileName = $name . "_" . "0" .time().date('Ymd'). "." . $path_parts["extension"];

            $target_dir = $target_dir.$fileName;

            if(move_uploaded_file($_FILES['gold_item_photo']["tmp_name"][$i], $target_dir))
            { 
                 //file permission
                chmod ($target_dir, 0777);

                // for big img
                $large_width = $this->getWidth($target_dir);
                $large_height = $this->getHeight($target_dir);

                $max_width = $size; 
                if ($large_width > $max_width)
                {
                    $scale = $max_width/$large_width;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                else
                {
                    $scale = 1;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                return $fileName;
            }
            return "";
        }
    }



    function resizeCustomMultipleImages2($path="", $size="", $i=0)
    {
        if (isset($_FILES['silver_item_photo']['name'][$i]) and ($_FILES['silver_item_photo']['name'][$i]!='')) 
        {

            $target_dir = $path;

            $date = new DateTime();
            $name = pathinfo($_FILES['silver_item_photo']['name'][$i], PATHINFO_FILENAME);
            $path_parts = pathinfo($_FILES['silver_item_photo']['name'][$i]);
            $fileName = $name . "_" . "01" .$i . "." . $path_parts["extension"];

            $target_dir = $target_dir.$fileName;

            if(move_uploaded_file($_FILES['silver_item_photo']["tmp_name"][$i], $target_dir))
            { 
                 //file permission
                chmod ($target_dir, 0777);

                // for big img
                $large_width = $this->getWidth($target_dir);
                $large_height = $this->getHeight($target_dir);

                $max_width = $size; 
                if ($large_width > $max_width)
                {
                    $scale = $max_width/$large_width;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                else
                {
                    $scale = 1;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                return $fileName;
            }
            return "";
        }
    }


    function resizeCustomMultipleImages($path="", $size="", $i=0)
    {
        if (isset($_FILES['image']['name'][$i]) and ($_FILES['image']['name'][$i]!='')) 
        {

            $target_dir = $path;

            $date = new DateTime();
            $name = pathinfo($_FILES['image']['name'][$i], PATHINFO_FILENAME);
            $path_parts = pathinfo($_FILES['image']['name'][$i]);
            $fileName = $name . "_" . "0" . "." . $path_parts["extension"];

            $target_dir = $target_dir.$fileName;

            if(move_uploaded_file($_FILES['image']["tmp_name"][$i], $target_dir))
            { 
                 //file permission
                chmod ($target_dir, 0777);

                // for big img
                $large_width = $this->getWidth($target_dir);
                $large_height = $this->getHeight($target_dir);

                $max_width = $size; 
                if ($large_width > $max_width)
                {
                    $scale = $max_width/$large_width;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                else
                {
                    $scale = 1;
                    $this->resizeImage($target_dir,$large_width,$large_height,$scale);
                }
                return $fileName;
            }
            return "";
        }
    }


















    function resizeCustomMultipleImagesWithoutResize($path="", $size="", $i=0)
    {
        if (isset($_FILES['image']['name'][$i]) and ($_FILES['image']['name'][$i]!='')) 
        {

            $target_dir = $path;
            $thumb_dir = "images/walk_service_image_thumb/";
            $medium_thumb_dir = "images/walk_service_image_medium/";

            $date = new DateTime();
            $name = pathinfo($_FILES['image']['name'][$i], PATHINFO_FILENAME);
            $path_parts = pathinfo($_FILES['image']['name'][$i]);
            $name = str_replace(" ", "", $name);
            $file_ext = $path_parts["extension"];
            $fileName = $name . "_" . "0" . "." . $path_parts["extension"];

            $target_dir = $target_dir.$fileName;

            if(move_uploaded_file($_FILES['image']["tmp_name"][$i], $target_dir))
            { 
                 //file permission
                chmod ($target_dir, 0777);

                $image_type = pathinfo($target_dir, PATHINFO_EXTENSION);

                if (strtolower($image_type) == "jpg" || strtolower($image_type) == "jpeg")
                {
                    $orientation = 1;
                    if (function_exists('exif_read_data')) 
                    {
                       $exif = exif_read_data($target_dir, 'IFD0');
                       if (isset($exif['Orientation']))
                           $orientation = $exif['Orientation'];
                    } 
                    else if (preg_match('@\x12\x01\x03\x00\x01\x00\x00\x00(.)\x00\x00\x00@', file_get_contents($target_dir), $matches)) 
                    {
                       $orientation = ord($matches[1]);
                    }

                    $source = imagecreatefromjpeg($target_dir);

                    switch($orientation) 
                    {
                        case 8:
                            $rotate = imagerotate($source,90,0);
                            break;
                        case 3:
                            $rotate = imagerotate($source,180,0);
                            break;
                        case 6:
                            $rotate = imagerotate($source,-90,0);
                            break;
                        default:
                            $rotate = imagerotate($source,0,0);
                    }
                    imagejpeg($rotate, $target_dir);
                }


                if (strtolower($image_type) == "mp4" || strtolower($image_type) == "mov" || strtolower($image_type) == "3gp") 
                {

                } 
                else 
                {

                    copy("$target_dir","$thumb_dir/$fileName");

                    $thumbnail = $thumb_dir.$fileName;

                    $large_width = $this->getWidth($target_dir);
                    $large_height = $this->getHeight($target_dir);

                    $max_width = 160; 
                    if ($large_width > $max_width)
                    {
                        $scale = $max_width/$large_width;
                        $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                    }
                    else
                    {
                        $scale = 1;
                        $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                    }


                    copy("$target_dir","$medium_thumb_dir/$fileName");

                    $thumbnail_medium = $medium_thumb_dir.$fileName;

                    $large_width = $this->getWidth($target_dir);
                    $large_height = $this->getHeight($target_dir);

                    $max_width = 800; 
                    if ($large_width > $max_width)
                    {
                        $scale = $max_width/$large_width;
                        $this->resizeImage($thumbnail_medium,$large_width,$large_height,$scale);
                    }
                    else
                    {
                        $scale = 1;
                        $this->resizeImage($thumbnail_medium,$large_width,$large_height,$scale);
                    }

                }
                
                return $fileName;
            }
            return "";
        }
    }


















    function resizeCustomMultipleImagesFromApp($path="", $size="", $i=0)
    {
        if (isset($_FILES['image']['name'][$i]) and ($_FILES['image']['name'][$i]!='')) 
        {

            $target_dir = $path;
            $thumb_dir = "images/walk_service_image_thumb/";
            $medium_thumb_dir = "images/walk_service_image_medium/";

            $date = new DateTime();
            $name = pathinfo($_FILES['image']['name'][$i], PATHINFO_FILENAME);
            $path_parts = pathinfo($_FILES['image']['name'][$i]);
            $name = str_replace(" ", "", $name);
            $file_ext = $path_parts["extension"];
            $fileName = $name . "_" . uniqid() . "." . $path_parts["extension"];

            $target_dir = $target_dir.$fileName;

            if(move_uploaded_file($_FILES['image']["tmp_name"][$i], $target_dir))
            { 
                 //file permission
                chmod ($target_dir, 0777);

                $image_type = pathinfo($target_dir, PATHINFO_EXTENSION);

                if (strtolower($image_type) == "jpg" || strtolower($image_type) == "jpeg")
                {
                    $orientation = 1;
                    if (function_exists('exif_read_data')) 
                    {
                       $exif = exif_read_data($target_dir, 'IFD0');
                       if (isset($exif['Orientation']))
                           $orientation = $exif['Orientation'];
                    } 
                    else if (preg_match('@\x12\x01\x03\x00\x01\x00\x00\x00(.)\x00\x00\x00@', file_get_contents($target_dir), $matches)) 
                    {
                       $orientation = ord($matches[1]);
                    }

                    $source = imagecreatefromjpeg($target_dir);

                    switch($orientation) 
                    {
                        case 8:
                            $rotate = imagerotate($source,90,0);
                            break;
                        case 3:
                            $rotate = imagerotate($source,180,0);
                            break;
                        case 6:
                            $rotate = imagerotate($source,-90,0);
                            break;
                        default:
                            $rotate = imagerotate($source,0,0);
                    }
                    imagejpeg($rotate, $target_dir);
                }


                if (strtolower($image_type) == "mp4" || strtolower($image_type) == "mov" || strtolower($image_type) == "3gp") 
                {

                } 
                else 
                {

                    copy("$target_dir","$thumb_dir/$fileName");

                    $thumbnail = $thumb_dir.$fileName;

                    $large_width = $this->getWidth($target_dir);
                    $large_height = $this->getHeight($target_dir);

                    $max_width = 160; 
                    if ($large_width > $max_width)
                    {
                        $scale = $max_width/$large_width;
                        $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                    }
                    else
                    {
                        $scale = 1;
                        $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                    }


                    copy("$target_dir","$medium_thumb_dir/$fileName");

                    $thumbnail_medium = $medium_thumb_dir.$fileName;

                    $large_width = $this->getWidth($target_dir);
                    $large_height = $this->getHeight($target_dir);

                    $max_width = 800; 
                    if ($large_width > $max_width)
                    {
                        $scale = $max_width/$large_width;
                        $this->resizeImage($thumbnail_medium,$large_width,$large_height,$scale);
                    }
                    else
                    {
                        $scale = 1;
                        $this->resizeImage($thumbnail_medium,$large_width,$large_height,$scale);
                    }

                }
                
                return $fileName;
            }
            return "";
        }
    }






















    function resizeImage($image,$width,$height,$scale) 
    {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image); 
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image); 
                break;
        }
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        
        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$image); 
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$image);  
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$image,90); 
                break;
        }
        
        chmod($image, 0777);
        return $image;
    }

    // Resize product img
    function resizeProductImage($image,$width,$height,$scale) 
    {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = $height;
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image); 
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image); 
                break;
        }
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        
        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$image); 
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$image);  
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$image,90); 
                break;
        }
        
        chmod($image, 0777);
        return $image;
    }


    //You do not need to alter these functions
    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale, $option="auto")
    {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image); 
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image); 
                break;
        }
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$thumb_image_name); 
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$thumb_image_name);  
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$thumb_image_name,90); 
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    //You do not need to alter these functions
    function getHeight($image) 
    {
        $size = getimagesize($image);
        $height = $size[1];
        return $height;
    }

    //You do not need to alter these functions
    function getWidth($image) 
    {
        $size = getimagesize($image);
        $width = $size[0];
        return $width;
    }

















    function copy123($name="", $id="")
    {
        $image_type = "";

        $target_dir = "images/walk_service_image/";
        $thumb_dir = "images/walk_service_image_thumb/";
        $medium_thumb_dir = "images/walk_service_image_medium/";

        $target_dir = $target_dir.$name;

        if(file_exists($target_dir))
        {
            $image_type = pathinfo($target_dir, PATHINFO_EXTENSION);

            if (strtolower($image_type) == "mp4" || strtolower($image_type) == "mov" || strtolower($image_type) == "3gp") {

            } else {


                copy("$target_dir","$thumb_dir/$name");

                $thumbnail = $thumb_dir.$name;

                $large_width = $this->getWidth($target_dir);
                $large_height = $this->getHeight($target_dir);

                $max_width = 160; 
                if ($large_width > $max_width)
                {
                    $scale = $max_width/$large_width;
                    $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                }
                else
                {
                    $scale = 1;
                    $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                }




                copy("$target_dir","$medium_thumb_dir/$name");

                $thumbnail = $medium_thumb_dir.$name;

                $large_width = $this->getWidth($target_dir);
                $large_height = $this->getHeight($target_dir);

                $max_width = 800; 
                if ($large_width > $max_width)
                {
                    $scale = $max_width/$large_width;
                    $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                }
                else
                {
                    $scale = 1;
                    $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
                }


            }
        }
        else
        {
            print_r($name);
            print_r("<br>");
            print_r("<br>");
        }

    }


















    function updateAllVideoFileByFFMPEG($name="", $id="")
    {
        $image_type = "";

        $target_dir_base = "images/walk_service_image/";
        $target_dir_small_video = "images/walk_service_thumb_video/";
        $thumb_dir = "images/walk_service_image_thumb/";

        $target_dir = $target_dir_base.$name;

        $path_parts = pathinfo($name);
        $name = $path_parts['filename'];
        $extension = $path_parts['extension'];


        $convert_video_fileName = "convert_".$name . "_" . "0" . ".mp4";
        $convert_image_fileName = "convert_".$name . "_" . "0" . ".png";

        $convert_video_target_dir = $target_dir_base.$convert_video_fileName;
        $convert_video_target_dir_small_video = $target_dir_small_video.$convert_video_fileName;
        $convert_image_target_dir = $thumb_dir.$convert_image_fileName;
        

        exec("/usr/local/bin/ffmpeg -i ".$target_dir." -c:v libx264 -pix_fmt yuv420p -movflags faststart ".$convert_video_target_dir." 2>&1");
        exec("/usr/local/bin/ffmpeg -i ".$target_dir." -vf scale=800:-1 -c:v libx264 -preset veryslow -crf 24 ".$convert_video_target_dir_small_video." 2>&1");
        exec('/usr/local/bin/ffmpeg -ss 0.5 -i '.$target_dir.' -vframes 1 -filter:v scale="160:-1" '.$convert_image_target_dir.' 2>&1');


        $image_data = array(
            'image_url' => $convert_video_fileName, 
            'update_status' => "old", 
        ); 
        $this->db->where('walk_image_id',$id);
        $this->db->update('walk_image',$image_data);


        unlink($target_dir);
        return true;

    }

















    function customer_resize_images($name="")
    {
        $image_type = "";

        $target_dir = "images/users/";
        $thumb_dir = "images/users_thumb";
        $medium_thumb_dir = "images/users_medium";

        $target_dir = $target_dir.$name;

        if(file_exists($target_dir))
        {

            copy("$target_dir","$medium_thumb_dir/$name");

            $medium_thumbnail = "images/users_medium/".$name;

            $large_width = $this->getWidth($target_dir);
            $large_height = $this->getHeight($target_dir);

            $max_width = 100; 
            if ($large_width > $max_width)
            {
                $scale = $max_width/$large_width;
                $this->resizeImage($medium_thumbnail,$large_width,$large_height,$scale);
            }
            else
            {
                $scale = 1;
                $this->resizeImage($medium_thumbnail,$large_width,$large_height,$scale);
            }


            copy("$target_dir","$thumb_dir/$name");

            $thumbnail = "images/users_thumb/".$name;

            $large_width = $this->getWidth($target_dir);
            $large_height = $this->getHeight($target_dir);

            $max_width = 40; 
            if ($large_width > $max_width)
            {
                $scale = $max_width/$large_width;
                $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
            }
            else
            {
                $scale = 1;
                $this->resizeImage($thumbnail,$large_width,$large_height,$scale);
            }

        }

    }











}