<?php
//images/elnur.jpg
$unvan='images/'.basename($_FILES['photo']['name']);

//jpg Jpg JPG
$tip=strtolower(pathinfo($unvan,PATHINFO_EXTENSION));

if($tip!='jpg' && $tip!='jpeg' && $tip!='png' && $tip!='gif')
{$error=1; echo'<div class="alert alert-success" role="alert">
				Yalniz bu formatlari yukleye bilersiz <b> 
				jpg, jpeg, png, gif</b></div>';}

if($_FILES['photo']['size'] > 5242880)
{$error=1; echo'<div class="alert alert-success" role="alert">
				Yuklediyiniz fayl maksimum <b>5 mb</b> teskil etmelidir
				</div>';}

if(!isset($error))
{
 $unvan='image/'.time().'.'.$tip;
 move_uploaded_file($_FILES['photo']['tmp_name'], $unvan);
}

?>