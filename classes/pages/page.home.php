<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/class.page_controller.php (controller)
 * 
 * classes/pages/page.users.php (link)
 * classes/pages/page.admin.php (link)
 * classes/pages/page.login.php (link)
 * classes/pages/page.register.php (link)
 * 
 * Gateway page for site
 */

class FonHomePage extends FonPage
{
    protected $user;
    protected $db;
    protected $helper;
    
    public function __construct($user, $db, $helper, $login)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        $this->login = $login;
    }
    
    
    protected function endHeader()
    {
        echo '<link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
            <link href="css/cover.css" rel="stylesheet"></head>';
    }
    
    public function bodyContent() 
    {
        $registerfunctions = new FonRegister($this->user, $this->db, $this->helper);
        $registerpage = new Register($this->user, $this->db, $this->helper, $registerfunctions);
        $registerresult = $registerpage->bodyContent();

        $loginresult = $this->login->showLoginResult();
        
        
        
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
                            <ul class="list-unstyled list-mainmenu">';
        if (!$this->user->checkLogged())
        {
            echo                '<li><a id="loginbutton"> Log-In </a></li>
                                <li><a id="registerbutton"> Register </a></li>';
        }
        if ($this->user->checkLogged())
        {
            echo                '<li><a href="?page=logout"> Logout </a></li>
                                <li><a href="?page=account"> Account </a></li>';
        }
            echo                '<li><a href="#"> Phobia-Pedia </a></li>
                                <li><a href="#"> Start Story </a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div id="centerwindow"><div id="closewindow"></div>';
        if (!$this->user->checkLogged())
        {
            echo '<div id="loginwindow">'.$loginresult.'</div>';
            echo '<div id="registerwindow">'.$registerresult.'</div>';
        }

            echo           '</div></div>
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
    
    protected function Jsfooter() 
    {
        echo '<script type="text/javascript" src="js/window.home.js"></script>';
    }
    
}