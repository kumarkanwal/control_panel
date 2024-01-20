<?php

// Initialize the session
session_start();

// unset all of the session variable
$_SESSION = array();

// if it's desired to kll the session, also delete the session cookie
// Note : This will destroy the session, and not just the session data!

if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(),'', time() - 42000,
    $params["path"],$params['domain'],
    $params['secure'], $params['httponly']
);
}

// Finally, destroy thr session 
if(session_destroy()){
    header("location: login.php");
}



?>