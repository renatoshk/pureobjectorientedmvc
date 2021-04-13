  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="<?php echo URLROOT;?>/">Charmy Fashion</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="<?php echo URLROOT;?>/">Home</a></li>
          <li><a class="nav-link scrollto" href="<?php echo URLROOT;?>/pages/about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="<?php echo URLROOT;?>/posts/index">My Posts</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <?php if(isset($_SESSION['user_email'])) : ?>
            <li><a class="nav-link scrollto" href="<?php echo URLROOT;?>/posts/add">Add Post</a></li>
            <li><a class="nav-link scrollto" href="<?php echo URLROOT;?>/users/logout">Logout</a></li>
            <li><a class="nav-link scrollto"><?php echo $_SESSION['user_name'] ?></a></li>
          <?php else: ?>
          <li><a class="nav-link scrollto" href="<?php echo URLROOT;?>/users/register">Register</a></li>
          <li><a class="nav-link scrollto" href="<?php echo URLROOT;?>/users/login">Login</a></li>
         <?php endif ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->