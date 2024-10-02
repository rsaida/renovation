
<?php 
    //  $folder = "./projects/qwe";    
    //  mkdir ($folder, 0755);     
?>

<?php

require_once "db.php";
// Function to display folder contents
function displayFolderContents($folderPath) {
    // Check if the folder exists
    if (is_dir($folderPath)) {
        // Scan the folder
        $contents = scandir($folderPath);

        // Loop through the contents
        foreach ($contents as $item) {
            // Exclude the current (.) and parent (..) directories
            if ($item != '.' && $item != '..') {
                // Full path to the item
                $fullPath = $folderPath . '/' . $item;

                // If it's a folder, display it as a link
                if (is_dir($fullPath)) {
                    echo "<strong><a href='?folder=" . urlencode($fullPath) . "'>Folder: $item</a></strong><br>";
                } else {
                    // If it's a file, just display the file name
                    echo "File: $item<br>";
                }
            }
        }
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
    // Check if a file was selected for upload
    if (isset($_FILES['imageToUpload']) && $_FILES['imageToUpload']['error'] != UPLOAD_ERR_NO_FILE) {
        $targetDir = $folderToDisplay . '/';
        $targetFile = $targetDir . basename($_FILES['imageToUpload']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $projectName = basename($folderToDisplay);  // Correctly identifies the parent folder as the project name

        // Check if the file is an actual image
        $check = getimagesize($_FILES['imageToUpload']['tmp_name']);
        if ($check !== false) {
            // Check file size (limit to 5MB)
            if ($_FILES['imageToUpload']['size'] < 5000000) {
                // Allow only certain file formats
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Check if file already exists
                    if (!file_exists($targetFile)) {
                        if (move_uploaded_file($_FILES['imageToUpload']['tmp_name'], $targetFile)) {
                            echo "The file " . htmlspecialchars(basename($_FILES['imageToUpload']['name'])) . " has been uploaded.<br>";
                            
                           
                            $relativeFilePath = './' . $targetFile;
                            echo $projectName;
                            addImagePathToDatabase($projectName, $relativeFilePath);

                        
                        } else {
                            echo "Sorry, there was an error uploading your file.<br>";
                        }
                    } else {
                        echo "Sorry, file already exists.<br>";
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.<br>";
                }
            } else {
                echo "Sorry, your file is too large. Maximum size is 5MB.<br>";
            }
        } else {
            echo "File is not an image.<br>";
        }
    } else {
        // Error message when no file is selected
        echo "No file selected. Please choose an image to upload.<br>";
    }
}

// Handle folder creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newFolderName'])) {
    $newFolderName = trim($_POST['newFolderName']);  // Get the folder name from the form input

    // Check if folder name is valid and not empty
    if (!empty($newFolderName)) {
        // Define the new folder path
        $newFolderPath = $folderToDisplay . '/' . $newFolderName;

        // Check if the folder already exists
        if (!is_dir($newFolderPath)) {
            // Attempt to create the folder
            if (mkdir($newFolderPath)) {
                echo "Folder '$newFolderName' created successfully.<br>";
                header("Location: edit.php");
                exit;
            } else {
                echo "Error: Failed to create folder '$newFolderName'.<br>";
            }
        } else {
            echo "Error: Folder '$newFolderName' already exists.<br>";
        }
    } else {
        echo "Error: Please provide a valid folder name.<br>";
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
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="imageToUpload" id="imageToUpload" accept="image/*">
        <input type="submit" value="Upload Image" name="submit">
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
    <form action="" method="post">
        <input type="text" name="newFolderName" placeholder="Enter folder name" required>
        <input type="submit" value="Create Folder">
    </form>
</body>
</html>