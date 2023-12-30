<?php

//Configure secure sessions
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

//Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

//Start session
session_start();


//Regenerate session ID every 30 minutes for security

if(!isset($_SESSION["last_regeneration"])){
    // no last regeneration time exists, so regenerate session ID
    regen_session_id();
}else{
    // wait 30 minutes before regenerating session ID
    $interval = 60 * 30; // 30 minutes
    if(time() - $_SESSION["last_regeneration"] >= $interval){
        regen_session_id();
    }
}


function regen_session_id(){
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
}