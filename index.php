<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Web Page</title>
    <script src="script.js">
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #fon2{
            background-size: cover;
            line-height: 600px;
            font-size: 80px;
            text-align: center;
            height: 600px;
        }
        body{
            background-color: rgba(0, 0, 0, 0.9);
        }
    </style>
</head>
<body>
    <div id="main">
        <?php
            include 'topbar.php';
            renderHeader();
        ?>
        <div id="fon">
        </div>
    </div>
        <div id="indicators">
            <div class="indicator" data-index="0"></div>
            <div class="indicator" data-index="1"></div>
            <div class="indicator" data-index="2"></div>
            <div class="indicator" data-index="3"></div>
        </div>  
    <div id="lang">
            <img src="globe.png" alt="">
    </div>
    
</body>
</html>
