<?php
include("config.php");
include("func/getImage.php");
$id = getId();
$page = $_GET['page'];
?>

<?php include("resource/components/header.php");?>
    <div class="container" style="padding: 3%; padding-left: 10%; display: flex;">
        <div class="left" style="width: 20%; display: flex; justify-content: center; align-items: top;">
            <img src="<?php echo getRealUri() . '/resource/uploaded/'. getPartnersPicture($id)?>" style="max-width: 200px; max-height: 200px;border-radius: 100%;"/>
        </div>
        <div class="right" style="width: 80%;">
            <h1 style="color: black;"><?php echo getPartnersName($id)?></h1>
            <p><?php echo getPartnersIsi($id)?></p>
        </div>
    </div>

<?php include("resource/components/footer.php");?>
