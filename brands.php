<?php
include"header.php";
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');

?>

<h2> <span class="badge badge-pill badge-Warning">Brands</span></h2>

<?php 

// 1) EDIT
// 2) UPDATE
// 3) DELETE
// 4) INSERT
// 5) SELECT

//FILTER START

if($_GET['f1']=='ASC')
{
    $order='ORDER BY brands.ad ASC';
    $f1='<a href="?f1=DESC"><i class="bi bi-arrow-down-up"></i> A-Z</a>';
}
elseif ($_GET['f1']=='DESC')
{
    $order='ORDER BY brands.ad DESC';
    $f1='<a href="?f1=ASC"><i class="bi bi-arrow-down-up"></i> Z-A</a>';
}
else
    {$f1 = '<a href="?f1=ASC"><i class="bi bi-arrow-down-up"></i></a>';}


if($_GET['f2']=='ASC')
{
    $order='ORDER BY brands.tarix ASC';
    $f2='<a href="?f2=DESC"><i class="bi bi-arrow-down-up"></i></a>';
}
elseif ($_GET['f2']=='DESC')
{
    $order='ORDER BY brands.tarix DESC';
    $f2='<a href="?f2=ASC"><i class="bi bi-arrow-down-up"></i></a>';
}
else
    {$f2 = '<a href="?f2=ASC"><i class="bi bi-arrow-down-up"></i></a>';}

if(!isset($_GET['f1']) && !isset($_GET['f2']))
{
  $order='ORDER BY brands.id DESC'; 
}

