<?php

/* 
 * 
 * 
 * 
 */

class FonVerifyPage extends FonPage
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
        echo '<div class="site-wrapper">
                <div class="background-container container">
                    <div class="row headrow">
                        <div class="col-md-3">colmd3
                        </div>
                        <div class="col-md-6">colmd6
                        </div>
                        <div class="col-md-3">colmd3
                        </div>
                    </div>
                    <div class="row middlerow">
                        <div class="col-md-3 mainmenu">
                        </div>
                        <div class="col-md-6">
                            <div id="centerwindowver"><div id="verifywindow">';

        echo $this->function->verifyHash();
        
    echo           '</div><br><a href="?page=home"><input id="verifycontinuebutton" class="form-control" type="button" value="continue"></a>
                        </div></div>
                        <div class="col-md-3">colmd3
                        </div>
                    </div>
                    <div class="row footrow">
                        <div class="col-md-3">colmd3
                        </div>
                        <div class="col-md-6">colmd6
                        </div>
                        <div class="col-md-3">colmd3
                        </div>
                    </div>
                </div>
              </div>';
    }
    
}