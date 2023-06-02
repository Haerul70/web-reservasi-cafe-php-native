<?php
include 'config.php';

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `pesanan` WHERE id = '$delete_id'");
    header('location: /web-reservasi-resto/admin/detail_pesanan.php?halaman_detail_pesanan');
}

if (isset($_POST['completed'])) {
    $completed = $_POST['completed'] == 'on' ? 'Pesanan Siap!' : 'Sedang Menyiapkan';
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE `pesanan` SET `status` = '$completed' WHERE id = '$id'");
    header('location: /web-reservasi-resto/admin/detail_pesanan.php?halaman_detail_pesanan');
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping untuk menampilkan data pesanan -->
                <?php 
                $select_query = "SELECT * FROM pesanan";
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
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="completed" value="Sedang Menyiapkan">
                            <input type="checkbox" class="ready-checkbox" name="completed" onchange="this.form.submit()" <?php if ($row['status'] == "Pesanan Siap!") echo 'checked'; ?>>
                        </form>
                    </td>
                    <td>
                        <!-- Tambahkan tombol atau tautan untuk aksi, misalnya tombol delete -->
                        <a href="?delete=<?php echo $row['id']; ?>" class="fa fa-trash fa-2x" onclick="return confirm('Apa kamu yakin ingin menghapus pesanan ini?');"></a>
                    </td>
                </tr> 
                <?php
                    $no++;
                    }
                } else {
                    // Tampilkan pesan jika tidak ada data pesanan
                    echo "<tr><td colspan='12'>Tidak ada data pesanan.</td></tr>";
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
