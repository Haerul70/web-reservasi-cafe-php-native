<?php

include 'config.php';

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `user` WHERE id = '$delete_id'");
    header('location: /web-reservasi-resto/admin/data_user.php?halaman_data_user');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <title>Data User</title>
</head>
<body>

<?php include 'header.php'; ?>

<div class="slideshow-container">
 <!-- Full-width slides/quotes -->
 <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide1.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Pengguna kami, pahlawan di balik layanan ini.</h1>
  </div></div>

  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide2.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Pengguna kami, bagian tak terpisahkan dari komunitas ini.</h1>
  </div></div>


  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide3.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Pengguna yang menginspirasi kami setiap hari.</h1>
  </div></div>


  <!-- Next/prev buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<!-- Dots/bullets/indicators -->
<div class="dot-container">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
<!--END-->

    <div class="container"> 
        <h1 class="data-user">Data Pengguna</h1>
        <section class="tabel-data-user">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping untuk menampilkan data pesanan -->
                    <?php 
                    $select_query = "SELECT * FROM user";
                    $result = mysqli_query($conn, $select_query);

                    // Periksa apakah ada data pesanan
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        // Loop melalui setiap baris data pesanan
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['type_user']; ?></td>
                        <td>
                            <a href="/web-reservasi-resto/admin/data_user.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apa kamu yakin ingin menghapus data ini?');">Delete</a>
                        </td>
                    </tr> 
                    <?php
                        $no++;
                        }
                    } else {
                        // Tampilkan pesan jika tidak ada data pesanan
                        echo "<tr><td colspan='9'>Tidak ada data pengguna.</td></tr>";
                    }

                    // Tutup koneksi database
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <?php include 'footer.php'; ?>

    <script src="../js/script.js"></script>
    <script src="../js/slider.js"></script>
</body>
</html>
