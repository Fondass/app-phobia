<?php

/* 
 * 
 * 
 * 
 */

class FonAccount
{     
    protected $user;
    protected $db;
    protected $helper;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        $this->id = $_SESSION["userid"];
    }
    
    public function getPlayerData()
    {
        $data = $this->db->getUserInformation($this->id);
        
        return $data;
    }
    
    public function saveForm($userdata)
    {
        $returndata = array();
        $querydata = "";
        
        if (isset ($_POST["playername"]))
        {
            $playername = $this->helper->specChars($_POST["playername"]);
        }
        
        if (isset ($_POST["playeremail"]))
        {
            $playeremail = $this->helper->specChars($_POST["playeremail"]);
        }
        
        if (isset ($_POST["playerpasswordnew1"]))
        {
            if (isset ($_POST["playerpasswordnew2"]))
            {
                $passwordnew1 = $this->helper->specChars($_POST["playerpasswordnew1"]);
                $passwordnew2 = $this->helper->specChars($_POST["playerpasswordnew2"]);
                
                if ($passwordnew1 !== $passwordnew2)
                {
                    return "New passwords do not match.";
                }
            }
            else
            {
                return "Please also fill in the repeat new password.";
            }
        }
           
        if (isset ($_POST["playerpasswordold"]))
        {
            $password = $this->helper->specChars($_POST["playerpasswordold"]);
            $password .= $userdata[3];

            $password = hash("sha256", $password);
        }
        else
        {
           return 'Please fill in your current password in the old password field to make changes.';
        }
        
        if ($this->helper->specChars($password) === $userdata[2])
        {
            if (isset ($playername) && $playername !== $userdata[0])
            {
                $querydata = 'name="'.$playername.'",';
                $returndata[0] = $playername;
            }
                
            if (isset ($playeremail) && $playeremail !== $userdata[1])
            {
                $querydata .= 'e_mail="'.$playeremail.'",';
                $returndata[1] = $playermail;
            }
                
            if (isset ($passwordnew2) && $passwordnew2 != "")
            {
                $passwordnew2 .= $userdata[3];
                
                $passwordnew2 = hash("sha256", $passwordnew2);
                
                $querydata .= 'password="'.$passwordnew2.'",';
            }
            
            if (isset ($querydata))
            {
                $success = $this->db->updateAccountInfo($querydata, $this->id);
                
                if ($success)
                {
                    $returndata[2] = 'Account succesfully updated';
                    return $returndata;
                }
                
                return 'Something went wrong during the update process.';
            }
            else
            {
                return 'Something went wrong during the update process - userdata missing.';
            }
        }
        else
        {
            return 'Password incorrect.';
        }
        

    }
}