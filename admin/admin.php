<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['nama_admin'])){
   header('location: ../login.php');
}

if(isset($_POST['add_product'])){
   $n_produk = $_POST['n_produk'];
   $h_produk = $_POST['h_produk'];
   $g_produk = $_FILES['g_produk']['name'];
   $tmp_n_produk = $_FILES['g_produk']['tmp_name'];
   $folder_g_produk = 'uploaded_img/'.$g_produk;

   $insert_query = mysqli_query($conn, "INSERT INTO `produk`(nama_produk, harga_produk, gambar) VALUES('$n_produk', '$h_produk', '$g_produk')") or die('query failed');

   if($insert_query){
      move_uploaded_file($tmp_n_produk, $folder_g_produk);
      $notiffikasi[] = 'Sukses menambahkan produk!';
   }else{
      $notiffikasi[] = 'Tidak dapat menambahkan produk!';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `produk` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location: /web-reservasi-resto/admin/admin.php');
      $notiffikasi[] = 'product has been deleted';
   }else{
      header('location:/web-reservasi-resto/admin/admin.php');
      $notiffikasi[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_produk'])){
   $update_id_produk = $_POST['update_id_produk'];
   $update_n_produk = $_POST['update_n_produk'];
   $update_h_produk = $_POST['update_h_produk'];
   $update_g_produk = $_FILES['update_g_produk']['name'];
   $update_temp_nama_g = $_FILES['update_g_produk']['tmp_name'];
   $update_folder_g_produk = 'uploaded_img/'.$update_g_produk;

   $update_query = mysqli_query($conn, "UPDATE `produk` SET nama_produk = '$update_n_produk', harga_produk = '$update_h_produk', gambar = '$update_g_produk' WHERE id = '$update_id_produk'");

   if($update_query){
      move_uploaded_file($update_temp_nama_g, $update_folder_g_produk);
      $notiffikasi[] = 'Sukses memperbarui produk';
      header('location:/web-reservasi-resto/admin/admin.php');
   }else{
      $notiffikasi[] = 'Tidak dapat memperbarui produk';
      header('location:/web-reservasi-resto/admin/admin.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halaman Admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php

if(isset($notifikasi)){
   foreach($notifikasi as $notifikasi){
      echo '<div class="notifikasi $notifikasi"><span>'.$notifikasi.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width slides/quotes -->
  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide1.jpg" alt="Gambar 1">
    <div class="slider-content">
    <?php echo "<h1>Selamat datang " . $_SESSION['nama_admin'] . "</h1>"; ?>
    <h3>Kelola reservasi restoran dengan mudah di halaman admin kami.</h3>
  </div></div>

  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide2.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Manajemen reservasi restoran yang praktis dengan halaman admin.</h1>
  </div></div>


  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide3.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Maksimalkan pengalaman pelanggan dengan </h1>
    <h1>fitur reservasi restoran di halaman admin kami.</h1>
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


<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Tambah Produk Baru</h3>
   <input type="text" name="n_produk" placeholder="Masukkan nama produk" class="box" required>
   <input type="number" name="h_produk" min="0" placeholder="Masukkan harga produk" class="box" required>
   <input type="file" name="g_produk" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="Tambah Produk" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>Gambar</th>
         <th>Nama</th>
         <th>Harga</th>
         <th>Aksi</th>
      </thead>

      <tbody>
         <?php
         
            $select_produk = mysqli_query($conn, "SELECT * FROM `produk`");
            if(mysqli_num_rows($select_produk) > 0){
               while($row = mysqli_fetch_assoc($select_produk)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['gambar']; ?>" height="100" alt=""></td>
            <td><?php echo $row['nama_produk']; ?></td>
            <td>Rp <?php echo $row['harga_produk']; ?>K</td>
            <td>
               <a href="/web-reservasi-resto/admin/admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apa anda yakin ingin menghapusnya?');"> <i class="fas fa-trash"></i> Hapus </a>
               <a href="/web-reservasi-resto/admin/admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Perbarui </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>Tidak ada produk yang ditambahkan!</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `produk` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['gambar']; ?>" height="200" alt="">
      <input type="hidden" name="update_id_produk" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_n_produk" value="<?php echo $fetch_edit['nama_produk']; ?>">
      <input type="number" min="0" class="box" required name="update_h_produk" value="<?php echo $fetch_edit['harga_produk']; ?>">
      <input type="file" class="box" required name="update_g_produk" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="Update Produk" name="update_produk" class="btn">
      <input type="reset" value="cancel" id="close-edit" onclick="location.href='/web-reservasi-resto/admin/admin.php'" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
<script src="../js/slider.js"></script>

</body>
</html>