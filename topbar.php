<?php
function renderHeader() {
    echo '
    <link rel="stylesheet" href="style.css">
    <div id="blur">
        <div class="head">
            <!-- <div id="logo"><img src="logo2.png" alt=""></div> -->
            <a href="./index.php" id="melie">MELIÉ</a>
        </div>
        <ul id="list">
            <li><a href="./aboutus.php">ABOUT US</a></li>
            <li><a href="./services.php">SERVICES</a></li>
            <li><a href="./projects.php">PROJECTS</a></li>
            <li><a href="./contacts.php">CONTACT US</a></li>
            <!-- <li><i class="fa-solid fa-language"></i></li> -->
        </ul>
        <div id="bar">
         <i class="fa-solid fa-bars"></i>
        </div>
    </div>';
}
?>