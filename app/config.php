<?php
return array(
    
    /*
    * - The registry tells the applications which folders in the public directory are accesible to the application.  The value defines the name of the webp folder if not default.
    */
    'register'=> array(
        
        'images'=>'' //if '' then defaults to <images>-webp
        
        ),
        
    /*
    * - accepted API commands 
    */   
    'api'=> array(
        
        'folder',
        
        ),
    
    /*
    * - directory which holds API.  Do not move the api into the app folder.  htaccess will block api requests.
    */
    'appDir'=>'/blob-freezer',
    
    /*
    * - sets the public folder to the folder called public.
    */
    'public'=>'public'
 
);
?>