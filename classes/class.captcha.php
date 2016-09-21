<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.register.php (page class)
 * 
 * class that inserts a captcha whenever called.
 */


class Captcha
{
    protected $image;
    
    public function __construct()
    {
        //session_start();
        $code=rand(10000,99999);
        $_SESSION["code"]=$code;
        $im = imagecreatetruecolor(60, 24);
        $bg = imagecolorallocate($im, 22, 86, 165); //background color blue
        $fg = imagecolorallocate($im, 255, 255, 255);//text color white
        imagefill($im, 0, 0, $bg);
        imagestring($im, 5, 5, 5,  $code, $fg);
        //header("Cache-Control: no-cache, must-revalidate");
        //header('Content-type: image/png');
        $targetfile = "captcha.png";
        $this->image = imagepng($im,$targetfile);
        //imagedestroy($im);
    }
}