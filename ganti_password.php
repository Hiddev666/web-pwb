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

if(isset($_SESSION['user_email']) == '') {
    header("location:index.php");
}

$err = "";
$sukses = "";

if(isset($_GET['email'])) {
    
    $email = $_GET['email'];
    $token = $_GET['token'];

} else {
    $email = "";
    $token = "";

}


if($token == '' or $email == '') {
    $err = "Link tidak valid. Email dan Token tidak tersedia";
} else {
    $sql1 = "SELECT * FROM users where email='$email' and token_ganti_password='$token'";
    $q1 = mysqli_query($db, $sql1);
    $n1 = mysqli_num_rows($q1);

    if($n1 < 1) {
        $err = "Link tidak valid. Email dan token tidak sesuai";
    }
}

if(isset($_POST['submit'])) {
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if($password == '' or $konfirmasi_password == '') {
        $err = "Silahkan masukkan password dan konfirmasi password";
    } elseif ($konfirmasi_password != $password) {
        $err = "Konfirmasi Password tidak sesuai dengan password";
    }

    if(empty($err)) {
        $hash = md5($password);
        $login_url = getRealUri() . "/login.php";
        $sql2 = "UPDATE users SET token_ganti_password='', password='$hash' where email='$email'";
        mysqli_query($db, $sql2);
        $sukses = "Password berhasil diganti. Silahkan <a href='$login_url'>Login</a>";
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
                <h1>Change Password.</h1>
                <?php if ($err) {
                    echo "<div class='error'><p>$err</p></div>";
                } ?>
                <?php if ($sukses) {
                    echo "<div class='sukses'>$sukses</div>";
                } ?>
                <label for="password">
                    <input type="password" placeholder="Password" name="password">
                </label><br>
                <label for="konfirmasi_password">
                    <input type="password" placeholder="Konfirmasi Password" name="konfirmasi_password">
                </label><br>
                <div class="btn-register-wrapper">
                    <button type="submit" class="btn-login" name="submit">Forgot Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>