<?php
function renderFooter()
{
     echo '
    <style>
          #footer {
               margin: 0 auto;
               width: 100%;
               text-align: center;
               font-weight: lighter;
               font-size: 20px;
               margin-bottom: 40px;
               margin-top: 25px;
          }
          #footerWrapper{
               background-color: white;
               padding: 10px;
          }
          #footer a {
               text-decoration: none;
               color: rgb(70, 70, 70);
          }
          #links {
               margin-top: 25px;
          }
          #links a {
               line-height: 2;
               padding-right: 12px;
               padding-left: 12px;
          }
          #contacts {
               padding-top: 10px;
               font-size: 23px !important;
          }
          #contacts span{
               padding: 28px;
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
              <div id="contacts">
                   info@melie.com <span></span> +1 (123) 456-7890
              </div>
         </div>
    </div>
    ';
}
?>