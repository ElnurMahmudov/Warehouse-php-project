<?php 
include"header.php";
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');
?>

<h2> <span class="badge badge-pill badge-Warning">Profile</span></h2>

<?php
if(isset($_POST['update']))
{   
    if($_SESSION['parol']==$_POST['tparol'])
    { 
        $ad=trim($_POST['ad']);
        $ad=strip_tags($ad);
        $ad=htmlspecialchars($ad);
        $ad=mysqli_real_escape_string($con, $ad);

        $soyad=trim($_POST['soyad']);
        $soyad=strip_tags($soyad);
        $soyad=htmlspecialchars($soyad);
        $soyad=mysqli_real_escape_string($con, $soyad);

        $email=trim($_POST['email']);
        $email=strip_tags($email);
        $email=htmlspecialchars($email);
        $email=mysqli_real_escape_string($con, $email);

        $tel=trim($_POST['tel']);
        $tel=strip_tags($tel);
        $tel=htmlspecialchars($tel);
        $tel=mysqli_real_escape_string($con, $tel);

        $parol=trim($_POST['parol']);
        $parol=strip_tags($parol);
        $parol=htmlspecialchars($parol);
        $parol=mysqli_real_escape_string($con, $parol);


          if(!empty($ad) && !empty($soyad) && !empty($email) && !empty($tel) && !empty($parol))
           {
             $yoxla=mysqli_query($con, "SELECT * FROM users WHERE email='".$email."' AND id!='".$_SESSION['user_id']."'");
             
             if(mysqli_num_rows($yoxla)==0)
            {

                include"upload.php";

                if($_FILES['photo']['size']<1024)
                {$foto = $_SESSION['foto'];}
                else
                {$foto = $unvan;}


                 $yenile=mysqli_query($con, "UPDATE users SET 
                 uname='".$ad."',
                 usurname='".$soyad."',
                 email='".$email."',
                 tel='".$tel."',
                 foto='".$foto."',
                 parol='".$parol."'
                 WHERE id='".$_SESSION['id']."'");

             if($yenile==true)
             {echo'
                <div class="alert alert-success" role="alert">
              Melumatlar yenilendi</div><br><br>';

                $_SESSION['ad'] = $ad;
                $_SESSION['soyad'] = $soyad;
                $_SESSION['tel'] = $tel;
                $_SESSION['foto'] = $foto;
                $_SESSION['email'] = $email;
                $_SESSION['parol'] = $parol;

                echo'<meta http-equiv="refresh" content="3; URL=profile.php" >';

          }

              else
                 {echo'<div class="alert alert-success" role="alert">
              Melumatlar yenilene bilmedi</div><br><br>';}

             }
         }

       else
         {echo'<div class="alert alert-success" role="alert">
               Zehmet olmasa melumatlari yeniden yoxlayin</div>';}

       } 
       else
     {echo'<div class="alert alert-success" role="alert">
               Cari parol düzgün deyil</div>';}
    }
   


?>
      <div class="alert alert-success" role="alert">
      <form method="post" enctype="multipart/form-data">
       <b>Ad</b><br>
       <input type="text" class="form-control" name="ad" value="<?=$_SESSION['ad'] ?>"><br>
       <b>Soyad</b><br>
       <input type="text" class="form-control" name="soyad" value="<?=$_SESSION['soyad'] ?>"><br>
       <b>Shirket</b><br>
       <input type="text" class="form-control" name="email" value="<?=$_SESSION['email'] ?>"><br>
       <b>Telefon</b><br>
       <input type="text" class="form-control" name="tel" value="<?=$_SESSION['tel'] ?>"><br>
       <b>Foto</b><br>
       <img style="width:75px; height:75px;" src="<?=$_SESSION['foto'] ?>"><br>
       <input type="file" class="form-control" name="photo"><br>
       <b>Parol</b><br>
       <input type="password" class="form-control" name="parol" value="<?=$_SESSION['parol'] ?>"><br>
        <b>Redakteni tesdiq etmek ucun cari parolu daxil edin:</b><br>
       <input type="password" class="form-control" name="tparol" value=""><br>

       <button type="submit" name="update" class="btn btn-success">Yenile</button>

      </form></div>


    </div>



