<?php
session_start(); // Mulai session jika belum dimulai
include 'config.php';

if (!isset($_SESSION['user_name'])) {
    header('location: login.php');
    exit; // Tambahkan exit untuk menghentikan eksekusi skrip setelah melakukan redirect
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Detail Pesanan</title>
</head>
<body>

<?php include 'header.php'; ?>

<div class="slideshow-container">
    <!-- Full-width slides/quotes -->
    <div class="mySlides">
        <img class="slider-image active" src="./assets/image/slide1.jpg" alt="Gambar 1">
        <div class="slider-content">
            <h1>Ini adalah halaman detail pesanan pelanggan!.</h1>
        </div>
    </div>

    <div class="mySlides">
        <img class="slider-image active" src="./assets/image/slide2.jpg" alt="Gambar 1">
        <div class="slider-content">
            <h1>Pesanan akan segera kami siapkan!.</h1>
        </div>
    </div>


    <div class="mySlides">
        <img class="slider-image active" src="./assets/image/slide3.jpg" alt="Gambar 1">
        <div class="slider-content">
            <h1>Pantau terus pesanan baru dari pelanggan!.</h1>
        </div>
    </div>

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
    <section class="tabel-detail-pesanan">
        <h1>Detail Pesanan</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>No Telepon</th>
                    <th>Jumlah Orang</th>
                    <th>Metode Bayar</th>
                    <th>Bukti Pembayaran</th>
                    <th>Total Produk</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pesan</th>
                    <th>Jam Kedatangan</th>
                    <th>Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping untuk menampilkan data pesanan -->
                <?php
                if (isset($_SESSION['id'])) {
                    $user_id = $_SESSION['id'];
                    $select_query = "SELECT * FROM pesanan WHERE id = '$user_id'";
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
                                <td><?php echo $row['no_tlp']; ?></td>
                                <td><?php echo $row['jml_orang']; ?></td>
                                <td><?php echo $row['metode_bayar']; ?></td>
                                <td><img src="uploaded_img/bukti_bayar_img/<?php echo $row['bukti_pembayaran']; ?>" width="80" alt=""></td>
                                <td><?php echo $row['total_produk']; ?></td>
                                <td><?php echo $row['total_harga']; ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                                <td><?php echo $row['jam']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                    } else {
                        // Tampilkan pesan jika tidak ada data pesanan
                        echo "<tr><td colspan='12'>Tidak ada data pesanan.</td></tr>";
                    }
                } else {
                    // Tampilkan pesan jika pengguna belum login
                    echo "<tr><td colspan='12'>Silakan login untuk melihat pesanan Anda.</td></tr>";
                }

                // Tutup koneksi database
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </section>
</div>

<?php include 'footer.php'; ?>
<!-- jS Script -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script src="js/slider.js"></script>
</body>
</html>
