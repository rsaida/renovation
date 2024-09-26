<?php
     require_once "db.php";
     $fail = false;
     if (!empty($_POST)) {
          extract($_POST) ;
          if ( checkUser($email, $password, $user) ) {

               if ( isset($remember)) {
                    $token = sha1(uniqid() . "Private Key is Here" . time() ) ; // generate a random text
                    setcookie("access_token", $token, time() + 60*60*24*1, "/", "", false, true) ; // for 1 days, http only flag for security
                    setTokenByEmail($email, $token) ;
               }
               
               // login as $user
               $_SESSION["user"] = $user;

               header("Location: index.php") ;
               exit;
          }
          else { 
               var_dump($user);
               var_dump($password);
               $fail = true  ; }
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
     </p>
</body>
</html>