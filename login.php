<?php include("config.php"); 
session_start();
?>
<?php include("func/getImage.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login.</title>
    <link rel="stylesheet" href="resource/components/css/register.css">
</head>

<?php

$email = "";
$err = "";
$sukses = "";
$password = "";

if (isset($_POST['submit'])) {

    if (!isset($_POST['email']) or !isset($_POST['password'])) {
        $email = "";
        $err = "";
        $sukses = "";
        $password = "";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
    }



    if ($email == "" or $password == "") {
        $err = "<p>Silahkan masukkan semua isian</p>";
    }

    if ($email != "" && $password != "") {
        $query = "SELECT * from users where email='$email'";
        $sql = mysqli_query($db, $query);
        $r1 = mysqli_fetch_array($sql);
        $count = mysqli_num_rows($sql);


        if ($r1['status'] != '1' && $count > 0) {
            $err = "<p>Email yang kamu miliki belum aktif</p>";
        }

        if ($r1['password'] != md5($password) && $count > 0 && $r1['status'] == '1') {
            $err = "Password tidak sesuai";
        }

        if ($count < 1) {
            $err = "Akun tidak ditemukan";
        }

        if (empty($err)) {
            $_SESSION['user_username'] = $r1['username'];
            $_SESSION['user_email'] = $r1['email'];
            header("location:rahasia.php");
            exit();
        }
    }
}

?>

<div class="container">
    <div class="left">
        <img src="resource/img/11435030_4706239.jpg" alt="flat">
    </div>
    <div class="right">
        <div class="form-wrapper">
            <form action="" method="POST">
                <h1>Login.</h1>
                <?php if ($err) {
                    echo "<div class='error'><p>$err</p></div>";
                } ?>
                <?php if ($sukses) {
                    echo "<div class='sukses'>$sukses</div>";
                } ?>
                <label for="email">
                    <input type="email" placeholder="Email" name="email">
                </label><br>
                <label for="password">
                    <input type="password" placeholder="Password" name="password">
                </label><br>
                <div class="btn-register-wrapper">
                    <button type="submit" class="btn-login" name="submit">Login</button>
                    <p>Don't have a Account? <a href="">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>