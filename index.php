<?php
session_start();

if(isset($_SESSION['email']) && isset($_SESSION['parol']))
{echo'<meta http-equiv="refresh" content="0; URL=orders.php" >'; exit;}

include"usersheader.php";
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');
?>

<center>
<h4> <span class="badge badge-pill badge-success">Anbara daxil olmaq üçün qeydiyyatdan keç</span></h4>
</center>

<?php

if(isset($_POST['enter']))
{
	$email = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['email']))));
	$parol = mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['parol']))));

	$yoxla = mysqli_query($con,"SELECT * FROM users WHERE email='".$email."' AND  parol='".$parol."'");


	if(mysqli_num_rows($yoxla)>0)
	{
		$info = mysqli_fetch_array($yoxla);

		$_SESSION['user_id'] = $info['id'];
		$_SESSION['ad'] = $info['uname'];
		$_SESSION['soyad'] = $info['usurname'];
		$_SESSION['tel'] = $info['tel'];
		$_SESSION['foto'] = $info['foto'];
		$_SESSION['email'] = $info['email'];
		$_SESSION['parol'] = $info['parol'];

		echo'<meta http-equiv="refresh" content="0; URL=orders.php" >';
	}
}



// --------------------------INSERT----------------------------------


if(isset($_POST['r']))
{
	if($_POST['parol']!=$_POST['parol2'])
		{echo'<div class="alert alert-success" role="alert">
			Zehmet olmasa parolu tekrar duzgun daxil edin</div>';}
	else{

	if(!empty($_POST['uname']) && !empty($_POST['usurname'])
    && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['parol']))
	{
		$elaveet=mysqli_query($con, "INSERT INTO users(uname,usurname,tel,email,parol,tarix)
		VALUES('".$_POST['uname']."','".$_POST['usurname']."','".$_POST['tel']."','".$_POST['email']."','".$_POST['parol']."','".$tarix."')");

			if($elaveet==true)
            {echo'<div class="alert alert-success" role="alert">
              Qeydiyyat ugurla tamamlandi</div>';}

         else
            {echo'<div class="alert alert-success" role="alert">
              Qeydiyyat tamamlana bilmedi</div><br><br>';}
       }
      
    else
      {echo'<div class="alert alert-success" role="alert">
            Zehmet olmasa melumatlari yeniden yoxlayin</div>';}
	}
}

?>

<form method="post">
<b>Ad:</b><br>
<input type="text" name="uname" class="form-control"> <br>
<b>Soyad:</b><br>
<input type="text" name="usurname" class="form-control"> <br>
<b>Telefon:</b><br>
<input type="text" name="tel" class="form-control"> <br>
<b>E-mail:</b><br>
<input type="text" name="email" class="form-control"> <br>
<b>Parol:</b><br>
<input type="text" name="parol" class="form-control"> <br>
<b>Parolu tekrar daxil edin:</b><br>
<input type="text" name="parol2" class="form-control"> <br>

   <button type="submit" name="r" class="btn btn-primary btn-lg btn-block">Qeydiyyatdan kec</button>
</form>

</div>