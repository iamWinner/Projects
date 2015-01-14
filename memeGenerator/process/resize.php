

<?php
// Adam Khoury PHP Image Function Library 1.0
// Function for resizing any jpg, gif, or png image files
function ak_img_resize($target, $newcopy, $w, $h, $ext) {
  list($w_orig, $h_orig) = getimagesize($target);
   // $scale_ratio = $w_orig / $h_orig;
    //if (($w / $h) > $scale_ratio) {
    //       $w = $h * $scale_ratio;
    //} else {
    //       $h = $w / $scale_ratio;
    //}
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    // http://blog.invoiceberry.com/2012/05/convert-png-and-gif-pictures-to-jpeg-pictures-with-php/
    $bg = imagecolorallocate($tci, 0, 0, 0);
    imagefill($tci, 0, 0, $bg);
   
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
     $img=$tci;
    imagejpeg($img, $newcopy, 80);
}
?>