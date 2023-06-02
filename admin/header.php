<header class="header">

   <div class="flex">

      <a href="#" class="logo">FIKOM RESTO</a>

      <nav class="navbar">
         <a href="data_user.php">Lihat Data Penguna</a>
         <a href="admin.php">Tambah Menu</a>
         <a href="products.php">Lihat Menu</a>
         <a href="detail_pesanan.php">Lihat Pesanan</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `keranjang`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
      <div id="menu-btn" class="fas fa-bars"></div>
      <div class="logout-container">
         <a href="../logout.php" class="logout-button">
        <i class="fa fa-sign-out"></i> Admin</a>
      </div>
   </div>

</header>