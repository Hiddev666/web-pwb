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
$email = "";

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    if($email == '') {
        $err = "Silahkan masukkan email";
    } else {
        $sql1 = "SELECT * FROM users where email='$email'";
        $q1 = mysqli_query($db, $sql1);
        $n1 = mysqli_num_rows($q1);

        if($n1 < 1) {
            $err = "Email: <b>$email</b> tidak ditemukan";
        }
    }


    if(empty($err)) {
        $token_ganti_password = md5(rand(0, 1000));
        $judul_email = "Ganti Password";
        $isi_email = "Seseorang memminta untuk melakukan perubahan password, jika anda setuju silahkan klik link di bawah ini : ";
        $isi_email .= "/ganti_password.php?email=$email&token=$token_ganti_password";
        send_email($email, $email, $judul_email, $isi_email);

        $sql2 = "UPDATE users SET token_ganti_password='$token_ganti_password' where email='$email'";
        mysqli_query($db, $sql2);
        $sukses = "Link ganti password sudah dikirim ke email anda";

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
                <h1>Forgot Password.</h1>
                <?php if ($err) {
                    echo "<div class='error'><p>$err</p></div>";
                } ?>
                <?php if ($sukses) {
                    echo "<div class='sukses'>$sukses</div>";
                } ?>
                <label for="email">
                    <input type="email" placeholder="Email" name="email">
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