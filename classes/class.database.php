<?php

class FonDatabase
{
    public function __construct()
    {
        if (PDODAO::connect() == true)
        {

        }
        else
        {
            die("NO DATABASE CONNECTION");
        }
    }

//================================================
//           get password permission on userid
//================================================
/*
 * Looks up the password that is coupled with an
 * entered useridprovided by a user. username
 * need to be a valid entry in the databse for 
 * this function to return something. 
*/    
//================================================
  
    public function getPasswordPermissionOnUserid($userid)
    {
        $sql = 'SELECT password, permission FROM users WHERE id="'.$userid.'"';
        $statement = PDODAO::prepareStatement($sql);
        $result = PDODAO::getArray($statement);

        return $result; // returns the valid password 
    }
    
//================================================
//                  get salt
//================================================
/*
 * looks up the added password salt in the database
 * (which is a column in the users table).
 * 
 * salt refers to a password hashtag defined in script.
 */   
//================================================  
    public function getSalt($id)
    {
       $sql = 'SELECT salt FROM users WHERE id = "'.$id.'"';
       $result = PDODAO::getDataArray($sql);
       //echo $result['salt'];
       return $result['salt'];
    }
    
//================================================
//                 save new user
//================================================
/*
 * saves the entries of a new user into the database.
 * 
 * salt refers to a password hashtag defined in script.
 */   
//================================================        
                     
    public function saveNewUser($newuser, $newpass, $salt, $email, $hash)
    {
        $sql = 'INSERT INTO users(permission, name, password, e_mail, salt, hash) 
                VALUES ("1","'.$newuser.'","'.$newpass.'","'.$email.'","'.$salt.'","'.$hash.'")';
        return PDODAO::doInsertQuery($sql);
    }
    

//================================================
//                 get active User ID
//================================================
/*
 * Get's the ID of the active user
 */   
//================================================  
    
    public function getActiveUserID($username)
    {
        $sql = 'SELECT id FROM users
            WHERE name="'.$username.'"';
        $result = PDODAO::getDataArray($sql);
        return $result[0];                
    }
    
    public function verifyAcount($email, $hash)
    {
        $sql = 'SELECT id, e_mail, hash, active
                FROM users
                WHERE e_mail="'.$email.'" AND hash="'.$hash.'"
                AND active="0"';
        
        $result = PDODAO::getDataArray($sql);
        return $result;
    }
    
    public function updateAccountActive($id)
    {
        $sql = 'UPDATE users
                SET active="1"
                WHERE id="'.$id.'"';
        
        $result = PDODAO::doUpdateQuery($sql);
        return $result;
    }
    
    // TODO: FIX DEZE SHIT! (hiermee bedoel ik, voegt niet values in forms toe :) )
    
    public function getUserInformation($id)
    {
        $sql = 'SELECT name, e_mail, password, salt
                FROM users
                WHERE id="'.$id.'"';
        
        $result = PDODAO::getDataArray($sql);
        return $result;
    }

    public function updateAccountInfo($query, $id)
    {
        $query = substr($query, 0, -1);
        
        $sql = 'UPDATE users
                SET '.$query.'
                WHERE id="'.$id.'"';
        
        debug::write($sql);
        
        $result = PDODAO::doUpdateQuery($sql);
        return $result;
    }
}