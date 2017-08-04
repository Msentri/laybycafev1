<?php
// Inialize session
session_start();


    // Delete certain session
unset($_SESSION['merchantSession']);
unset($_SESSION['userSession']);
// Delete all session variables
    session_destroy();

// Jump to login page
    header('Location: login');

?>