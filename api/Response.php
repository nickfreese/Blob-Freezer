<?php

class Response {
    
    //private $data = new data();
    
    function __construct(){
        $this->data = new data();
    }
    
};

/*
* Data class stores data 
*/

class data {
    
    /*
    * Create new sub data object
    */
    public function createDataObj()
    {
        
    }
    
    /*
    * get data from the data object;
    */
    public function getData($key)
    {
        foreach($this as $dataKey => $dataValue){
            if($dataKey == $key){
                return $this->$dataKey;
            }
            else{
                return null;
            }
        }
    }
    
    /*
    * Set data to the data object
    */
    public function setData($setKey, $setVal)
    {
        $this->$setKey = $setVal;
    }
    
    
    /*
    *  Build JSON Reponse
    */
    public function createJSON($sub = ''){
        if($sub == ''){
        return json_encode($this);
        }
        else{
        return json_encode($this->$sub);  
        }
    }
    
};

?>