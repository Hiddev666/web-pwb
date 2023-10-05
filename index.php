<?php include("config.php"); ?>
<?php include("func/getImage.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiddev.</title>
    <link rel="stylesheet" href="resource/components/css/style.css">
</head>

<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href=''>Hiddev.</a></div>
            <div class="menu">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#tutors">Tutors</a></li>
                    <li><a href="#partners">Partners</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="" class="tbl-biru">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <!-- untuk home -->
        <section id="home">
            <img src="<?php getImage('29') ?>" />
            <div class="kolom">
                <p class="deskripsi">
                    <?php getKutipan('29') ?>
                </p>
                <h2>
                    <?php getJudul('29') ?>
                </h2>
                <p>
                    <?php echo maxText(getIsi('29'), 30) ?>
                </p>
                <p><a href="<?php createUrl('29') ?>" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
            </div>
        </section>

        <!-- untuk courses -->
        <section id="courses">
            <div class="kolom">
                <p class="deskripsi">
                    <?php getKutipan('32') ?>
                </p>
                <h2>
                    <?php getJudul('32') ?>
                </h2>
                <p>
                    <?php echo maxText(getIsi('32'), 30) ?>
                </p>
                <p><a href="<?php createUrl('32') ?>" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
            </div>
            <img src="<?php getImage('32') ?>" />
        </section>

        <!-- untuk tutors -->
        <section id="tutors">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Top Tutors</p>
                    <h2>Tutors</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, optio!</p>
                </div>


                <div class="tutor-list">
                    <?php

                    $query = "SELECT * FROM tutors order by id desc";
                    $sql = mysqli_query($db, $query);

                    while ($row = mysqli_fetch_array($sql)) {
                        ?>

                        <div class="kartu-tutor">
                            <a href="<?php createTutorsUrl($row['id']) ?>?page=tutors">
                                <img src="resource/uploaded/<?php echo $row['foto'] ?>" />
                                <p>
                                    <?php echo $row['nama'] ?>
                                </p>
                            </a>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </section>

        <!-- untuk partners -->
        <section id="partners">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Top Partners</p>
                    <h2>Partners</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi magni tempore expedita sequi.
                        Similique rerum doloremque impedit saepe atque maxime.</p>
                </div>

                <div class="partner-list">
                    <?php

                    $query = "SELECT * FROM partners order by id desc";
                    $sql = mysqli_query($db, $query);

                    while ($row = mysqli_fetch_array($sql)) {
                        ?>

                        <div class="kartu-partner">
                            <a href="<?php createPartnersUrl($row['id']) ?>?page=tutors">
                                <img src="resource/uploaded/<?php echo $row['foto'] ?>" />
                                <p>
                                    <?php echo $row['nama'] ?>
                                </p>
                            </a>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </section>
    </div>

    <div id="contact">
        <div class="wrapper">
            <div class="footer">
                <?php

                $query = "SELECT * FROM info order by id desc";
                $sql = mysqli_query($db, $query);

                while ($row = mysqli_fetch_array($sql)) {
                    ?>

                    <div class="footer-section">
                        <h3><?php echo $row['judul']?></h3>
                        <p><?php echo $row['isi']?></p>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2023. <b>Hiddev.</b> All Rights Reserved.
        </div>
    </div>

</body>

</html>