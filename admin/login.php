<?php include("../config.php");
session_start();

if ($_SESSION['admin_username'] != "") {
    header("location:index.php");
    exit();
}

?>
<?php include("../func/getImage.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login.</title>
    <link rel="stylesheet" href="../resource/components/css/register.css">
</head>

<?php

$username = "";
$err = "";
$sukses = "";
$password = "";

if (isset($_POST['submit'])) {

    if (!isset($_POST['username']) or !isset($_POST['password'])) {
        $username = "";
        $err = "";
        $sukses = "";
        $password = "";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }



    if ($username == "" or $password == "") {
        $err = "<p>Silahkan masukkan semua isian</p>";
    }

    if ($username != "" && $password != "") {
        $query = "SELECT * from admin where username='$username'";
        $sql = mysqli_query($db, $query);
        $r1 = mysqli_fetch_array($sql);
        $count = mysqli_num_rows($sql);


        if ($count < 1) {
            $err = "<p>username yang kamu miliki belum aktif</p>";
        } elseif ($r1['password'] != md5($password)) {
            $err = "Password tidak sesuai";
        } else {
            $_SESSION['admin_username'] = $username;
            header("location:index.php");
            exit();
        }
    }
}

?>



<div class="container">
    <div class="left">
        <img src="../resource/img/15581993_5643241.jpg" alt="flat">
    </div>
    <div class="right">
        <div class="form-wrapper">
            <form action="" method="POST">
                <h1>Login Admin.</h1>
                <?php if ($err) {
                    echo "<div class='error'><p>$err</p></div>";
                } ?>
                <?php if ($sukses) {
                    echo "<div class='sukses'>$sukses</div>";
                } ?>
                <label for="username">
                    <input type="username" placeholder="Username" name="username">
                </label><br>
                <label for="password">
                    <input type="password" placeholder="Password" name="password">
                </label><br>
                <div class="btn-register-wrapper">
                    <button type="submit" class="btn-login-admin" name="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>