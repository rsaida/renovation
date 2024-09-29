<?php
     require_once "db.php";
     $fail = false;
      
     if (!empty($_POST)) {
          extract($_POST);
      
          if ($email == "clear") {
              clearTokens();
          }
      
          if (checkUser($email, $password, $user)) {
              if (isset($remember)) {
                  $token = sha1(uniqid() . "Private Key is Here" . time());
                  setcookie("access_token", $token, time() + 60 * 60 * 24 * 1, "/", "", false, true);
                  setTokenByEmail($email, $token);
              }
      
              // Login and set session
              $_SESSION["user"] = $user;
              echo "LOGGED IN";
          } else {
              $fail = true;
          }
     }
     if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["access_token"])) {
          $user = getUserByToken($_COOKIE["access_token"]);
          if ($user) {
              $_SESSION["user"] = $user["email"];
          }
     }
      
     if ($_SERVER["REQUEST_METHOD"] == "GET" && isAuthenticated()) {
          echo "go to next page";
          // header("Location: IDK.php");
          exit;
     }
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
          <input type="text" name="email" id="email" placeholder="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
          <br>
          <input type="password" name="password" id="password" placeholder="password">
          <br>
          <label for="remember" >Remember me</label>
          <input type="checkbox" id="remember" name="remember" style="margin-right: 5px;" > 
          <br>
          <button type="submit" class="btn">LOG IN</button>
          <?php
               if ($fail) {
                    echo '<p style="color: red;">Failed to log in</p>';
               }
          ?>
     </form>

     <p>
          email: email
          <br>
          Password: 123
          <br>
          type clear in email to clear all of the tokens for auto login
     </p>
</body>
</html>