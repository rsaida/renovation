<?php
const DSN = "mysql:host=localhost;dbname=web;charset=utf8mb4";
const USER = "root";
const DBPASSWORD = "";

try {
    $db = new PDO(DSN, USER, DBPASSWORD);
} catch(PDOException $e) {
    echo "Set username and password in 'db.php' appropriately";
    exit;
}


function getphotos($id) {
     global $db;

     $stmt = $db->prepare("SELECT * FROM `photos` WHERE (project = ?)");
     $stmt->execute([$id]);
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getmainphotos() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM `photos` WHERE (display = 1)");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function checkUser($email, $pass, &$user) {
    global $db;

    $stmt = $db->prepare("select * from accounts where email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ( $user ) {
         return password_verify1($pass, $user["password"]);
    }
    return false ;

}
function password_verify1($s1, $s2) {
    return $s1 == $s2;
}
function setTokenByEmail($email, $token) {
    global $db;
    $stmt = $db->prepare("UPDATE accounts SET user_session_token = ? WHERE email = ?");
    $stmt->execute([$token, $email]);
}

function clearTokens(){
    global $db;
    $stmt = $db->prepare("UPDATE accounts SET user_session_token = NULL");
    $stmt->execute();
}

function getUserByToken($token) {
    global $db;
    $stmt = $db->prepare("SELECT email FROM accounts WHERE user_session_token = ?");
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function isAuthenticated() {
    return isset($_SESSION["user"]);
}

function addImagePathToDatabase($project, $filePath) {
    global $db;
    $display = 0;  // By default, the display field is set to 0
    $stmt = $db->prepare("INSERT INTO photos (project, path, display) VALUES (?, ?, ?)");
    if ($stmt->execute([$project, $filePath, $display])) {
        echo "File path added to the database for project '$project'.<br>";
    } else {
        echo "Error adding file path to the database.<br>";
    }
}

function getPath($filename) {
    global $db;
    $stmt = $db->prepare("SELECT path FROM photos WHERE name = ?");
    $stmt->execute([$filename]);
    return $stmt->fetch();
}

function deleteFile($path) {
    if($path[0] != '.' && $path[1] != '/')$path = './' . $path;
    echo "<br><br>";
    echo $path;
    global $db;
    $stmt = $db->prepare("delete FROM photos WHERE path = ?");
    $stmt->execute([$path]);
}
function deleteProject($path) {
    $project = "";
    for($i = 0; $i < strlen($path); $i++) {
        if($path[$i] != '/')$project .= $path[$i];
        else $project = "";
    }
    global $db;
    $stmt = $db->prepare("delete FROM photos WHERE project = ?");
    $stmt->execute([$project]);
}

function getMainPicture($project) {
    global $db;
    $stmt = $db->prepare("SELECT path FROM photos WHERE project = ? and display = 1");
    $stmt->execute([$project]);
    return $stmt->fetch();
}