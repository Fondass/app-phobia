<?php

/* 
 * 
 * 
 * 
 */

class FonAccountPage extends FonPage
{
    protected $user;
    protected $db;
    protected $helper;
    
    public function __construct($user, $db, $helper, $function)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        $this->function = $function;
    }
    
    protected function endHeader()
    {
        echo '<link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
            <link href="css/cover.css" rel="stylesheet"></head>';
    }
    
    protected function bodyContent()
    {
        $userdata = $this->function->getPlayerData();
        $savesuccess = array();
        $data = array();
        
        if (isset ($_POST["updateaccount"]))
        {
            $savesuccess = $this->function->saveForm($userdata);
        }
        
        $data[2] = "";
        $data[0] = $userdata[0];
        $data[1] = $userdata[1];
        
        if (isset ($savesuccess[2]) && $savesuccess[2] != "")
        {
            if (isset ($savesuccess[0]))
            {
                $data[0] = $savesuccess[0];
            }
            if (isset ($savesuccess[1]))
            {
                $data[1] = $savesuccess[1];
            }
            $data[2] = $savesuccess[2];
        }
        
        // TODO: userdata loads before userdata get's updated through saveform, resultts in page reloud without updated acount info, needs revission (without simply doing 2 querie's)
        
        echo '<div class="site-wrapper">
                <div class="background-container container">
                    <div class="row headrow">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="accentertop">
                                <form id="accountform" name="accountform" method="POST">
                                    Username:<input class="form-control" type="text" name="playername" value="'.$data[0].'"><br>
                                    E-Mail:<input class="form-control" type="text" name="playeremail" value="'.$data[1].'">
                                        <input type="hidden" name="page" value="account">
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3">colmd3
                        </div>
                    </div>
                    <div class="row middlerow">
                        <div class="col-md-3 mainmenu">
                            <ul class="list-unstyled list-mainmenu">
                                <li><input id="updateaccount" name="updateaccount" form="accountform" type="submit" value="Save"></li>
                                <li><a href="?page=home"> Cancel </a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="accenter">
                                Old password:<input form="accountform" type="password" class="form-control accountform" name="playerpasswordold"><br>
                                New password:<input form="accountform" type="password" class="form-control accountform" name="playerpasswordnew1"><br>
                                Repeat new password:<input form="accountform" type="password" class="form-control accountform" name="playerpasswordnew2">
                                
                            </div> 
                        </div>
                        <div class="col-md-3">colmd3
                        </div>
                    </div>
                    <div class="row footrow">
                        <div class="col-md-3">colmd3
                        </div>
                        <div class="col-md-6">
                            <div class="accenterbot">
                                '.$data[2].'
                            </div>
                        </div>
                        <div class="col-md-3">colmd3
                        </div>
                    </div>
                </div>
              </div>';
    }
    
}