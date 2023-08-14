<?php
    include("config.php");
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Admin Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin Tutors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin Partner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container p-4">
        <h1>Admin Page</h1>
        <button class="btn btn-primary">Create a New Page</button>

        <form action="" method="GET" class="row g-3 mt-4">
            <div class="col-4">
                <input type="text" class="form-control" name="search" placeholder="Search a Keyword">
            </div>
            <div class="col-2">
                <input type="submit" class="btn btn-success" name="submit" value="Search">
            </div>
        </form>

        <table class="table">
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
                    $query = "SELECT * FROM halaman";
                    $sql = mysqli_query($db, $query);
                    $no = 1;

                    while($row = mysqli_fetch_array($sql)) {
                ?>

                <td><?php echo $no;?></td>
                <td><?php echo $row['judul'];?></td>
                <td><?php echo $row['judul'];?></td>
                <td>
                    <div class="g-4">
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </td>


                <?php $no++; }?>
            </tbody>
        </table>

    </div>

    <!-- Footer -->

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>