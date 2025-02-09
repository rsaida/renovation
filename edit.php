<?php

require_once "db.php";

session_start();

// Check if user is authenticated
if (!isset($_SESSION['user'])) {
    // If not authenticated, redirect to login page
    header("Location: admin.php");
    exit;  // Stop further execution of the script
}

$timeoutDuration = 1800; // 30 minutes
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeoutDuration) {
    session_unset();
    session_destroy();
    header("Location: admin.php");
    exit;
}
$_SESSION['last_activity'] = time();  // Update last activity time

function deleteItem($path) {
    if (is_dir($path)) {
        // Recursively delete folder and its contents
        array_map('unlink', glob("$path/*"));
        rmdir($path);
        echo "Folder deleted: $path<br>";
        deleteProject($path);
    } elseif (is_file($path)) {
        unlink($path);  // Delete file
        deleteFile($path);
        echo "File deleted: $path<br>";
    } else {
        echo "Error: Item not found.<br>";
    }
}

if (isset($_GET['delete'])) {
    $path = $_GET['delete'];
    echo $path;
    // Check if the item exists before attempting to delete
    if (file_exists($path)) {
        deleteItem($path);
    } else {
        echo "Error: File or folder does not exist.<br>";
    }
}

if (isset($_GET['hide_project'])) {
    $folder = $_GET['folder'];
    $projectName = basename($folder);

    // Hide the entire project using the helper function
    hideProject($projectName);
    
    // Optionally, redirect or refresh the page to reflect the changes
    header("Location: ?folder=" . urlencode($folder));
}

if (isset($_GET['set_display'])) {
    $filePath = $_GET['set_display'];
    $folder = $_GET['folder'];
    $projectName = basename($folder);

    echo $projectName, "  ", $filePath;  // Use $filePath instead of $filename

    // Update the displayed photo using the helper function
    setDisplayedPhoto($projectName, $filePath);
    
    // Optionally, refresh the page to reflect the changes
    // header("Location: ?folder=" . urlencode($folder));
}

function displayFolderContents($folderPath) {
    // Check if the folder exists
    if (is_dir($folderPath)) {
        // Scan the folder
        $contents = scandir($folderPath);
        $projectName = basename($folderPath);  // Get the project name based on folder

        // Fetch the currently displayed photo for the project using a helper function
        $displayedPhoto = getDisplayedPhoto($projectName);  // No need to strip './' with substr()

        // Loop through the contents
        foreach ($contents as $item) {
            // Exclude the current (.) and parent (..) directories
            if ($item != '.' && $item != '..') {
                // Full path to the item
                $fullPath = $folderPath . '/' . $item;

                // Check if we're in the 'projects' folder
                if ($folderPath === 'projects') {
                    // Display only folders in the 'projects' folder
                    if (is_dir($fullPath)) {
                        echo "<strong><a href='?folder=" . urlencode($fullPath) . "'>Folder: $item</a></strong>";
                        echo " <a href='?folder=" . urlencode($folderPath) . "&delete=" . urlencode($fullPath) . "' onclick='return confirm(\"Are you sure you want to delete this folder?\")'>
                        <img src='./icons/delete.svg' alt='Delete' style='width:16px;height:16px;vertical-align:middle;'></a><br>";
                    }
                } else {
                    // Check if the file is the displayed file
                    if ($fullPath == $displayedPhoto) {
                        // Display the "displayed" file in bold
                        echo "<strong>File: $item (Currently Displayed)</strong>";
                    } else {
                        // If it's not the displayed file, show the file name and button
                        echo "File: $item";
                        echo " <a href='?folder=" . urlencode($folderPath) . "&set_display=" . urlencode($fullPath) . "' onclick='return confirm(\"Are you sure you want to set this file as displayed?\")'>
                        <button>Set as Displayed</button></a>";
                    }

                    // Add delete link for both folders and files in subdirectories
                    echo " <a href='?folder=" . urlencode($folderPath) . "&delete=" . urlencode($fullPath) . "' onclick='return confirm(\"Are you sure you want to delete this item?\")'>
                    <img src='./icons/delete.svg' alt='Delete' style='width:16px;height:16px;vertical-align:middle;'></a><br>";
                }
            }
        }
        echo "<br><a href='?folder=" . urlencode($folderPath) . "&hide_project=1' onclick='return confirm(\"Are you sure you want to hide this project?\")'>
              <button>Do not display this project</button></a>";
    } else {
        echo "Folder not found.";
    }
}


// Get the folder to display from the URL (default to 'projects')
$folderToDisplay = isset($_GET['folder']) ? $_GET['folder'] : 'projects';

echo "<h2>Contents of: $folderToDisplay</h2>";
displayFolderContents($folderToDisplay);

