<?php
/*
* ------------------------------------------
* - Ice Blober, Copyright Nick Freese 2017 -
* ------------------------------------------
*/
header('Content-Type: application/json');
header('Cache-Control: max-age=2592000, public');

/*
* - include classes -
*/
$config = include_once('app/config.php');
include_once('api/IceApi.php');
include_once('app/Blober.php');

/*
* - initialize API instance -
*/
$api = new IceApi(
    new Helper(),
    new Response(),
    new Receive($config['api'],  $config['appDir'])
    );

/*
* - initialize Blober instance -
*/
$blober = new Blober();

/*
* - Run Application -
*/
$blober->bloberInit($api, $config);



?>