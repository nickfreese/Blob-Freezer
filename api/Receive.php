<?php

class Receive 
{
    private $acceptedArgs;
    private $appDir;
    
    function __construct($acceptedArgs, $appDir)
    {
        $this->input = '';
        $this->inputObj = new stdClass();
        $this->acceptedArgs = $acceptedArgs;
        $this->appDir = $appDir;
    }
    
    /*
    * checks for request uri and dumps it into this object
    */
    public function getRequest()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $this->input = $_SERVER['REQUEST_URI'];
        }
        
    }
    
    /*
    * Formats the request as a key name paired object
    * - note: This method does NOT allow for actions to be used more than once per request.  The last instance of an action in a request is the one used.
    *         support for mutiple uses of an action will be added as a config in a later release.
    */
    private function formatRequest()
    {
           $requestArray = explode("/", $this->input);
           $appDir = explode("/", $this->appDir);
           foreach($appDir as $dir){
               array_shift($requestArray);
           }
           for ($i = 0; $i<count($requestArray); $i++) {
               foreach ($this->acceptedArgs as $arg) {
                   if ($arg == $requestArray[$i]) {
                   $this->inputObj->$arg = $requestArray[$i + 1];
                   }
               }
           }
    }
    
    /*
    * Calls getRequest and fromat Request
    * - This is the first function anyone would need to call
    */
    public function getInput()
    {
        $this->getRequest();
        $this->formatRequest();
        
    }
    
}

?>