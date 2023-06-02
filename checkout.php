<?php
session_start();

include 'config.php';

if (!isset($_SESSION['user_name'])) {
    header('location: login.php?user_name_tidak_sesuai');
    exit;
}

if (isset($_POST['order_btn'])) {
    $nama = $_POST['nama'];
    $no_tlp = $_POST['no_tlp'];
    $jml_orang = $_POST['jml_orang'];
    $metode_bayar = $_POST['metode_bayar'];
    $tanggal = $_POST['tanggal'];
    $jam_datang = $_POST['jam'];
    
    // Pengecekan apakah file bukti pembayaran diunggah
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] === 0) {
        $bukti_pembayaran = $_FILES['bukti_pembayaran']['name'];
        $tmp_file = $_FILES['bukti_pembayaran']['tmp_name'];
        $uploads_dir = 'admin/uploaded_img/bukti_bayar_img/'; // Direktori tujuan untuk menyimpan file

        // Pindahkan file yang diunggah ke direktori tujuan
        move_uploaded_file($tmp_file, $uploads_dir . $bukti_pembayaran);
        } else {
            $bukti_pembayaran = null; // Jika tidak ada file yang diunggah, maka variabel $bukti_pembayaran akan diatur sebagai null
        }

    $keranjang_query = mysqli_query($conn, "SELECT * FROM keranjang");
    $total_harga = 0;
    $nama_produk = array();
    if (mysqli_num_rows($keranjang_query) > 0) {
        while ($item_produk = mysqli_fetch_assoc($keranjang_query)) {
            $nama_produk[] = $item_produk['nama_produk'] . ' (' . $item_produk['kuantitas'] . ') ';
            $harga_produk = number_format($item_produk['harga_produk'] * $item_produk['kuantitas']);
            $total_harga += $harga_produk;
        }
    }

    $total_produk = implode(', ', $nama_produk);
    $detail_query = mysqli_query($conn, "INSERT INTO `pesanan` (nama, no_tlp, jml_orang, metode_bayar, bukti_pembayaran, tanggal, jam, total_produk, total_harga) VALUES ('$nama', '$no_tlp', '$jml_orang', '$metode_bayar', '$bukti_pembayaran', '$tanggal', '$jam_datang', '$total_produk', '$total_harga')") or die('query failed');

    // Pindahkan file yang diunggah ke direktori tujuan
    move_uploaded_file($tmp_file, $uploads_dir.$bukti_pembayaran);

    if ($keranjang_query && $detail_query) {
        echo "
        <div class='order-message-container'>
            <div class='message-container'>
                <h3>Terima Kasih!</h3>
                <h4>Kami akan kembali menghubungi anda setelah pesanan anda siap!</h4>
                <div class='order-detail'>
                    <span>" . $total_produk . "</span>
                    <span class='total'> Total Bayar : Rp " . $total_harga . "K </span>
                </div>
                <div class='customer-details'>
                    <p> Nama : <span>" . $nama . "</span> </p>
                    <p> No Telepon : <span>" . $no_tlp . "</span> </p>
                    <p> Jumlah Orang : <span>" . $jml_orang . "</span> </p>
                    <p> Tanggal Kedatangan : <span>" . $tanggal . "</span> </p>
                    <p> Jam Kedatangan: <span>" . $jam_datang . "</span> </p>
                    <p> Metode Pembayaran : <span>" . $metode_bayar . "</span> </p>
                </div>
                <a href='products.php?halaman_produk' class='btn'>Buat Pesanan Baru</a>
            </div>
        </div>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <section class="checkout-form">

            <h1 class="heading">Selesaikan Pesanan Anda</h1>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="display-order">
                    <?php
                    $select_keranjang = mysqli_query($conn, "SELECT * FROM keranjang");
                    $total = 0;
                    $total_keseluruhan = 0;
                    if (mysqli_num_rows($select_keranjang) > 0) {
                        while ($fetch_keranjang = mysqli_fetch_assoc($select_keranjang)) {
                            $total_harga = number_format($fetch_keranjang['harga_produk'] * $fetch_keranjang['kuantitas']);
                            $total_keseluruhan = $total += $total_harga;
                            ?>
                            <span><?= $fetch_keranjang['nama_produk']; ?>(<?= $fetch_keranjang['kuantitas']; ?>)</span>
                        <?php
                        }
                    } else {
                        echo "<div class='display-order'><span>Ups!! Keranjang kamu kosong!</span></div>";
                    }
                    ?>
                    <span class="grand-total"> Total Keseluruhan : Rp <?= $total_keseluruhan; ?>K</span>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Nama</span>
                        <input type="text" placeholder="Masukkan nama" name="nama" required>
                    </div>
                    <div class="inputBox">
                        <span>No Telepon</span>
                        <input type="tel" placeholder="Masukkan no telepon" name="no_tlp" required>
                    </div>
                    <div class="inputBox">
                        <span>Jumlah Orang</span>
                        <input type="number" placeholder="Masukkan jumlah orang" name="jml_orang" required>
                    </div>
                    <div class="inputBox">
                        <span>Pilih Tanggal</span>
                        <input type="date" placeholder="Pilih tanggal kedatangan" name="tanggal" required>
                    </div>
                    <div class="inputBox">
                        <span>Pilih Jam</span>
                        <input type="time" placeholder="Pilih jam kedatangan" name="jam" required>
                    </div>
                    <div class="inputBox">
                        <span>Metode Pembayaran:</span>
                        <select name="metode_bayar">
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="Dana">Dana</option>
                            <option value="Shopee Pay">Shopee Pay</option>
                        </select>
                    </div>
                </div>
                <div class="image-pembayaran">
                    <div class="image">
                        <img src="./assets/image/bca-logo.png" alt="BCA Logo">
                        <h5>(BCA) 1234567890</h5>
                    </div>
                    <div class="image">
                        <img src="./assets/image/mandiri-logo.png" alt="Mandiri Logo">
                        <h5>(Mandiri) 1234567890</h5>
                    </div>
                    <div class="image">
                        <img src="./assets/image/bni-logo.png" alt="BNI Logo">
                        <h5>(BNI) 1234567890</h5>
                    </div>
                    <div class="image">
                        <img src="./assets/image/bri-logo.png" alt="BRI Logo">
                        <h5>(BRI) 1234567890</h5>
                    </div>
                    <div class="image-dana">
                        <img src="./assets/image/dana-logo.jpg" alt="DANA Logo">
                        <h5>(DANA) 1234567890</h5>
                    </div>
                    <div class="image-shopay">
                        <img src="./assets/image/shopee-pay-logo.png" alt="Shopee Pay Logo">
                        <h5>(SHOPEE PAY) 1234567890</h5>
                    </div>
                </div>

                <p class="penting">*Sebelum konfirmasi pembayaran, silahkan lakukan pembayaran terlebih dahulu!*</p>
                
                <div class="inputBox">
                    <span>Unggah Bukti Pembayaran</span>
                    <input type="file" name="bukti_pembayaran" accept="image/jpg, image/png, image/jpeg" class="box" required>
                </div>
                
                <input type="submit" value="Konfirmasi Pembayaran" name="order_btn" class="btn">
            </form>

        </section>

    </div>

    <!-- custom js file link  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>

</html>
