<?php
include("config.php");
include("func/getImage.php");
$id = getId();
?>

<?php include("resource/components/header.php");?>

    <div style="padding: 3%; padding-left: 10%;">
        <p class="deskripsi"><?php getKutipan($id) ?></p>
        <h1><?php getJudul($id)?></h1>
        <?php getIsi($id)?>
        <div>
                <img src="<?php getImage($id)?>" alt="img">
    
        </div>
    </div>


<?php include("resource/components/footer.php");?>
