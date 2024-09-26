<?php
const DSN = "mysql:host=localhost;dbname=photos;charset=utf8mb4";
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

function checkUser($email, $pass) {

}
function setTokenByEmail($email, $token) {
    global $db;
    $stmt = $db->prepare("UPDATE users SET user_session_token = ? WHERE user_email = ?");
    $stmt->execute([$token, $email]);
}
