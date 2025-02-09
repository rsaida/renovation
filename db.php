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

function checkUser($email, $pass, &$user) {
    global $db;

    // Fetch user data from the database by email
    $stmt = $db->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user exists, verify the password using password_verify()
    if ($user) {
        // Use password_verify to check the hashed password
        if (password_verify($pass, $user["password"])) {
            return true;  // Correct password
        }
    }
    
    return false;  // Invalid credentials
}

function getpassword($email) { 
    global $db;

    $stmt = $db->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}


function createUser($email, $password) {
    global $db;

    // First, check if the email already exists
    $stmt = $db->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return "Email already exists!";
    }

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the accounts table
    $stmt = $db->prepare("INSERT INTO accounts (email, password, user_session_token) VALUES (?, ?, NULL)");
    if ($stmt->execute([$email, $hashedPassword])) {
        return "User created successfully!";
    } else {
        return "Failed to create user.";
    }
}


// Set the token for the user based on their email
function setTokenByEmail($email, $token) {
    global $db;

    // Update the session token for the user in the database
    $stmt = $db->prepare("UPDATE accounts SET user_session_token = ? WHERE email = ?");
    $stmt->execute([$token, $email]);
}

// Clear all user session tokens
function clearTokens() {
    global $db;

    // Set all session tokens to NULL in the database
    $stmt = $db->prepare("UPDATE accounts SET user_session_token = NULL");
    $stmt->execute();
}

// Retrieve the user by their session token
function getUserByToken($token) {
    global $db;

    // Fetch the user associated with the session token
    $stmt = $db->prepare("SELECT email FROM accounts WHERE user_session_token = ?");
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Return the user data
}

// Check if the user is authenticated based on the session
function isAuthenticated() {
    return isset($_SESSION["user"]);
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
    $stmt = $db->prepare("DELETE FROM photos WHERE path = ?");
    if ($stmt->execute([$path])) {
        echo "File '$path' deleted from the database.<br>";
    } else {
        echo "Error deleting file from the database.<br>";
    }
}
function deleteProject($path) {
    $project = "";
    for($i = 0; $i < strlen($path); $i++) {
        if($path[$i] != '/')$project .= $path[$i];
        else $project = "";
    }
    global $db;
    $stmt = $db->prepare("delete FROM photos WHERE project = ?");
    if ($stmt->execute([$project])) {
        echo "Project '$project' and all its files deleted from the database.<br>";
    } else {
        echo "Error deleting project from the database.<br>";
    }
}
function getDisplayedPhoto($project) {
    global $db;
    
    $stmt = $db->prepare("SELECT path FROM photos WHERE project = ? AND display = 1");
    $stmt->execute([$project]);
    
    return $stmt->fetchColumn();  // Return the path of the currently displayed photo
}
function setDisplayedPhoto($project, $filePath) {
    global $db;
    
    // Begin transaction to ensure consistency
    $db->beginTransaction();

    try {
        // Set all photos of the project to display = 0
        $stmt = $db->prepare("UPDATE photos SET display = 0 WHERE project = ?");
        $stmt->execute([$project]);

        // Now set the selected photo to display = 1
        $stmt = $db->prepare("UPDATE photos SET display = 1 WHERE project = ? AND path = ?");
        $stmt->execute([$project, $filePath]);

        // Commit the transaction
        $db->commit();
        return true;  // Indicate success
    } catch (Exception $e) {
        // Roll back the transaction if something goes wrong
        $db->rollBack();
        echo "Error updating display status: " . $e->getMessage();
        return false;  // Indicate failure
    }
}
function hideProject($project) {
    global $db;

    // Set all photos of the project to display = 0
    $stmt = $db->prepare("UPDATE photos SET display = 0 WHERE project = ?");
    if ($stmt->execute([$project])) {
        echo "The project '$project' is now hidden.<br>";
    } else {
        echo "Error hiding the project '$project'.<br>";
    }
}

// Function to edit folder name
function editFolderName($oldName, $newName) {
    global $db;

    // Check if the new name already exists to avoid duplication
    $stmt = $db->prepare("SELECT * FROM photos WHERE project = ?");
    $stmt->execute([$newName]);
    if ($stmt->fetch()) {
        return "A folder wit this name already exists.";
    }

    // Update the folder name in the database
    $stmt = $db->prepare("UPDATE photos SET project = ? WHERE project = ?");
    if ($stmt->execute([$newName, $oldName])) {
        return "Folder name updated successfully.";
    } else {
        return "Error updating folder name.";
    }
}
