<?php
session_start();

if(!isset($_SESSION['email']) or !isset($_SESSION['parol']))
{echo'<meta http-equiv="refresh" content="0; URL=index.php" >'; exit;}


$con=mysqli_connect('localhost','adlar','0000','anbar');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><img style="width:35px; height:35px;" class="rounded-circle" src="<?=$_SESSION['foto'] ?>"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     
      <li class="nav-item active">
         <a class="nav-link" href="profile.php"><b><?=$_SESSION['ad'].' '.$_SESSION['soyad'] ?></b></a>
      </li>
      <li class="nav-item active">
      <a class="nav-link" href="brands.php"><i class="bi bi-collection-fill"></i> Brands</a>
        </li> 

      <li class="nav-item active">
      	 <a class="nav-link" href="clents.php"><i class="bi bi-people-fill"></i> Clents</a>
      	</li> 
      
      	<li class="nav-item active">
      	 <a class="nav-link" href="xerc.php"><i class="bi bi-cash"></i> Xerc</a>

          <li class="nav-item active">
         <a class="nav-link" href="producs.php"><i class="bi bi-crop"></i> Producs</a>

         <li class="nav-item active">
         <a class="nav-link" href="orders.php"><i class="bi bi-cart-check-fill"></i> Orders</a>
      </li>


      <li class="nav-item active">
         <a class="nav-link" href="exit.php"><i class="bi bi-arrow-up-square-fill"></i> <b>Çıxış</b></a>
      </li>

    </ul>
    <form method="post" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Axtar" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="axtar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></button>
       <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="hamisi"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
</svg></button>
    </form>
  </div>
</nav>
<br><br><br><br>
