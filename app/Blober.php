<?php

class Blober
{
    
    
    /*
    * - check webp support (checks if using chrome)
    */
    private function supportsWebp()
    {
    
    if (stripos( $_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) {
        return true;
        }
        else{
            return false;
        }
    }
    
    /*
    * - Save the cache to specified location
    */
    private function saveCache($location, $data)
    {
    
        $fh = fopen($location, 'w');
        fwrite($fh, $data);
        fclose($fh);
    
    }
    /*
    * - check if cache file exists.    !!!!  MOVE CACHE VALIDITY CHECKING TO THIS FUNCTION
    */
    private function checkCache($location)
    {
 
        $data = file_get_contents($location . '/cache.json');
        if ($data == '' || $data == '{}') {
            return false;
        } else {
            return $data;
        }
    
    }
    
    /*
    * - main blober function.  build folders, process images, process caches.
    * - save caches -> return object;
    */
    private function buildFolderResponse($dir, $webpDir)
    {
        $blobResponse = new stdClass();
        $imageList = scandir($dir);
        for($i=0;$i<count($imageList);$i++){
            if(($imageList[$i] !== "." && $imageList[$i] !== ".." && pathinfo($dir . "/" .$imageList[$i], PATHINFO_EXTENSION) !== 'json') || !is_dir($imageList[$i])){
        
            $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $imageList[$i]); //get plain text of file
        
                //if webpSupport
                if ($this->supportsWebp()) {
                    if (!file_exists($webpDir . "/" .$withoutExt . '.webp')) {
            
                        $im = '';    
                        $ext = pathinfo($dir . "/" .$imageList[$i], PATHINFO_EXTENSION); //get file extension
        
                            //build image objects
                            if ($ext == 'jpg' || $ext == 'jpeg') {
                                $im = imagecreatefromjpeg($dir . "/" .$imageList[$i]);
                            } else if ($ext == 'png') {
                                $im = imagecreatefrompng($dir . "/" .$imageList[$i]);
                            } else if ($ext == 'gif') {
                                $im = imagecreatefromgif($dir . "/" .$imageList[$i]);
                            } else if ($ext == 'webp') {
                                $im = imagecreatefromwebp($dir . "/" .$imageList[$i]);
                            } else {
                                $im = '';
                            }
            
                        if($withoutExt !== 'cache'){
                        //create and save webp
                        imagewebp($im, $webpDir. '/'.$withoutExt.'.webp');
                        // Free up memory
                        imagedestroy($im);
                        }
                    }
                    if($withoutExt !== 'cache'){
                $blobResponse->{$imageList[$i]} = base64_encode(file_get_contents($webpDir . "/" .$withoutExt . '.webp'));
                    }
                } else { //if no webp support
                    $blobResponse->{$imageList[$i]} = base64_encode(file_get_contents($dir . "/" . $imageList[$i]));
                }
            }
        }
        
        //save caches and return
        if ($this->supportsWebp()) {
            $this->saveCache($webpDir . "/cache.json", json_encode($blobResponse, JSON_PRETTY_PRINT));
        } else {
            $this->saveCache($dir . "/cache.json", json_encode($blobResponse, JSON_PRETTY_PRINT)); 
        }
        return $blobResponse;
    }
    
    public function bloberInit($api, $conf)
    {
        
        /*
        * - App Logic here
        */
        
         $_helper = $api->getHelper();//get the helper object

        $_response = $api->getResponse();//get the reponse object;

        $api->getReceive()->getInput();//Gets the api request from server variable

        //checkRegistrySettings


        //get folder
        
        if (isset($api->getReceive()->inputObj->folder)) {
            $folder = $_helper->filterString($api->getReceive()->inputObj->folder);
            if (isset($conf['register'][$folder])) {
                if ($conf['register'][$folder] == '') {//check Registry for default
                   $conf['register'][$folder] = $folder . "-webp";
                }
            
                if (is_dir($conf['public'] .'/'. $folder) && array_key_exists($folder, $conf['register'])) {
            
                    if (!is_dir($conf['public'] ."/". $conf['register'][$folder])) {
                        mkdir($conf['public'] ."/". $conf['register'][$folder]);
                    }
                        $response = $this->buildFolderResponse($conf['public']. '/' . $folder, $conf['public'] .'/'. $conf['register'][$folder]);
        
                        $_response->data->setData('response',  $response);
        
                        echo $_response->data->createJSON('response');    
                }
            
            }
        }

    }
    
}





?>