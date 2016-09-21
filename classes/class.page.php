<?php
	

class FonPage
{
    
    protected $user;
    protected $db;
    protected $helper;
    
    public function show()
    {
            $this->beginDoc();
            $this->beginHeader();
            $this->headerContent();
            $this->endHeader();
            $this->beginBody();
            $this->bodyContent();
            $this->endBody();
            $this->Jsfooter();
            $this->endDoc();
    }	
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
    protected function beginDoc() 
    { 
        echo '<html lang="en">'; 
    }

    protected function beginHeader() 
    { 
        echo '<head>
            <meta charset=UTF-8>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="lib/jquery-1.12.4.min.js"></script>'; 
    }

    protected function headerContent() 
    { 
        echo "<title>App-Phobia</title>";
    }

    protected function endHeader()
    { 
        echo "</head>"; 
    }

    protected function beginBody() 
    { 
        echo '<body>'; 
    }

    protected function bodyContent() 
    { 
        echo ""; 
    }

    protected function endBody() 
    { 
        echo '<script>window.jQuery || document.write("<script src="assets/js/vendor/jquery.min.js">        <\/script>")</script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script></body>'; 
    }
    
    protected function Jsfooter()
    {
        echo '';
    }
    
    protected function endDoc() 
    { 
        echo "</html>"; 
    }
}
		

