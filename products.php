<?php

@include 'config.php';

session_start(); 

if(!isset($_SESSION['user_name'])){
   header('location: login.php');
}

if(isset($_POST['add_to_cart'])){
   $nama_produk = $_POST['nama_produk'];
   $harga_produk = $_POST['harga_produk'];
   $gambar_produk = $_POST['gambar_produk'];
   $kuantitas_produk = 1;

   $select_keranjang = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE nama_produk = '$nama_produk'");

   if(mysqli_num_rows($select_keranjang) > 0){
      $notifikasi[] = 'Produk sudah ditambahkan ke dalam keranjang';
   }else{
      $insert_produk = mysqli_query($conn, "INSERT INTO `keranjang`(nama_produk, harga_produk, gambar, kuantitas) VALUES('$nama_produk', '$harga_produk', '$gambar_produk', '$kuantitas_produk')");
      $notifikasi[] = 'Sukses menambahkan produk ke dalam keranjang';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php

if(isset($notifikasi)){
   foreach($notifikasi as $notifikasi){
      echo '<div class="notifikasi"><span>'.$notifikasi.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<!--Slider Section-->
<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width slides/quotes -->
  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide1.jpg" alt="Gambar 1">
    <div class="slider-content">
    <?php echo "<h1>Selamat datang " . $_SESSION['user_name'] . "</h1>"; ?>
    <h3>Nikmati hidangan lezat kami yang disajikan dengan cinta.</h3>
  </div></div>

  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide2.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Pilih dari beragam hidangan spesial kami, cocok untuk semua selera.</h1>
  </div></div>


  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide3.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Sensasi kuliner yang tak terlupakan menanti Anda di setiap gigitan. </h1>
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

<section class="products">

   <h1 class="heading">Menu Terbaru</h1>

   <div class="box-container">

      <?php
      
      $pilih_produk = mysqli_query($conn, "SELECT * FROM `produk`");
      if(mysqli_num_rows($pilih_produk) > 0){
         while($fetch_produk = mysqli_fetch_assoc($pilih_produk)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="./admin/uploaded_img/<?php echo $fetch_produk['gambar']; ?>" alt="">
            <h3><?php echo $fetch_produk['nama_produk']; ?></h3>
            <div class="harga_produk">Rp <?php echo $fetch_produk['harga_produk']; ?>K</div>
            <input type="hidden" name="nama_produk" value="<?php echo $fetch_produk['nama_produk']; ?>">
            <input type="hidden" name="harga_produk" value="<?php echo $fetch_produk['harga_produk']; ?>">
            <input type="hidden" name="gambar_produk" value="<?php echo $fetch_produk['gambar']; ?>">
            <input type="submit" class="btn" value="Tambah Keranjang" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<?php include 'footer.php'; ?>
<!-- custom js file link  -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="js/script.js"></script>
<script src="js/slider.js"></script>

</body>
</html>