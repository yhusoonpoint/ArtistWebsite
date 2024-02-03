<?php
    //https://stackoverflow.com/questions/16759719/i-just-cant-destroy-a-session-in-php/43167905
    //this clears all data set and logs out user.
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    //take user to login page
    header("Location: login.php");
    exit;

?>