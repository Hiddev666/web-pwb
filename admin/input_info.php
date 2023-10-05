<?php
include("../config.php");
?>

<!-- Header -->
<?php include("../resource/components/admin/header.php") ?>
<div class="container p-4">

    <?php

    (isset($_GET['operation'])?$btn_type = "Update":$btn_type = "Insert"); 

    $judul = "";
    $kutipan = "";
    $isi = "";
    $error = "";
    $id = "";
    $success = "";

    if (isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $id = $_GET['id'];


        if ($judul == "" or $isi == "") {
            $error = "Data belum dimasukkan dengan benar!";
        } else {

            if (isset($_GET['operation'])) {
                $query = "UPDATE info SET judul='$judul', isi='$isi' where id='$id'";
                $goquery = mysqli_query($db, $query);

                if ($goquery) {
                    $success = "Data berhasil diubah!";
                } else {
                    $success = "Data gagal diubah!";
                }
            } else {
                $query = "INSERT INTO info(judul, isi) values ('$judul', '$isi')";
                $goquery = mysqli_query($db, $query);
    
                if ($goquery) {
                    $success = "Data berhasil dimasukkan!";
                } else {
                    $success = "Data gagal dimasukkan!";
                }
            }

        }

        


    }

    ?>

    <?php

    if ($error) { ?>

        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>

    <?php } elseif ($success) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php } ?>




    <!-- Content -->
    <h1>Admin Page | Input Info</h1>
    <div class="mb-3 row">
        <a href="index.php" class="link-underline link-underline-opacity-0">
            < Back to Admin Page</a>

                <form action="" method="POST">
                    <form>
                        <?php if (isset($_GET['operation'])) {
                            $id = $_GET['id'];
                            $query = "SELECT * FROM info where id='$id'";
                            $sql = mysqli_query($db, $query);

                            $data = mysqli_fetch_array($sql);
                            $judul = $data['judul'];
                            $isi = $data['isi'];

                            
                        }
                        ?>
                        <div class="mb-3 row">
                            <label for="isi" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="<?php echo $judul; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="summernote" name="isi">
                                    <?php echo $isi; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" id="submit" name="submit"
                                    value="<?php echo $btn_type;?>">
                            </div>
                        </div>

                    </form>
                </form>
    </div>
</div>

<!-- Footer -->
<?php include("../resource/components/admin/footer.php") ?>