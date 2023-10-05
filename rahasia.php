<?php

session_start();

if($_SESSION['user_username'] == "") {
    header("location:login.php");
    exit();
}


?>


<?php include("config.php"); ?>
<?php include("func/getImage.php"); ?>


<!DOCTYPE html>
<html lang="en">
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiddev.</title>
    <link rel="stylesheet" href="resource/components/css/style.css">
</head>

<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href=''>Hiddev.</a></div>
            <div class="menu">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#tutors">Tutors</a></li>
                    <li><a href="#partners">Partners</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php if(isset($_SESSION['user_username'])) {
                        echo $_SESSION['user_username'] . " | " . "<a href='logout.php'>Logout</a>";
                    } else {?>
                            <li><a href="" class="tbl-biru">Sign Up</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <p><?php echo $_SESSION['user_username']?></p>
    
    
    <div id="copyright">
        <div class="wrapper">
            &copy; 2023. <b>Hiddev.</b> All Rights Reserved.
        </div>
    </div>

</body>
</html>
