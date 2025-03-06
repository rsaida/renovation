<?php 
function renderHeader() { 
    echo ' 
    <link rel="stylesheet" href="style.css"> 
    <script> 
    document.addEventListener("DOMContentLoaded", function() { 
        const bar = document.getElementById("bar"); 
        const icon = bar.querySelector("i"); 
        const overlay = document.getElementById("blur-overlay"); 
        const dropdown = document.getElementById("dropdown-menu"); 

        bar.addEventListener("click", function(event) { 
            event.stopPropagation(); // Prevents closing immediately
            overlay.classList.toggle("active"); 
            dropdown.classList.toggle("active"); 

            if (icon.classList.contains("fa-bars")) { 
                icon.classList.remove("fa-bars"); 
                icon.classList.add("fa-times"); 
            } else { 
                icon.classList.remove("fa-times"); 
                icon.classList.add("fa-bars"); 
            } 
        }); 

        // Close menu when clicking outside
        document.addEventListener("click", function(event) {
            if (!dropdown.contains(event.target) && !bar.contains(event.target)) { 
                overlay.classList.remove("active"); 
                dropdown.classList.remove("active"); 
                icon.classList.remove("fa-times"); 
                icon.classList.add("fa-bars"); 
            }
        });
    }); 
    </script> 

    <style> 
    /* Full-screen blur overlay */ 
    #blur-overlay { 
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        background-color: rgba(0, 0, 0, 0.2); 
        backdrop-filter: blur(8px); 
        visibility: hidden; 
        opacity: 0; 
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out; 
        z-index: 98; 
    } 

    #blur-overlay.active { 
        visibility: visible; 
        opacity: 1; 
    } 

    /* Keep top bar above everything */ 
    #blur { 
        position: relative; 
        z-index: 99; 
    } 

    /* Bar Icon Transition */ 
    #bar i { 
        transition: transform 0.2s ease-in-out; 
    } 

    .fa-times { 
        transform: scale(1.1); 
    } 

    /* Dropdown Menu Styling */
    #dropdown-menu { 
        position: absolute;  
        left: 50%;
        transform: translateX(-50%);
        width: 90%; 
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        list-style: none;  
        padding: 10px 0;  
        border-radius: 10px;  
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);  
        z-index: 98;  
        display: flex;  
        flex-direction: column; /* Ensures vertical layout */
        align-items: center; /* Centers the text */
        opacity: 0;  /* Initially hidden */
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }

    #dropdown-menu.active {
        opacity: 1;
        visibility: visible;
    }

    #dropdown-menu li {  
        text-align: center;  
        padding: 15px 0;  
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);  
        width: 100%; /* Ensures full width */
    }

    #dropdown-menu li:last-child {  
        border-bottom: none;  
    }

    #dropdown-menu a {  
        color: white;
        text-decoration: none;  
        font-size: 16px;  
        display: block;  
        width: 100%;  
        text-align: center; /* Centers text inside each item */
    }
    </style> 

    <div id="blur-overlay"></div> 
    <!-- Blurred overlay (behind top bar) --> 

    <div id="blur"> 
        <div class="head"> 
            <a href="./index.php" id="melie">MELIÉ</a> 
        </div> 
        <ul id="list"> 
            <li><a href="./aboutus.php">ABOUT US</a></li> 
            <li><a href="./services.php">SERVICES</a></li> 
            <li><a href="./projects.php">PROJECTS</a></li> 
            <li><a href="./contacts.php">CONTACT US</a></li> 
        </ul> 
        <div id="bar"> 
            <i class="fa-solid fa-bars"></i> 
        </div> 
    </div> 

    <!-- Dropdown Menu -->
    <ul id="dropdown-menu">
        <li><a href="./aboutus.php">ABOUT US</a></li>
        <li><a href="./services.php">SERVICES</a></li>
        <li><a href="./projects.php">PROJECTS</a></li>
        <li><a href="./contacts.php">CONTACT US</a></li>
    </ul>
    '; 
} 
?>
