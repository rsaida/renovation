<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="aboutus.js">
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* *{
            border: 1px solid black;
        } */
        #servicesDiv{
            display: flex;
            margin: auto;
            align-items: center;
            padding: 5%;
            gap: 5%;
            width: 80%;
            /* border: 1px solid red; */
        }
        #final {
            margin: auto;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            
        }
        #displayImage{
            width: 55%;
        }
        #servicesText{
            width: 40%;
            height: 100%;
            font-size: 20px;
            /* border: 1px solid green; */
        }
        img{
            width: 100%;
        }
        #mains{
            padding-top: 20px;
            /* background-color: rgba(140, 120, 90, 50%); */
            height: 100%;
        }
        body{
            background-color: rgba(140, 120, 90, 67%);

            /* background-color: rgba(0, 0, 0, 0.4); */
        }
        *{
            font-family: serif;
        }
        h1{
            margin-top: 0;
            /* border: 1px solid red; */
        }
        #viewProjects{
            width: 100%;
        }
        .button{
            padding: 2.5%;
            margin: 2% auto;
            background-color:rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 5px;
        }
        .button:hover{
            background-color:rgba(255, 255, 255, 0.1);
        }
        #contactDiv{
            width: 45%;
            margin: auto;
            /* border: 1px solid red; */
            align-items: center;
        }
        #contactDiv>h3{
            width: fit-content;
            margin: auto;
            font-size: 30px;
            padding-top: 4%;
        }
        #contactForm *{
            align-items: center;
            display: block;
        }

        .inputForm {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.4);
            padding: 2% 0 2% 2%;
            width: 98%;
            margin: 2% auto;
            font-size: 15px;
            color: white;
            transition: border-bottom-width 0.4s ease, border-bottom-color 0.4s ease;
        }

        .inputForm:hover {
            border-bottom-color: rgba(255, 255, 255, 0.9); 
        }

        
        #message{
            rows: 10;
            padding-bottom: 0;
        }
        ::placeholder{
            color: white;
            margin-bottom: 0;
        }
        #message::placeholder{
            align-self: bottom;
            text-align: bottom;
        }
        #submitBtn{
            margin-top: 3%;
            margin-bottom: 10%;
            width: 30%;
            background-color: none;
        }
    </style>
</head>
<body>
    <div id="mainss">
        <?php
            include 'topbar.php';
            renderHeader();
        ?>
    </div>
    <iframe
    src="https://g.co/kgs/vGrDyAQ"
    width="600"
    height="450"
    frameborder="0"
    style="border:0"
    allowfullscreen>
    </iframe>
</body>
</html>
