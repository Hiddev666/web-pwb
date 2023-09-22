<?php
include("config.php");
include("func/getImage.php");
$id = getId();
$page = $_GET['page'];
?>

<?php include("resource/components/header.php");?>

    <div style="padding: 3%; padding-left: 10%;">
        <div>
                <img src="<?php 
                
                if(isset($page == 'tutors')) {
                    getTutorsPicture($id);
                } else {
                    getImage($id);
                } ?>
                " alt="img">
                
        </div>
        <p class="deskripsi"><?php getKutipan($id) ?></p>
        <h1><?php getJudul($id)?></h1>
        <?php echo getIsi($id)?>
    </div>


<?php include("resource/components/footer.php");?>
