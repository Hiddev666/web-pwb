<?php
include("../config.php");
include("../func/getImage.php");
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
    <?php include("../resource/components/admin/header.php") ?>


    <!-- Content -->
    <div class="container p-4">
        <h1>Admin Page</h1>
        <a href="input_page.php"><button class="btn btn-primary">Create a New Page</button></a>

        <form action="" method="POST" class="row g-3 mt-4">
            <div class="col-4">
                <?php
                $katakunci = "";
                if (isset($_POST['submit'])) {
                    $katakunci = $_POST['katakunci'];
                }


                if (isset($_GET['operation'])) {
                    $operation = $_GET['operation'];
                    $id = $_GET['id'];

                    $query = "DELETE FROM tutors where id='$id'";
                    $sql = mysqli_query($db, $query);
                }



                ?>
                <input type="text" class="form-control" placeholder="Search a Keyword" name="katakunci"
                    value="<?php echo $katakunci; ?>">
            </div>
            <div class="col-2">
                <input type="submit" class="btn btn-success" name="submit" value="Search">
            </div>
        </form>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">foto</th>
                    <th scope="col">nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "";
                $sql = "";
                $no = 1;
                $katakunci = "";

                $batas = 5;
				$tutors = isset($_GET['tutors'])?(int)$_GET['tutors'] : 1;
				$tutors_awal = ($tutors>1) ? ($tutors * $batas) - $batas : 0;	
 
				$previous = $tutors - 1;
				$next = $tutors + 1;
				
				$data = mysqli_query($db,"select * from tutors");
				$jumlah_data = mysqli_num_rows($data);
				$total_tutors = ceil($jumlah_data / $batas);
 
				$sql = mysqli_query($db,"select * from tutors limit $tutors_awal, $batas");
				$nomor = $tutors_awal+1;
                $no = 1;


                if (isset($_POST['submit'])) {
                    $katakunci = $_POST['katakunci'];
                    $query = "SELECT * FROM tutors  where foto like '%$katakunci%'";
                    $sql = mysqli_query($db, $query);
                    $no = 1;
                }
                
                while ($row = mysqli_fetch_array($sql)) {?>
                    
                    <tr>
                        <td>
                            <?php echo $no; ?>
                        </td>
                        <td>
                            <img src="../resource/uploaded/<?php echo getTutorsImage($row['id'])?>" alt="" style="max-width: 100px; max-height: 100px; border-radius: 5px;">
                        </td>
                        <td>
                            <?php echo $row['nama']; ?>
                        </td>
                        <td>
                            <div class="g-4">
                                <a href="input_tutors.php?operation=update&id=<?php echo $row['id'] ?>">
                                    <button class="btn btn-warning">Edit</button>
                                </a>
                                <a href="tutors.php?operation=delete&id=<?php echo $row['id'] ?>"
                                    onclick="return confirm('Yakin mau hapus data ini?')">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++;
                } ?>
            </tbody>
        </table>

        <nav>
			<ul class="pagination justify-content-center mt-5">
				<li class="page-item">
					<a class="page-link" <?php if($tutors > 1){ echo "href='?tutors=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_tutors;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?tutors=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($tutors < $total_tutors) { echo "href='?tutors=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>

    </div>

    <!-- Footer -->
    <?php include("../resource/components/admin/footer.php") ?>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>