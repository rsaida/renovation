<?php 
function renderHeader() { 
    echo ' 
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
   
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

    /* Keep top bar fixed and above everything */ 
    #blur { 
        position: fixed;
        top: 0;
        left: 0;
        z-index: 99; 
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(228, 224, 219, 1); /* Match contactDivWrapper */
        backdrop-filter: blur(8px);
        width: 100%;
        margin: auto;
        height: 80px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    } 
    
    /* Add padding to body to prevent content from hiding under fixed header */
    body {
        padding-top: 80px;
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
        position: fixed;
        top: 80px;
        left: 50%;
        transform: translateX(-50%);
        width: 100%; 
        background-color: rgba(228, 224, 219, 0.95); /* Match theme */
        backdrop-filter: blur(8px);
        list-style: none;  
        padding: 10px 0;  
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
        padding: 25px 0;  
        border-bottom: 1px solid rgba(70, 70, 70, 0.2);  /* Updated border color */
        width: 100%; /* Ensures full width */
    }

    #dropdown-menu li:last-child {  
        border-bottom: none;  
    }

    #dropdown-menu a {  
        color: rgb(70, 70, 70); /* Match theme */
        text-decoration: none;  
        font-size: 16px;  
        display: block;  
        width: 100%;  
        text-align: center; /* Centers text inside each item */
    }
    
    /* Update links in top bar to match theme */
    #list-left a, #list-right a, #melie {
        color: rgb(70, 70, 70);
    }
    
    .split-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        flex: 1;
    }
    
    #list-left {
        justify-content: flex-end;
        margin-right: 30px;
        width: 33%;
    }
    
    #list-right {
        justify-content: flex-start;
        margin-left: 30px;
        width: 33%;
    }
    
    .head {
        flex: 0 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 14%;
        text-align: center;
    }
    
    #melie {
        font-size: 35px;
        height: fit-content;
        margin: 0 auto;
        font-weight: normal;
        font-family: "Kalnia";
        display: block;
        text-align: center;
    }
    
    #bar {
        color: rgb(70, 70, 70); /* Match theme */
        cursor: pointer;
    }
    
    /* Media query for mobile devices */
    @media (max-width: 768px) {
        #list-left, #list-right {
            display: none; /* Hide the top menu on mobile */
        }
        
        .head {
            width: 80%; /* Make logo take more space */
        }
        
        #bar {
            display: block;
            position: absolute;
            right: 20px;
        }
    }
    
    /* Media query for desktop */
    @media (min-width: 769px) {
        #bar {
            display: none; /* Hide the hamburger menu on desktop */
        }
    }
    </style> 

    <div id="blur-overlay"></div> 
    <!-- Blurred overlay (behind top bar) --> 

    <div id="blur"> 
        <ul id="list-left" class="split-menu"> 
            <li><a href="./aboutus.php">ABOUT US</a></li> 
            <li><a href="./services.php">SERVICES</a></li> 
        </ul>
        <div class="head"> 
            <a href="./index.php" id="melie">MELIÉ</a> 
        </div> 
        <ul id="list-right" class="split-menu"> 
            <li><a href="./projects.php">CATALOGUE</a></li> 
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
        <li><a href="./projects.php">CATALOGUE</a></li>
        <li><a href="./contacts.php">CONTACT US</a></li>
    </ul>
    '; 
} 
?>