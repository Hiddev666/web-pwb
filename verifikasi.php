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
                    <li><a href="" class="tbl-biru">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    $err = "";
    $sukses = "";

    if(!isset($_GET['email']) or !isset($_GET['kode'])) {
        $err = "Data yang perlu dimasukkan untuk verifikasi tidak tersedia";
    } else {
        $email = $_GET['email'];
        $kode = $_GET['kode'];
    
        $sql1 = "SELECT * FROM users where email='$email'";
        $q1 = mysqli_query($db, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if($r1['status'] == $kode) {
            $sql2 = "UPDATE users SET status='1' where email='$email'";
            mysqli_query($db, $sql2);
            $sukses = "Akun telah aktif. Silahkan login!";
        } else {
            $err = "Kode tidak valid";
        }
    }
    
    
    ?>


    <?php if($err) {echo $err;}?>
    <?php if($sukses) {echo $sukses;}?>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2023. <b>Hiddev.</b> All Rights Reserved.
        </div>
    </div>

</body>
</html>
