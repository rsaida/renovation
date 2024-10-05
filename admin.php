<?php

require_once "db.php";
// createUser("MelieAdmin", "ZA7wtqCr");
session_start();
$fail = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    
    // CSRF token check
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token.");
    }
    
    if ($email == "clear") {
        clearTokens();
    }

     if (checkUser($email, $password, $user)) {
          // Login successful, $user contains the user information
          session_regenerate_id(true);
     
          if (isset($remember)) {
               // Generate a secure session token for the "Remember Me" functionality
               $token = bin2hex(random_bytes(32));
               $tokenHash = hash_hmac('sha256', $token, 'your-secret-key');
               setcookie("access_token", $token, time() + 60 * 60 * 24 * 30, "/", "", true, true); // save for 30 days
               setTokenByEmail($email, $tokenHash);  // Store the hashed token in DB
          }
     
          // Login and set session
          $_SESSION["user"] = $user['email'];  // Store the email or user ID in the session
          header("Location: edit.php");
          exit;
     } else {
          $fail = true;  // Login failed
     }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_COOKIE["access_token"])) {
    $tokenHash = hash_hmac('sha256', $_COOKIE["access_token"], 'your-secret-key');
    $user = getUserByToken($tokenHash);
    if ($user) {
        $_SESSION["user"] = $user["email"];
    }
}

if (isAuthenticated()) {
    header("Location: edit.php");
    exit;
}

// Generate CSRF token for the form
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <style>
          form {
               margin: 15px;
          }
          input {
               margin-bottom: 10px;
          }
     </style>
</head>
<body>
     <form method="post">
          <input type="text" name="email" id="email" placeholder="email" 
                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
          <br>
          <input type="password" name="password" id="password" placeholder="password">
          <br>
          <label for="remember">Remember me</label>
          <input type="checkbox" id="remember" name="remember" style="margin-right: 5px;"
                    <?= isset($_POST['remember']) ? 'checked' : '' ?> >
          <br>
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
          <button type="submit" class="btn">LOG IN</button>

          <?php if ($fail): ?>
               <p style="color: red;">Failed to log in</p>
          <?php endif; ?>
     </form>

     <p>
          email: MelieAdmin
          <br>
          Password: ZA7wtqCr
          <br>
          type clear in email to clear all of the tokens for auto login
          <br>
          SAIDA if its the first time entering, make sure to add the account into users database. Do it by going to the very top of admin.php and unccommenting "createuser()"
     </p>
</body>
</html>
