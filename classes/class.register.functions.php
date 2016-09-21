<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.register.php (page class)
 * 
 * functions for register page.
 */

class FonRegister
{     
    protected $user;
    protected $db;
    protected $helper;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
//================================================
//                  make salt
//================================================
/*
 * create's a random assortment of characters
 * to add to the users password.
 */  
//================================================
    
    protected function makeSalt()
    {
        $salt = mcrypt_create_iv(32);

        if ($salt == true)
        {
            return $salt;
        }
        else
        {
            return null;
        }
    }
    
    
    protected function makeHash()
    {
        $hash = md5( rand(0,1000) );
        
        return $hash;
    }
    
    
    
    
//================================================
//              save user data
//================================================
/*
 * aplies salt to the password en sends the
 * data (username, password, and salt) to the
 * database class for further storage.
 */  
//================================================
    
    public function saveUserData()
    {
        $salt = $this->makeSalt();
        $hash = $this->makeHash();         
        
        if (is_string($salt))
        {
            $usern = $this->helper->specChars($_POST["regusername"]);
            $email = $this->helper->specChars($_POST["regemail"]);
            $pasw = $this->helper->specChars($_POST["regpw"]);
            $pasw .= $salt;
            $pasw = hash("sha256",$pasw);
            $result = $this->db->saveNewUser($usern, $pasw, $salt, $email, $hash);
            $this->sendMail($usern, $hash, $email);
            return $result;
        }
        else
        {
            return false;
        }
    }
    
    protected function sendMail($usern, $hash, $email)
    {
        $to = $email;
        $subject = 'Acount verification App-Phobia';
        $message = 'Dear '.$usern.'
            
                    Thank you for signing up for App-Phobia,
                    
                    Before you can start on your adventure you will need to verify your acount.
                    
                    Please click on the following link to activate you account:
                    localhost/appphobia/?page=verify&email='.$email.'&hash='.$hash.'';
        
        $headers = 'From:noreply@appphobia.com' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
    
    
    
}