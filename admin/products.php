<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){
   $nama_produk = $_POST['nama_produk'];
   $harga_produk = $_POST['harga_produk'];
   $gambar_produk = $_POST['gambar_produk'];
   $kuantitas_produk = 1;

   $select_keranjang = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE nama_produk = '$nama_produk'");

   if(mysqli_num_rows($select_keranjang) > 0){
      $notifikasi[] = 'product already added to cart';
   }else{
      $insert_produk = mysqli_query($conn, "INSERT INTO `keranjang`(nama_produk, harga_produk, gambar, kuantitas) VALUES('$nama_produk', '$harga_produk', '$gambar_produk', '$kuantitas_produk')");
      $notifikasi[] = 'product added to cart succesfully';
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
    <h1>Selamat datang di menu kami!.</h1>
  </div></div>

  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide2.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Kami menyajikan hidangan yang menggugah selera.</h1>
  </div></div>


  <div class="mySlides">
    <img class="slider-image active" src="./assets/image/slide3.jpg" alt="Gambar 1">
    <div class="slider-content">
    <h1>Dapatkan pengalaman kuliner yang tak terlupakan.</h1>
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
      
      $select_produk = mysqli_query($conn, "SELECT * FROM `produk`");
      if(mysqli_num_rows($select_produk) > 0){
         while($fetch_produk = mysqli_fetch_assoc($select_produk)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_produk['gambar']; ?>" alt="">
            <h3><?php echo $fetch_produk['nama_produk']; ?></h3>
            <div class="harga_produk">Rp <?php echo $fetch_produk['harga_produk']; ?>K</div>
            <input type="hidden" name="nama_produk" value="<?php echo $fetch_produk['nama_produk']; ?>">
            <input type="hidden" name="harga_produk" value="<?php echo $fetch_produk['harga_produk']; ?>">
            <input type="hidden" name="gambar_produk" value="<?php echo $fetch_produk['gambar']; ?>">
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
<script src="../js/script.js"></script>
<script src="../js/slider.js"></script>
</body>
</html>