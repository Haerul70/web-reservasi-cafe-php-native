<?php

@include 'config.php';

if (isset($_POST['update_update_btn'])) {
   $update_value = $_POST['update_kuantitas'];
   $update_id = $_POST['update_kuantitas_id'];
   $update_kuantitas_query = mysqli_query($conn, "UPDATE `keranjang` SET kuantitas = '$update_value' WHERE id = '$update_id'");
   if ($update_kuantitas_query) {
      header('location:cart.php?halaman_keranjang');
      exit; // Tambahkan perintah exit setelah melakukan redirect untuk menghentikan eksekusi script.
   }
}

if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `keranjang` WHERE id = '$remove_id'");
   header('location:cart.php?halaman_keranjang');
   exit; // Tambahkan perintah exit setelah melakukan redirect untuk menghentikan eksekusi script.
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `keranjang`");
   header('location:cart.php?halaman_keranjang');
   exit; // Tambahkan perintah exit setelah melakukan redirect untuk menghentikan eksekusi script.
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="css/style.css">
   

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="container">
      <h1 class="heading">Keranjang Pesanan</h1>

      <section class="shopping-cart">

         <table>

            <thead>
               <th>Gambar</th>
               <th>Nama</th>
               <th>Harga Produk</th>
               <th>Kuantitas</th>
               <th>Total Harga</th>
               <th>Aksi</th>
            </thead>

            <tbody>

               <?php

               $select_keranjang = mysqli_query($conn, "SELECT * FROM `keranjang`");
               $total_keseluruhan = 0;
               if (mysqli_num_rows($select_keranjang) > 0) {
                  while ($fetch_keranjang = mysqli_fetch_assoc($select_keranjang)) {
               ?>

                     <tr>
                        <td><img src="./admin/uploaded_img/<?php echo $fetch_keranjang['gambar']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_keranjang['nama_produk']; ?></td>
                        <td>Rp <?php echo number_format($fetch_keranjang['harga_produk']); ?>K</td>
                        <td>
                           <form action="" method="post">
                              <input type="hidden" name="update_kuantitas_id" value="<?php echo $fetch_keranjang['id']; ?>">
                              <input type="number" name="update_kuantitas" min="1" value="<?php echo $fetch_keranjang['kuantitas']; ?>">
                              <input type="submit" value="update" name="update_update_btn">
                           </form>
                        </td>
                        <td>Rp <?php echo $sub_total = number_format($fetch_keranjang['harga_produk'] * $fetch_keranjang['kuantitas']); ?>K</td>
                        <td><a href="cart.php?remove=<?php echo $fetch_keranjang['id']; ?>" onclick="return confirm('Hapus item dari keranjang?')" class="delete-btn"> <i class="fas fa-trash"></i> Hapus</a></td>
                     </tr>
               <?php
                     $total_keseluruhan += $sub_total;
                  }
               }
               ?>
               <tr class="table-bottom">
                  <td><a href="products.php" class="option-btn" style="margin-top: 0;">Buat Pesanan Baru</a></td>
                  <td colspan="3">Total Keseluruhan</td>
                  <td>Rp <?php echo $total_keseluruhan; ?>K</td>
                  <td><a href="cart.php?delete_all" onclick="return confirm('Apa kamu yakin ingin menghapus semuanya?');" class="delete-btn"> <i class="fas fa-trash"></i> Hapus Semua </a></td>
               </tr>

            </tbody>

         </table>
      </section>
      <div class="checkout-btn">
         <a href="checkout.php?checkout_produk" class="btn <?= ($total_keseluruhan > 1) ? '' : 'disabled'; ?>">Pesan Sekarang</a>
      </div>
   </div>

   <?php include 'footer.php'; ?>
   <!-- custom js file link  -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <script src="js/script.js"></script>

</body>

</html>