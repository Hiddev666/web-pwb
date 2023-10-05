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
        <a href="input_users.php"><button class="btn btn-primary">Create a New Page</button></a>

        <form action="" method="POST" class="row g-3 mt-4">
            <div class="col-4">
                <?php
                $katakunci = "";
                if (isset($_POST['submit'])) {
                    $katakunci = $_POST['katakunci'];
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
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
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
				$users = isset($_GET['users'])?(int)$_GET['users'] : 1;
				$users_awal = ($users>1) ? ($users * $batas) - $batas : 0;	
 
				$previous = $users - 1;
				$next = $users + 1;
				
				$data = mysqli_query($db,"select * from users");
				$jumlah_data = mysqli_num_rows($data);
				$total_users = ceil($jumlah_data / $batas);
 
				$sql = mysqli_query($db,"select * from users limit $users_awal, $batas");
				$nomor = $users_awal+1;
                $no = 1;


                if (isset($_POST['submit'])) {
                    $katakunci = $_POST['katakunci'];
                    $query = "SELECT * FROM users  where username like '%$katakunci%'";
                    $sql = mysqli_query($db, $query);
                    $no = 1;
                }
                
                while ($row = mysqli_fetch_array($sql)) {?>
                    
                    <tr>
                        <td>
                            <?php echo $no; ?>
                        </td>
                        <td>
                            <?php echo $row['email']; ?>
                        </td>
                        <td>
                            <?php echo $row['username']; ?>
                        </td>
                        <td>
                           <?php if($row['status'] == '1') {?>
                                <p style="color: green; font-weight: 600;">Aktif</p>
                                <?php } else {?>
                                    <p style="color: red; font-weight: 600;">Tidak Aktif</p>
                           <?php }?>
                        </td>
                    </tr>
                    <?php $no++;
                } ?>
            </tbody>
        </table>

        <nav>
			<ul class="pagination justify-content-center mt-5">
				<li class="page-item">
					<a class="page-link" <?php if($users > 1){ echo "href='?users=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_users;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?users=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($users < $total_users) { echo "href='?users=$next'"; } ?>>Next</a>
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