<?php
function renderHeader() {
    echo '
    <div id="blur">
        <div class="head">
            <!-- <div id="logo"><img src="logo2.png" alt=""></div> -->
            <a href="./index.php" id="melie">MELIÉ</a>
        </div>
        <ul>
            <!-- <li id="lang"><img src="globe.png" alt="">EN</li> -->
            <li><a href="./aboutus.php">About us</a></li>
            <li><a href="./services.php">Services</a></li>
            <li><a href="./projects.php">Projects</a></li>
            <li><a href="./contacts.php">Contact us</a></li>
            <!-- <li><i class="fa-solid fa-language"></i></li> -->
        </ul>
        <div id="bar">
         <i class="fa-solid fa-bars"></i>
        </div>
    </div>';
}
?>