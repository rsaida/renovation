<?php 
     function renderFooter() {
          echo '
          <style>
               #footer {
                    margin: 0 auto;
                    width: 700px;
                    text-align: center;
                    font-weight: lighter;
                    font-size: 20px;
                    margin-bottom: 40px;
                    margin-top: 25px;
               }
               #footerWrapper{
                    background-color:white;padding:10px;
               }
               #footer a {
                    text-decoration: none;
                    color: rgb(70, 70, 70);
                    margin-right: 25px;
               }
               #melie {
                    font-size: 35px;
                    height: fit-content;
                    margin: auto;
                    /* color: white; */
                    font-weight: normal;
                    font-family: "Kalnia";
               }
               #links {
                    margin-top: 25px;
               }
          </style>
          <div id="footerWrapper">
               <div id="footer">
                    <a href="./index.php" id="melie">MELIÉ</a>
                    <div id="links">
                         <a href="index.php">HOME</a>
                         <a href="aboutus.php">ABOUT US</a>
                         <a href="services.php">SERVICES</a>
                         <a href="projects.php">PROJECTS</a>
                         <a href="contacts.php">CONTACT US</a>
                    </div>
               </div>
          </div>
          
          ';
     }
?>