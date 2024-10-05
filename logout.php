<?php
     include_once "db.php";

     session_start();

     if (isset($_SESSION['user'])) {
     $email = $_SESSION['user'];  
     setTokenByEmail($email, null);  
     }

     session_unset();
     session_destroy();

     setcookie("access_token", "", time() - 3600, "/", "", true, true);  // Expire the cookie

     header("Location: admin.php");
     exit;
?>