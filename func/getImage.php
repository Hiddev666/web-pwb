<?php


function getImage($id_tulisan) {
    include("config.php");

    $sql = "SELECT * FROM halaman where id='$id_tulisan'";
    $query = mysqli_query($db, $sql);
    $arr = mysqli_fetch_assoc($query);
    $text = $arr['isi'];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $gambar = $img[1];

    echo $gambar;


}

?>