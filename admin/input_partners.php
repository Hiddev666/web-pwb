<?php
include("../config.php");
include("../func/getImage.php");
?>

<!-- Header -->
<?php include("../resource/components/admin/header.php") ?>
<div class="container p-4">

    <?php

    (isset($_GET['operation'])?$btn_type = "Update":$btn_type = "Insert"); 

    $nama = "";
    $foto = "";
    $isi = "";
    $error = "";
    $success = "";

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $isi = $_POST['isi'];
        $id = $_GET['id'];

    

        if ($nama == "") {
            $error = "Data belum dimasukkan dengan benar!";
        } else {


            if($_FILES['foto']['name']) {
                $foto_name = $_FILES['foto']['name'];
                $foto_file = $_FILES['foto']['tmp_name'];
    
                $detail_file = pathinfo($foto_name);
                $foto_ekstensi = $detail_file['extension'];
    
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if(!in_array($foto_ekstensi, $allowedExtensions)) {
                    $error = "Ekstensi yang diperbolehkan adalh jpg, jpeg, png dan gif";
                }
            }

            if(empty($error)) {
                if($foto_name) {
                    $direktori = "../resource/uploaded";
                    $foto_name = "partners_" . time() . "_" . $foto_name;
                    move_uploaded_file($foto_file, $direktori . "/" . $foto_name);
                }
            }

            if (isset($_GET['operation'])) {
                $query = "UPDATE partners SET nama='$nama', foto='$foto_name', isi='$isi' where id='$id'";
                $goquery = mysqli_query($db, $query);

                if ($goquery) {
                    $success = "Data berhasil diubah!";
                } else {
                    $success = "Data gagal diubah!";
                }
            } else {
                $query = "INSERT INTO partners(nama, foto, isi) values ('$nama', '$foto_name', '$isi')";
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
    <h1>Admin Page | Input Data</h1>
    <div class="mb-3 row">
        <a href="index.php" class="link-underline link-underline-opacity-0">
            < Back to Admin Page</a>

                <form action="" method="POST" enctype="multipart/form-data">
                    <form>
                        <?php if (isset($_GET['operation'])) {
                            $id = $_GET['id'];
                            $query = "SELECT * FROM partners where id='$id'";
                            $sql = mysqli_query($db, $query);

                            $data = mysqli_fetch_array($sql);
                            $nama = $data['nama'];
                            $foto = $data['foto'];
                            $isi = $data['isi'];

                            
                        }
                        ?>
                        <div class="mb-3 row">
                            <label for="isi" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?php echo $nama; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <img src="../resource/uploaded/<?php echo getPartnersImage($id)?>" alt="" style="max-width: 110px; max-height: 110px;">
                                <input type="file" class="form-control" id="foto" name="foto">
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