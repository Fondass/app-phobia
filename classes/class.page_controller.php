<?php

/* class: PhP controller class
 * 
 * Works with: 
 * index.php
 * 
 * controller for all http requests.
 */

class FonController 
{
    protected $user;
    protected $db;
    protected $helper;
   
    protected $ajax;
    
//================================================
//             construct controller
//================================================
/*
 * This controller is where most site-wide features
 * are handled made or included. All files that are
 * required by many or multiple loads of the site are
 * stacked here for convienence.
 * 
 * also site-wide paramaters are instantiated here
 * so that they may be handed over to most 
 * other classes through the controller.
 * 
 * (note: file requires only required by one 
 * particualar area should be shoved in the 
 * controller itself to limit file loading)
 */
//================================================
       
    public function __construct()
    {
        require_once("classes/class.page.php");
        require_once("classes/class.debug.php");
        require_once("classes/class.pdo.php");
        require_once("classes/class.helpers.php");
        require_once("classes/class.database.php");
        require_once("classes/class.login.php");
       // require_once("classes/class.controller.ajax.php");
        
        $this->helper = new Helpers();
        $this->db = new FonDatabase();
        $this->user = new FonLogin($this->db, $this->helper);
     //   $this->ajax = new AjaxController($this->user, $this->db, $this->helper);
    }
    
//================================================
//                handle Request
//================================================
/*
 * Divides all incomming HTTP requests into
 * page requests or ajax requests.
 */
//================================================
    
    public function handleRequest()
    {
        if (isset($_POST["ajaxaction"]) || isset($_GET["ajaxaction"]))
        {
            $this->ajax->handleAjaxRequest();
        }
        else
        {
            $this->handleHttpRequest();
        }  
    }
    
//================================================
//                 handle http request
//================================================
/*
 * The page found by getPage (if found) is handed
 * on to the controller here after injection
 * validation.
 */
//================================================   
    
    protected function handleHttpRequest() 
    {
        $pagevar =  $this->getPage();
        $page = $this->pageController($this->helper->specChars($pagevar));
        if ($page)
        {
            $page->show();
        }
        else
        {
            echo "Gnomes have stolen the webpage, we apologize for their natural behaviour";
        }
    }
    
//================================================
//                    get page
//================================================
/*
 * small function that asks the helper class
 * CheckRequestMethod to give back the ?page= element
 * and hands it over to handleRequest.
 */
//================================================
    
    protected function getPage () 
    {
        $key = "page";

        $result = $this->helper->checkRequestMethod($key);
        return $result;
    } 
  
//================================================
//                page controller
//================================================
/*
 * main controller of the website. Every new page
 * visit, form post, and others go through here
 * before reaching their destination as designed by
 * this controller.
 */
//================================================
    
    protected function pageController($pagevar) 
    {
        switch ($pagevar) 
        {        
            
            
            case "verify":
                require_once("classes/pages/page.verify.php");
                require_once("classes/class.verify.php");
                $function = new FonVerify($this->user, $this->db, $this->helper);
                $page = new FonVerifyPage($this->user, $this->db, $this->helper, $function);
                break;
            
            case "account";
                require_once("classes/pages/page.account.php");
                require_once("classes/class.account.functions.php");
                $function = new FonAccount($this->user, $this->db, $this->helper);
                $page = new FonAccountPage($this->user, $this->db, $this->helper, $function);
                break;
            
            case "logout":
                session_destroy();
                session_start();
            
            case "home":
                  
            default:
                require_once("classes/pages/page.home.php");
                require_once("classes/pages/page.login.php");
                require_once("classes/pages/page.register.php");
                require_once("classes/class.register.functions.php");
                require_once("classes/class.captcha.php");
                $login = new FonLoginPage($this->user, $this->db);
                $page = new FonHomePage($this->user, $this->db, $this->helper, $login);
        }
        return $page;
    }
}