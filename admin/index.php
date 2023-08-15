<?php
include("../config.php");
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <!-- Navbar -->
    <?php include("../resource/components/header.php") ?>


    <!-- Content -->
    <div class="container p-4">
        <h1>Admin Page</h1>
        <a href="input_page.php"><button class="btn btn-primary">Create a New Page</button></a>

        <form action="" method="POST" class="row g-3 mt-4">
            <div class="col-4">
                <?php
                $katakunci = "";                
                if(isset($_POST['submit'])) {
                    $katakunci = $_POST['katakunci'];
                }


                if(isset($_GET['operation'])) {
                    $operation = $_GET['operation'];
                    $id = $_GET['id'];

                    $query = "DELETE FROM halaman where id='$id'";
                    $sql = mysqli_query($db, $query);
                } 



                ?>
                <input type="text" class="form-control" placeholder="Search a Keyword" name="katakunci" value="<?php echo $katakunci;?>">
            </div>
            <div class="col-2">
                <input type="submit" class="btn btn-success" name="submit" value="Search">
            </div>
        </form>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kutipan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "";
                $sql = "";
                $no = 1;
                $katakunci = "";

                $query = "SELECT * FROM halaman";
                    $sql = mysqli_query($db, $query);
                    $no = 1;

                if(isset($_POST['submit'])) {
                    $katakunci = $_POST['katakunci'];                    
                    $query = "SELECT * FROM halaman  where judul like '%$katakunci%'";
                    $sql = mysqli_query($db, $query);
                    $no = 1;
                }
                    

                

                while ($row = mysqli_fetch_array($sql)) {?>
                <tr>
                    <td>
                        <?php echo $no; ?>
                    </td>
                    <td>
                        <?php echo $row['judul']; ?>
                    </td>
                    <td>
                        <?php echo $row['judul']; ?>
                    </td>
                    <td>
                        <div class="g-4">
                            <button class="btn btn-warning">Edit</button>
                            <a href="index.php?operation=delete&id=<?php echo $row['id']?>" onclick="return confirm('Yakin mau hapus data ini?')">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </div>
                    </td>
                    </tr>
                    <?php $no++;} ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <?php include("../resource/components/footer.php") ?>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>