// Check if an image file is being uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if files were selected for upload
    if (isset($_FILES['imageToUpload'])) {
        $totalFiles = count($_FILES['imageToUpload']['name']);
        
        for ($i = 0; $i < $totalFiles; $i++) {
            // Check if file is valid
            if ($_FILES['imageToUpload']['error'][$i] == UPLOAD_ERR_OK) {
                $targetDir = $folderToDisplay . '/';
                $targetFile = $targetDir . basename($_FILES['imageToUpload']['name'][$i]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                $projectName = basename($folderToDisplay);  // Get the parent folder as the project name
                $filename = basename($_FILES['imageToUpload']['name'][$i]);

                // Check if the file is an image
                $check = getimagesize($_FILES['imageToUpload']['tmp_name'][$i]);
                if ($check !== false) {
                    // Check file size (limit to 5MB)
                    if ($_FILES['imageToUpload']['size'][$i] < 1000000000) {
                        // Allow only certain file formats
                        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                            // Check if file already exists
                            if (!file_exists($targetFile)) {
                                if (move_uploaded_file($_FILES['imageToUpload']['tmp_name'][$i], $targetFile)) {
                                    echo "The file " . htmlspecialchars($filename) . " has been uploaded.<br>";

                                    $relativeFilePath = '' . $targetFile;
                                    addImagePathToDatabase($projectName, $relativeFilePath, $filename);
                                    header("Refresh:0"); // You can refresh the page if needed
                                } else {
                                    echo "Sorry, there was an error uploading your file.<br>";
                                }
                            } else {
                                echo "Sorry, file " . $filename . " already exists.<br>";
                            }
                        } else {
                            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.<br>";
                        }
                    } else {
                        echo "Sorry, your file " . $filename . " is too large. Maximum size is 5MB.<br>";
                    }
                } else {
                    echo "File " . $filename . " is not an image.<br>";
                }
            } else {
                echo "Error uploading file " . $filename . ".<br>";
            }
        }
    } else {
        echo "No files selected. Please choose images to upload.<br>";
    }
}

    // Handle folder creation
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newFolderName'])) {
        $newFolderName = trim($_POST['newFolderName']);  // Get the folder name from the form input

        // Check if folder creation is happening inside the 'projects' root folder
        if ($folderToDisplay === 'projects') {
            // Check if folder name is valid and not empty
            if (!empty($newFolderName)) {
                // Define the new folder path
                $newFolderPath = $folderToDisplay . '/' . $newFolderName;

                // Check if the folder already exists
                if (!is_dir($newFolderPath)) {
                    // Attempt to create the folder
                    if (mkdir($newFolderPath)) {
                        echo "Folder '$newFolderName' created successfully.<br>";
                        header("Refresh:0");
                    } else {
                        echo "Error: Failed to create folder '$newFolderName'.<br>";
                    }
                } else {
                    echo "Error: Folder '$newFolderName' already exists.<br>";
                }
            } else {
                echo "Error: Please provide a valid folder name.<br>";
            }
        } else {
            echo "Error: You can only create folders in the root 'projects' folder.<br>";
        }
    }

    // Handle folder renaming
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['renameFolder'])) {
        $newFolderName = trim($_POST['newFolderName']);
        $oldFolderPath = $folderToDisplay;

        // Ensure the new folder name is not empty and valid
        if (!empty($newFolderName) && $newFolderName != basename($folderToDisplay)) {
            // Define the new folder path
            $newFolderPath = dirname($folderToDisplay) . '/' . $newFolderName;

            // Check if the folder already exists
            if (!is_dir($newFolderPath)) {
                // Attempt to rename the folder
                if (rename($folderToDisplay, $newFolderPath)) {
                    echo "Folder renamed to '$newFolderName' successfully.<br>";
                    header("Refresh:0");
                } else {
                    echo "Error: Failed to rename folder.<br>";
                }
            } else {
                echo "Error: A folder with the name '$newFolderName' already exists.<br>";
            }
        } else {
            echo "Error: Please provide a valid folder name or ensure it's different from the current name.<br>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>
<body>
    <h3>Upload an Image to this Folder</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="imageToUpload[]" multiple>
        <input type="submit" value="Upload Files" name="submit">
    </form>
    
    <?php
        // Back button logic
        if ($folderToDisplay != 'projects') {
            // Get the parent folder path
            $parentFolder = dirname($folderToDisplay);
            echo "<a href='?folder=" . urlencode($parentFolder) . "'>Back</a><br><br>";
        }   
    ?>

    <h3>Create a New Folder</h3>
    <?php if ($folderToDisplay === 'projects'): ?>
        <form action="" method="post">
            <input type="text" name="newFolderName" placeholder="Enter folder name" required>
            <input type="submit" value="Create Folder">
        </form>
    <?php else: ?>
        <p>You can only create folders in the root 'projects' folder.</p>
    <?php endif; ?>

    <h3>Rename Folder</h3>
    <?php if ($folderToDisplay != 'projects'): ?>
        <form action="" method="POST">
            <label for="newFolderName">New Folder Name:</label>
            <input type="text" name="newFolderName" placeholder="Enter new folder name" required>
            <input type="submit" value="Rename Folder" name="renameFolder">
        </form>
    <?php else: ?>
        <p>You cannot rename the main 'projects' folder.</p>
    <?php endif; ?>

</body>
</html>
