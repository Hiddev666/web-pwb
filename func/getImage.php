<?php

function getRealUri() {
    echo 'http://' . $_SERVER["SERVER_NAME"] . dirname($_SERVER['SCRIPT_NAME']);
}

function getImage($id_tulisan) {
    include("config.php");

    $sql = "SELECT * FROM halaman where id='$id_tulisan'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $text = $arr['isi'];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $gambar = $img[1];
    $gambar = str_replace("../resource/uploaded/", "/resource/uploaded/", $gambar);

    echo getRealUri() . $gambar;
}

function getTutorsPicture($id) {
    include("config.php");
    
    $sql = "SELECT * FROM tutors where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['foto'];

    if($foto){
        return $foto;
    } else {
        return "../img/blank-profile-picture-973460_960_720.webp";
    }
}
function getPartnersPicture($id) {
    include("config.php");
    
    $sql = "SELECT * FROM partners where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['foto'];

    if($foto){
        return $foto;
    } else {
        return "../img/blank-profile-picture-973460_960_720.webp";
    }
}

function getKutipan($id_tulisan) {
    include("config.php");
    
    $sql = "SELECT * FROM halaman where id='$id_tulisan'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $text = $arr['kutipan'];

    echo $text;
}

function getJudul($id_tulisan) {
    include("config.php");
    
    $sql = "SELECT * FROM halaman where id='$id_tulisan'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $text = $arr['judul'];

    echo $text;
}
function getIsi($id_tulisan) {
    include("config.php");
    

    $sql = "SELECT * FROM halaman where id='$id_tulisan'";
    $query = mysqli_query($db, $sql);
    if($query) {
        $arr = mysqli_fetch_assoc($query);
        $text = strip_tags($arr['isi']);
    }

    return $text;
}

function clearUrl($judul) {
    $lower = strtolower($judul);
    $stripped = str_replace(' ', '-', $lower);
    return $stripped;
}

function createUrl($id_tulisan) {
    include("config.php");
    
    $sql = "SELECT * FROM halaman where id='$id_tulisan'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $judul = clearUrl($arr['judul']);

    echo getRealUri() . "/pages.php/$id_tulisan/$judul";
}

function createTutorsUrl($id) {
    include("config.php");
    
    $sql = "SELECT * FROM tutors where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $nama = clearUrl($arr['nama']);

    echo getRealUri() . "/tutors_pages.php/$id/$nama";
}
function createPartnersUrl($id) {
    include("config.php");
    
    $sql = "SELECT * FROM partners where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $nama = clearUrl($arr['nama']);

    echo getRealUri() . "/partners_pages.php/$id/$nama";
}

function getId() {
    $id = "";
    if(isset($_SERVER['PATH_INFO'])) {
        $id = dirname($_SERVER['PATH_INFO']);
        $id = preg_replace("/[^0-9]/", "", $id);
    }
    return $id;
}

function maxText(string $isi, int $max) {
    $arr = explode(" ", $isi);
    $arr = array_slice($arr, 0, $max);
    $asd = implode(" ", $arr);

    return $asd;
}

function getTutorsImage($id) {
    include("../config.php");
    
    $sql = "SELECT * FROM tutors where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['foto'];

    if($foto){
        return $foto;
    } else {
        return "../img/blank-profile-picture-973460_960_720.webp";
    }
}

function getTutorsName($id) {
    include("config.php");
    
    $sql = "SELECT * FROM tutors where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['nama'];

    return $foto;
}
function getPartnersName($id) {
    include("config.php");
    
    $sql = "SELECT * FROM partners where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['nama'];

    return $foto;
}

function getTutorsIsi($id) {
    include("config.php");
    
    $sql = "SELECT * FROM tutors where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['isi'];

    return $foto;
}
function getPartnersIsi($id) {
    include("config.php");
    
    $sql = "SELECT * FROM partners where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['isi'];

    return $foto;
}

function getPartnersImage($id) {
    include("../config.php");
    
    $sql = "SELECT * FROM partners where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $foto = $arr['foto'];

    if($foto){
        return $foto;
    } else {
        return "../img/blank-profile-picture-973460_960_720.webp";
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_email($email_penerima, $nama_penerima, $judul_email, $isi_email) {

$env = parse_ini_file(".env");

    
$email_pengirim = "officehiddev@gmail.com";
$nama_pengirim = "noreply";

//Load Composer's autoloader
require getcwd(). '/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'officehiddev@gmail.com';                     //SMTP username
    $mail->Password   = 'vpho mwxa whvr mzmd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email_pengirim, $nama_pengirim);
    $mail->addAddress($email_penerima, $email_penerima);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $judul_email;
    $mail->Body    = $isi_email;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Success';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>