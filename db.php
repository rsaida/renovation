<?php
const DSN = "mysql:host=localhost;dbname=photos;charset=utf8mb4";
const USER = "root";
const DBPASSWORD = "";

try {
    $db = new PDO(DSN, USER, DBPASSWORD);
} catch (PDOException $e) {
    echo "Set username and password in 'db.php' appropriately";
    exit;
}

function checkUser($email, $pass, &$user)
{
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

function getpassword($email)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}


function createUser($email, $password)
{
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
function setTokenByEmail($email, $token)
{
    global $db;

    // Update the session token for the user in the database
    $stmt = $db->prepare("UPDATE accounts SET user_session_token = ? WHERE email = ?");
    $stmt->execute([$token, $email]);
}

// Clear all user session tokens
function clearTokens()
{
    global $db;

    // Set all session tokens to NULL in the database
    $stmt = $db->prepare("UPDATE accounts SET user_session_token = NULL");
    $stmt->execute();
}

// Retrieve the user by their session token
function getUserByToken($token)
{
    global $db;

    // Fetch the user associated with the session token
    $stmt = $db->prepare("SELECT email FROM accounts WHERE user_session_token = ?");
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Return the user data
}

// Check if the user is authenticated based on the session
function isAuthenticated()
{
    return isset($_SESSION["user"]);
}


function getphotos($id)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `photos` WHERE (project = ?)");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getmainphotos()
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM `photos` WHERE (display = 1)");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function addImagePathToDatabase($project, $filePath)
{
    global $db;
    $display = 0;  // By default, the display field is set to 0
    $stmt = $db->prepare("INSERT INTO photos (project, path, display) VALUES (?, ?, ?)");
    if ($stmt->execute([$project, $filePath, $display])) {
        echo "File path added to the database for project '$project'.<br>";
    } else {
        echo "Error adding file path to the database.<br>";
    }
}

function getPath($filename)
{
    global $db;
    $stmt = $db->prepare("SELECT path FROM photos WHERE name = ?");
    $stmt->execute([$filename]);
    return $stmt->fetch();
}

function deleteFile($path)
{
    echo $path;
    global $db;
    $stmt = $db->prepare("DELETE FROM photos WHERE path = ?");
    if ($stmt->execute([$path])) {
        echo "File '$path' deleted from the database.<br>";
    } else {
        echo "Error deleting file from the database.<br>";
    }
}
function deleteProjectphotos($path)
{
    $project = "";
    for ($i = 0; $i < strlen($path); $i++) {
        if ($path[$i] != '/')
            $project .= $path[$i];
        else
            $project = "";
    }
    global $db;
    $stmt = $db->prepare("delete FROM photos WHERE project = ?");
    if ($stmt->execute([$project])) {
        echo "Project '$project' and all its files deleted from the database.<br>";
    } else {
        echo "Error deleting project from the database.<br>";
    }
}
function deleteProject($projectName) {
    global $db;
    $stmt = $db->prepare("DELETE FROM projects WHERE name = ?");
    return $stmt->execute([$projectName]);
}
function getDisplayedPhoto($project)
{
    global $db;

    $stmt = $db->prepare("SELECT path FROM photos WHERE project = ? AND display = 1");
    $stmt->execute([$project]);

    return $stmt->fetchColumn();  // Return the path of the currently displayed photo
}
function setDisplayedPhoto($project, $filePath)
{
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
function hideProject($project)
{
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
function checkProjectName($name)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM projects WHERE project = ?");
    $stmt->execute([$name]);
    if ($stmt->fetch()) {
        return "A folder with this name already exists.";
    }
}
function editFolderName($oldName, $newName)
{
    global $db;
    $stmt = $db->prepare("UPDATE photos SET project = ? WHERE project = ?");
    if ($stmt->execute([$newName, $oldName])) {
        return "Folder name updated successfully.";
    } else {
        return "Error updating folder name.";
    }
}

function addProject($name)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO projects (name) VALUES (?)");
    if ($stmt->execute([$name])) {
    } else {
        echo "Error adding file path to the database.<br>";
    }
}

function getDescription($name)
{
    global $db;
    $stmt = $db->prepare("SELECT description FROM projects WHERE name = ?");
    $stmt->execute([$name]);
    return $stmt->fetchColumn();
}

function updateDescription($projectName, $newDescription)
{
    global $db;
    $stmt = $db->prepare("UPDATE projects SET description = ? WHERE name = ?");
    return $stmt->execute([$newDescription, $projectName]);
}

function getLocation($projectName)
{
    global $db;
    $stmt = $db->prepare("SELECT location FROM projects WHERE name = ?");
    $stmt->execute([$projectName]);
    return $stmt->fetchColumn();
}

function getArea($projectName)
{
    global $db;
    $stmt = $db->prepare("SELECT area FROM projects WHERE name = ?");
    $stmt->execute([$projectName]);
    return $stmt->fetchColumn();
}

function updateLocation($projectName, $newLocation)
{
    global $db;
    $stmt = $db->prepare("UPDATE projects SET location = ? WHERE name = ?");
    return $stmt->execute([$newLocation, $projectName]);
}

function updateArea($projectName, $newArea)
{
    global $db;
    $stmt = $db->prepare("UPDATE projects SET area = ? WHERE name = ?");
    return $stmt->execute([$newArea, $projectName]);
}
function projectExists($projectName, $parentFolder = 'projects')
{
    global $db;
    // Check in the database
    $stmt = $db->prepare("SELECT COUNT(*) FROM projects WHERE name = ?");
    $stmt->execute([$projectName]);
    if ($stmt->fetchColumn() > 0) {
        return true;
    }
    // Check on the filesystem
    $projectPath = $parentFolder . '/' . $projectName;
    if (is_dir($projectPath)) {
        return true;
    }
    return false;
}

function updateProjectName($oldName, $newName)
{
    global $db;
    $stmt = $db->prepare("UPDATE projects SET name = ? WHERE name = ?");
    return $stmt->execute([$newName, $oldName]);
}
function updatePhotosProjectName($oldName, $newName)
{
    global $db;
    $stmt = $db->prepare("UPDATE photos SET project = ?, path = REPLACE(path, ?, ?) WHERE project = ?");
    return $stmt->execute([
        $newName,
        'projects/' . $oldName . '/',
        'projects/' . $newName . '/',
        $oldName
    ]);
}