//FILTER END


           // 1)---------------------------------EDIT---------------------------



   if(isset($_POST['edit']))
   {
   

      $sec=mysqli_query($con, "SELECT * FROM brands WHERE id='".$_POST['id']."'");
      $info=mysqli_fetch_array($sec);

      echo'<div class="alert alert-success" role="alert">
      <form method="post">
       <b>Markanın logosunu dəyişmək üçün daxil ol:</b><br>
       <input type="file" name="photo" ><br><br>
      <b>Ad:</b><br>
      <input type="text" class="form-control" name="ad" value="'.$info['ad'].'"><br>
    
      <input type="hidden" name="id" value="'.$info['id'].'">
         <button type="submit" class="btn btn-primary" name="update">Yenile</button>

      </form></div>';
   }



            // 2)---------------------------------UPDATE---------------------------


   if(isset($_POST['update']))
   {   
      $ad=trim($_POST['ad']);
      $ad=strip_tags($ad);
      $ad=htmlspecialchars($ad);
      $ad=mysqli_real_escape_string($con, $ad);


      if(!empty($ad))
       { 

        $yoxla = mysqli_query($con,"SELECT * FROM brands WHERE ad='".$ad."' AND id!='".$_POST['id']."'");

        if(mysqli_num_rows($yoxla)==0)
        {

         $yenile=mysqli_query($con, "UPDATE brands SET 
         ad='".$ad."'
         WHERE id='".$_POST['id']."'");

         if($yenile==true)
             {echo'<div class="alert alert-success" role="alert">
                    Melumatlar yenilendi</div>';}

          else
             {echo'<div class="alert alert-success" role="alert">
                   Melumatlar yenilene bilmedi</div>';}
        }
        else
        {echo'<div class="alert alert-success" role="alert">
            Brend artiq movcuddur</div>';}

    }

   else
     {echo'<div class="alert alert-success" role="alert">
           Zehmet olmasa melumatlari yeniden yoxlayin</div>';}

   }




            // 3)----------------------------DELETE--------------------------------



   if(isset($_POST['delete']))
   {
      $sec=mysqli_query($con, "SELECT * FROM brands WHERE id='".$_POST['id']."'");
      $info=mysqli_fetch_array($sec);

      echo'<div class="alert alert-success" role="alert">
         '.$_POST['ad'].' markasini silmeye eminsiniz?<br>

      <form method="post">
        <input type="hidden" name="id" value="'.$_POST['id'].'">
        <button type="submit" class="btn btn-danger btn-lg btn-block" name="beli">Beli</button>
        <button type="submit" class="btn btn-success btn-lg btn-block" name="xeyr">Xeyr</button>
      </form></div>';

   }


   if(isset($_POST['beli']))
   {
      $delete=mysqli_query($con, "DELETE FROM brands WHERE id='".$_POST['id']."'");

      if($delete==true)
          {echo'<div class="alert alert-success" role="alert">
           Marka siyahidan ugurla cixarildi</div>';}

      else
          {echo'<div class="alert alert-success" role="alert">
               '.$info['ad'].' markani silmek mumkun olmadi</div>';}
   }

  if(isset($_POST['secsil']))
      {
       echo'<div class="alert alert-success" role="alert">
      
       <h6>Secilenleri silmeye eminsiniz?</h6><br>
       <form method="post">
         <button type="submit" name="belisil" class="btn btn-danger btn-sm btn-block" role="alert">Beli</button>
         <button type="submit" name="silme" class="btn btn-success btn-sm btn-block" role="alert">Xeyr</button>';

         for($i=0; $i<count($_POST['secim']); $i++)
         {echo'<input type="hidden" name="secim['.$i.']" value="'.$_POST['secim'][$i].'">';}

        echo'
       </form>
      </div><br>'
     ;}


   if(isset($_POST['belisil']) && count($_POST['secim'])>0)  
   {
      for($n=0; $n<count($_POST['secim']); $n++)
      {$sil=mysqli_query($con, "DELETE FROM brands WHERE id='".$_POST['secim'][$n]."'");}
      
      if($sil==true)

      {echo'<div class="alert alert-success" role="alert">Melumatlar ugurla silindi</div>';} 
   }


 if(isset($_POST['hamisinisil']))
      {
       echo'<div class="alert alert-success" role="alert">
      
       <h6>Butun melumatlari silmeye eminsiniz?</h6><br>
       <form method="post">
         <button type="submit" name="silbeli" class="btn btn-danger btn-sm btn-block" role="alert">Beli</button>
         <button type="submit" name="xeyrsilme" class="btn btn-success btn-sm btn-block" role="alert">Xeyr</button></form>
      </div><br>'
     ;}

   if(isset($_POST['silbeli']))
   {
    $deleteall=mysqli_query($con, "DELETE FROM brands");

    if($deleteall==true)

      { echo'<div class="alert alert-success" role="alert">Butun melumatlar ugurla silindi</div>';}
       else
        {echo'Butun melumatlar siline bilmedi!';}   
   }




            // 4)--------------------------INSERT----------------------------------


   if(isset($_POST['d1']))
   {  
      include"upload.php";

    $ad=trim($_POST['ad']);
    $ad=strip_tags($ad);
    $ad=htmlspecialchars($ad);
    $ad=mysqli_real_escape_string($con, $ad);

       if(!empty($ad) && !isset($error))
       {

        $yoxla = mysqli_query($con,"SELECT * FROM brands WHERE ad='".$ad."'");

        if(mysqli_num_rows($yoxla)==0)
        {
            $elaveet=mysqli_query($con, "INSERT INTO brands(ad,photo,tarix,user_id)
            VALUES('".$ad."','".$unvan."','".$tarix."','".$_SESSION['user_id']."')");

             if($elaveet==true)
                {echo'<div class="alert alert-success" role="alert">
                   Marka siyahiya elave edildi</div>';}

             else
                {echo'<div class="alert alert-success" role="alert">
                   Melumatlar qeyde alinmadi</div><br><br>';}
        }
        else
        {echo'<div class="alert alert-success" role="alert">
            Brend artiqv movcuddur</div>';}
    }

    else
      {echo'<div class="alert alert-success" role="alert">
            Zehmet olmasa melumatlari yeniden yoxlayin</div>';}

   }



if(!isset($_POST['edit']))

{echo'<div class="alert alert-success" role="alert">
<form method="post" enctype="multipart/form-data">
   <b>Marka elave et</b>
   <input type="text" class="form-control" name="ad" placeholder="Misal ucun: Apple"><br>
   <b>Markanın logosunu əlavə et:</b><br>
   <input type="file" name="photo" ><br><br>
   <button type="submit" name="d1" class="btn btn-primary btn-lg btn-block">Elave et</button>
   
</form></div>';

}



            // 5)-----------------------------------SELECT------------------------------

   
   
   $sec=mysqli_query($con, "SELECT * FROM users,brands 
    WHERE brands.user_id=users.id AND users.id='".$_SESSION['user_id']."' ".$order);
   if($say=mysqli_num_rows($sec))
   {echo'<div class="alert alert-success" role="alert">
          Qeydiyyatda olan brendlərin sayı: <b>'.$say.'</b></div>';}





   $i=0;

   echo'<form method="post">';


   echo'<table class="table table-"=table>
         <thead class="table table-dark">
            <th><button type="submit" name="secsil" class="btn btn-danger btn-sm"> <span aria-hidden="true">&times;</span></button></th>
          
           <th><button type="submit" name="hamisinisil" title="Hamisini sil" class="btn btn-danger btn-sm"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></span></button></th>
            <th>Logo</th>
            <th>Marka '.$f1.' </th>
            <th>Tarix '.$f2.' </th>
             <th>Parametrler</th>
           

         </thead>
         <tbody>';


   while($info=mysqli_fetch_array($sec))


   {
   	 $i++;

    echo'<tr>';

 	 echo'<td><input type="checkbox" name="secim[]" value="'.$info['id'].'"><td>';
    echo' '.$i.')</td>';
    echo'<td><img style="width:45px; 55px; "src="'.$info['photo'].'"></td>';
    echo'<td>'.$info['ad'].'</td>';
    echo'<td>'.$info['tarix'].'</td>';
    
    echo'
    <td>
         <form method="post">
         <input type="hidden" name="ad" value="'.$info['ad'].'">
         <input type="hidden" name="id" value="'.$info['id'].'">
         <button type="submit" name="edit"class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
</svg></button>
         
         <button type="submit" name="delete" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button>

         </form>
    </td>';
 	 echo'</tr>';
   }
   echo'</tbody>
      </table>';
?>

</div>