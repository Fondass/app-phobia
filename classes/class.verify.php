<?php

/* 
 * 
 * 
 * 
 */

class FonVerify
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
    
    public function verifyHash()
    {
        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
        {
            $email = $this->helper->specChars($_GET['email']);
            $hash = $this->helper->specChars($_GET['hash']);
            
            $account = $this->db->verifyAcount($email, $hash);
            
            if (isset($account[0]) != "")
            {
                $id = $account[0];
                
                if ($this->db->updateAccountActive($id))
                {
                    return 'Account verification succeeded, welcome!';
                }
            }
            else
            {
                return 'Account verification failed, please try again.';
            }
        }
    }
}