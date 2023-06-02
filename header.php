<header class="header">
   <div class="flex">
      <a href="#" class="logo">FIKOM RESTO</a>
      <nav class="navbar">
         <a href="products.php">Menu</a>
         <a href="detail_pesanan.php">Pesanan Saya</a>
         <?php
         $select_rows = mysqli_query($conn, "SELECT * FROM `keranjang`") or die('query failed');
         $row_count = mysqli_num_rows($select_rows);
         ?>
         <a href="cart.php" class="cart">Keranjang<span><?php echo $row_count; ?></span> </a>
      </nav>
      <div id="menu-btn" class="fas fa-bars"></div>
      
      <div class="dropdown">
      <button id="dropbtn" class="fa fa-user fa-2x">
      <div class="user">User</div>
      </button>
      <div class="dropdown-content">
         <a><?php
               // Periksa apakah pengguna sudah login sebelum menampilkan menu profil dan tombol logout
               if (isset($_SESSION['user_name'])) {
                  $username = $_SESSION['user_name'];
                  echo '<div class="user-profile">'; 
                  echo '   <span class="username">' . $username . '</span>';
                  echo '</div>';
               } 
               ?></a>
      <div class="dropdown-divider"></div>
                  <a href="logout.php" class="logout-button">
                  <i class="fa fa-sign-out"> Logout</i></a>
               </div>
      </div>
      </div>
   </div>
</header>
