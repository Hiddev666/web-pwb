<?php include("../config.php");


session_start();

if ($_SESSION['admin_username'] == '') {
    header("location:login.php");
    exit();
}
?>
<?php include("../func/getImage.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiddev.</title>
    <link rel="stylesheet" href="../resource/components/css/style.css">
    <link rel="stylesheet" href="../resource/components/css/register.css">
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
                    <?php if (isset($_SESSION['user_username'])) {
                        echo $_SESSION['user_username'] . " | " . "<a href='logout.php'>Logout</a>";
                    } else { ?>
                        <li><a href="#contact">Contact</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>


    <?php

    $password_lama = "";
    $password_baru = "";
    $konfirmasi_password_baru = "";
    $err = "";
    $sukses = "";

    if (isset($_POST['submit'])) {

        $password_lama = "";
        $password_baru = "";
        $konfirmasi_password_baru = "";

        $password_lama = $_POST['password_lama'];
        $password_baru = $_POST['password_baru'];
        $konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];

        $query = "SELECT * FROM admin where username='" . $_SESSION['admin_username'] . "'";
        $sql = mysqli_query($db, $query);
        $r1 = mysqli_fetch_array($sql);

        if ($password_baru == '' or $password_lama == '' or $konfirmasi_password_baru == '') {
            $err = "<p>Silahkan masukkan password baru, password lama, dan konfirmasi password</p>";
        }

        if ($password_baru != $konfirmasi_password_baru) {
            $err = "<p>Konfirmasi password tidak sesuai</p>";
        }
        if (empty($err)) {
            $hash = md5($password_baru);
            $query = "UPDATE admin set password='$hash' where username='" . $_SESSION['admin_username'] . "'";
            $sql = mysqli_query($db, $query);
            $sukses = "Data berhasil diubah";
        }
    }


    ?>

    <div class="container">
        <div class="left">
            <img src="../resource/img/9936449_4320850.jpg" alt="flat">
        </div>
        <div class="right">
            <div class="form-wrapper">
                <form action="" method="POST">
                    <h1>Ganti Password Admin.</h1>
                    <?php if ($err) {
                        echo "<div class='error'><p>$err</p></div>";
                    } ?>
                    <?php if ($sukses) {
                        echo "<div class='sukses'><p>$sukses</p></div>";
                    } ?>
                    <label for="password">
                        <input type="password" placeholder="Password Lama" name="password_lama">
                    </label><br>
                    <label for="username">
                        <input type="password" placeholder="Password Baru" name="password_baru">
                    </label><br>
                    <label for="username">
                        <input type="password" placeholder="Konfirmasi Password Baru" name="konfirmasi_password_baru">
                    </label><br>
                    <div class="btn-register-wrapper">
                        <button type="submit" class="btn-login-admin" name="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="copyright">
        <div class="wrapper">
            &copy; 2023. <b>Hiddev.</b> All Rights Reserved.
        </div>
    </div>

</body>

</html>