<?php include("config.php"); 

session_start();

if(isset($_SESSION['user_username'])) {
    
    if($_SESSION['user_username'] != "") {
        header("location:index.php");
        exit();
    }
}

?>
<?php include("func/getImage.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiddev.</title>
    <link rel="stylesheet" href="resource/components/css/register.css">
</head>

<?php
$username = "";
$email = "";
$err = "";
$sukses = "";
$password = "";
$confirm = "";

if(isset($_POST['submit'])) {

        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
    
    
    if($email == "" or $username == "" or $password == "" or $confirm == "") {
        $err = "<p>Silahkan masukkan semua isian</p>";
    }
    
    if($email != "") {
        $query = "SELECT email from users where email='$email'";
        $sql = mysqli_query($db, $query);
        $count = mysqli_num_rows($sql);
        if($count > 0) {
            $err = "<p>Email yang kamu masukkan sudah terdaftar</p>";
        }
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = "<p>Email yang kamu masukkan tidak valid</p>";
        }
    }
    
    if($password != $confirm) {
        $err = "<p>Password dan konfirmais tidak sesuai</p>";
    }
    
    if(empty($err)) {
        $status = md5(rand(0, 1000));

        $judul = "Halaman   Konfirmasi Pendaftaran"; 
        $isi = "Akun yang kamu miliki dengan email <b>$email</b> telah siap digunakan <br/>>";
        $isi .= "Sebelumnya silahkan melakukan aktivasi email di link di bawha ini: <br/>";
        $isi .= getRealUri() . "/verifikasi.php?email=$email&kode=$status";

        send_email($email, $username, $judul, $isi);
        $hash = md5($password);
        $sql1 = "INSERT INTO users (username, email, password, status) values ('$username', '$email', '$hash', '$status')";
        $q1 = mysqli_query($db, $sql1);

        if($q1) {
            $sukses = "Proses Berhasil, silahkan cek email kamu untuk verifikasi";
        }

        $sukses = "Success";
    }
}


?>

<?php if($err) {echo "<div class='error'>$err</div>";}?>
<?php if($sukses) {echo "<div class='sukses'>$sukses</div>";}?>

    <div class="container">
        <div class="left">
            <img src="resource/img/7118756_3426526.jpg" alt="flat">
        </div>
        <div class="right">
            <div class="form-wrapper">
                <form action="" method="POST">
                        <h1>Register.</h1>
                    <label for="username">
                        <input type="text" placeholder="Username" name="username">
                    </label><br>
                    <label for="email">
                        <input type="email" placeholder="Email" name="email">
                    </label><br>
                    <label for="password">
                        <input type="password" placeholder="Password" name="password">
                    </label><br>
                    <label for="confirm">
                        <input type="password" placeholder="Confirm Password" name="confirm">
                    </label><br>
                    <div class="btn-register-wrapper">
                        <button type="submit" class="btn-register" name="submit">Register</button>
                        <p>Have a Account? <a href="">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>