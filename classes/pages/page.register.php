<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.home.php          (parent link)
 * classes/class.page_controller.php    (controller)
 * classes/class.register.functions.php (model)
 * 
 * classes/class.captcha.php            (captcha class)
 * 
 * page that shows a register form
 */

class Register extends FonPage
{
    
    protected $db;
    protected $user;
    protected $helper;
    protected $functions;
    
    public function __construct($user, $db, $helper, $functions)
    {
        $this->user=$user;
        $this->db=$db;
        $this->helper=$helper;
        
        $this->functions=$functions;
    }
   
//================================================
//              register controller
//================================================
/*
 * mini controller to control what html will be
 * echo out to the user.
 */  
//================================================
    
    
    public function bodyContent()
    {
        if ((isset($_POST["registerbutt"])))
        {
            echo '<script type="text/javascript" src="js/window.registration.js"></script>';
            $email = $this->helper->specChars($_POST["regemail"]);

            if(isset($_POST["captcha"]) && $_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"])
            {
                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email))
                {
                    $result = $this->showRegFormFilled();
                }
                if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email))
                {
                    $result = 'Please fill in a valid e-mail adress to continue<br>';
                    $result .= $this->showRegisterForm();
                }
            }
            else
            {
                $result = 'captcha invalid';
                $result .= $this->showRegisterForm();
            }
            return $result;
        }
        else
        {
            //this boolean limits the a
            $_SESSION['registerses'] = true;
            $result = $this->showRegisterForm();
            return $result;
        }
    }

//================================================
//              show register form
//================================================
/*
 * html that shows the form for registerin,
 * as well as making a new captcha object. 
 */  
//================================================  
    
    protected function showRegisterForm() 
    {
   
        $result = '<form name="register" action="" method="POST">
                <input type="hidden" name="page" value="home">
                <input class="form-control" type="text" name="regusername" value="" placeholder="Username" required />
                <br>
                <input class="form-control" type="password" name="regpw" value="" placeholder="Password" required />
                <br>
                <input class="form-control" type="text" name="regemail" value="" placeholder="E-Mail" required />
                <br><br>';
                
                new Captcha;
        
                $result .= '<img src="captcha.png"/><br>';

                $result .= '<input class="form-control" name="captcha" placeholder="Captcha" type="text">';
        
        $result .= '<br><input class="form-control" type="submit" name="registerbutt" value="Register Now" />
            <br></form>'; 
        
        return $result;
    }
    
//================================================
//              show reg form filled
//================================================
/*
 * checks to see if the registration was a 
 * succes and lets it know to the user.
 */  
//================================================
    
    protected function showRegFormFilled() 
    { 
        $success = false;
        
        if ($_SESSION["registerses"] == false)
        {
            return ' Multiple registration attempts detected, please go back and fill out the form';
        }
        
        if ($_SESSION["registerses"] == true)
        {
            $success = $this->functions->saveUserData();
            $_SESSION["registerses"] = false;
        }
        
        if ($success == true)
        {
            return ' thank you so much for registering!';
        }
        else
        {
            return ' but registration failed!';
        }
    }
}