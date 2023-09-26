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
function createPasUrl($id) {
    include("config.php");
    
    $sql = "SELECT * FROM tutors where id='$id'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $nama = clearUrl($arr['nama']);

    echo getRealUri() . "/tutors_pages.php/$id/$nama";
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
function getTutorsIsi($id) {
    include("config.php");
    
    $sql = "SELECT * FROM tutors where id='$id'";
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

?>