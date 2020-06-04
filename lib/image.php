<?
function CreateThumb($source_name,$dest_name,$Thumb_width,$Thumb_height)
 {
  if (file_exists(pathinfo($dest_name,PATHINFO_DIRNAME)))
   {
    $ratio = 1;

    if ((list($width_orig, $height_orig, $type) = getimagesize($source_name)))
     {
      if ($type == 1 || $type == 2 || $type == 3)
       {
        if ($width_orig > $height_orig) $ratio = $Thumb_height/$height_orig;
        else                            $ratio = $Thumb_width/$width_orig;

        $width  = floor($width_orig*$ratio);
        $height = floor($height_orig*$ratio);

        $image_p = imagecreatetruecolor($Thumb_width, $Thumb_height);

        if      ($type == 1) $imageR = imagecreatefromgif($source_name);
        else if ($type == 2) $imageR = imagecreatefromjpeg($source_name);
        else if ($type == 3) $imageR = imagecreatefrompng($source_name);


        imagecopyresampled($image_p, $imageR, 0, 0, ($width_orig*0.1), 0, $width, $height, $width_orig, $height_orig);
        //imagecopyresized($image_p, $imageR, 0, 0, ($width_orig*0.2), 0, $width, $height, $width_orig, $height_orig);

        return imagejpeg($image_p,$dest_name,70);
       }
     }
   }

  return false;
 }

function CreateThumb2($source_name,$dest_name,$Thumb_width,$Thumb_height)
 {
  if (file_exists(pathinfo($dest_name,PATHINFO_BASENAME)))
   {
    $filename = $source_name;
    $width    = $Thumb_width;
    $height   = $Thumb_height;
    list($width_orig, $height_orig) = getimagesize($filename);

    if ($width && ($width_orig < $height_orig)) $width = ($height / $height_orig) * $width_orig;
    else $height = ($width / $width_orig) * $height_orig;

    $image_p = imagecreatetruecolor($width, $height);
    $imageR  = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $imageR, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    imagejpeg($image_p,$dest_name,70);
    return array($width,$height);
   }

  return false;
 }


?>