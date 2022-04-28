<?php
session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/global.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

        .header{
            background-color: #fbd989;
        }

        .header-wrapper{
            display: flex;
            height:15vh;
            width: min(90%,1400px);
            margin: 0 auto;
            justify-content: space-between;
            align-items: center;
        }

        nav{
            display: flex;
            gap: 2rem;
        }

        nav a{
            text-decoration: none;
        }


    </style>
</head>
<body>
    
    <header class="header">
        <div class="header-wrapper">
            <h1>Logo Mo To</h1>

            <nav>
                <a href="">Home</a>
                <a href="">Services</a>
                <a href="">Contact</a>

                <?php 
                    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                    ?>
                        <a href=""><?php echo $_SESSION['username']?></a>
                        <a href="logout.php">Logout</a>
                <?php
                    }
                    else{
                ?>
                        <a href="login.php">Login</a>
                        <a href="registration.php">Signup</a>
                <?php
                    }
                ?>

            </nav>
        </div>
    </header>
    
    
</body>
</html>

