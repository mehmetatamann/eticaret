<?php require_once 'config.php';
      include 'includes/classes/user-class.php';
      include 'includes/classes/class-insert.php';
      include 'includes/classes/class-select.php';
      include 'includes/classes/class-update.php';
      include 'includes/classes/class-delete.php';
      include 'includes/classes/class-urunler.php';



?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/lib/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/lib/owl.theme.default.min.css">
  <link rel="icon" href="images/fav.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
  <link rel="stylesheet" href="lib/animate.css">
  <title>BARÜ E-Ticaret</title>
</head>
<body>
  

<style>

</style>

  <nav class="navbar navbar-expand-md  sticky  fixed-top r-nav">
    <div class="container">

      <a class="navbar-brand animated fadeInLeft" href="index.php">BARÜ E-Ticaret</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarId" >
        <span><i class="fas fa-bars hamburger"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarId">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
          </li>

          <?php if(!isset($_SESSION['username'])) {?>
            <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="kayitol.php">Giriş Yap</a>
          </li>
          <?php }else {?>
            
            <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="cikis.php">Çıkış Yap</a>
          </li>

          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="admin/">Admin</a>
          </li>

          <?php }?>
          <li class="nav-item animated fadeInRight">
            <a id="basketac" class="nav-link" href="javascript:void(0)"><i class="fa-solid fa-cart-shopping"></i></a>
          </li>
        </ul>
      </div>
    </div>

  </nav>

  <div style="display:none;" class="basket">
    <div id="cart"></div>
  </div>

