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

// check if user is logged in
if (isset($_SESSION['user_id'])) {
    if (!isset($_SESSION["last_activity"])) {
        // no last activity time exists, so set it to current time
        $_SESSION["last_activity"] = time();
    } else {
        // wait 30 minutes before regenerating session ID
        $interval = 60 * 30; // 30 minutes
        if (time() - $_SESSION["last_activity"] >= $interval) {
            // user has been inactive for 30 minutes, so regenerate session ID
            session_regenerate_id(true);
        }
    }
} else {
    if (!isset($_SESSION["last_regeneration"])) {
        // no last regeneration time exists, so regenerate session ID
        session_regenerate_id(true);
    } else {
        // wait 30 minutes before regenerating session ID
        $interval = 60 * 30; // 30 minutes
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            session_regenerate_id(true);
        }
    }
}

// update last activity time every time user performs an action
$_SESSION["last_activity"] = time();
