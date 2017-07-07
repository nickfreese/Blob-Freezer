<?php
/*
* Ice API is a simple Class for recieving and responding to http requests.
* 
* About IceApi
* - This class is very simple and provides no rate limiting or comprehensiveinout validation.
* - The purpose of this class is to provide the basic structure and logic for building an API.
*   To use this class properly, one should intend to extend it with application specific technology.
*
* Recieve - Get url, and parse URI string into object 
*
* Respond - Create response object, get/set values and parameters, render and respond with JSON.
*
* Helper - Filters
*
*/

/*
* include dependencies
*/
include_once('Helper.php');
include_once('Response.php');
include_once('Receive.php');

/*
* Define Main IceApi Class
*/
class IceApi 
{
    
    public $requestUri = '';
    public $apiObj = '';
    
    /*
    * Dependency Injection
    */
    private $helper;
    private $response;
    private $receive;
    
    /*
    *constructor grabs the request
    */
    function __construct(
        Helper $helper,
        Response $response,
        Receive $receive
        ) {
            $this->helper = $helper;
            $this->response = $response;
            $this->receive = $receive;
        }
    
    /*
    * Getters for sub classes
    */
    public function getHelper()
    {
        return $this->helper;
    }
    
    public function getResponse()
    {
        return $this->response;
    }
    public function getReceive()
    {
        return $this->receive;
    }
    
}


?>