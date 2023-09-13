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
    $arr = mysqli_fetch_assoc($query);
    $text = strip_tags($arr['isi']);

    echo $text;
}

?>