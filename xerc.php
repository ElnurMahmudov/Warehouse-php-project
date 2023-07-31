<?php
include"header.php";
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');
?>

<h2> <span class="badge badge-pill badge-Warning">Xerc</span></h2>

<?php 


// 1) EDIT
// 2) UPDATE
// 3) DELETE
// 4) INSERT
// 5) SELECT


// 1)---------------------------------EDIT---------------------------



   if(isset($_POST['edit']))
   {  	
   
      $sec=mysqli_query($con, "SELECT * FROM xerc WHERE id='".$_POST['id']."'");
      $info=mysqli_fetch_array($sec);

      echo'<div class="alert alert-success" role="alert">
      <form method="post">
       <b>Teyinat</b><br>
       <input type="text" class="form-control" name="teyinat" value="'.$info['teyinat'].'"><br>
       <b>Mebleg</b><br>
       <input type="text" class="form-control" name="mebleg" value="'.$info['mebleg'].'"><br><br>
       
       <input type="hidden" name="id" value="'.$info['id'].'">
       <button type="submit" name="update" class="btn btn-primary">Yenile</button>

      </form></div>';
   }






// 2)---------------------------------UPDATE---------------------------


   if(isset($_POST['update']))
   {   
    $teyinat=trim($_POST['teyinat']);
    $teyinat=strip_tags($teyinat);
    $teyinat=htmlspecialchars($teyinat);
    $teyinat=mysqli_real_escape_string($con, $teyinat);

    $mebleg=trim($_POST['mebleg']);
    $mebleg=strip_tags($mebleg);
    $mebleg=htmlspecialchars($mebleg);
    $mebleg=mysqli_real_escape_string($con, $mebleg);




    if(!empty($teyinat) && !empty($mebleg))
      {

         $yoxla=mysqli_query($con, "SELECT * FROM xerc WHERE teyinat='".$teyinat."'");
         
         if(mysqli_num_rows($yoxla)==0)
        {
         $yenile=mysqli_query($con, "UPDATE xerc SET 
         teyinat='".$teyinat."',
         mebleg='".$mebleg."'
         WHERE id='".$_POST['id']."'");

         if($yenile==true)
             {echo'<div class="alert alert-success" role="alert">
               Melumatlar yenilendi</div>';}

          else
             {echo'<div class="alert alert-success" role="alert">
                    Melumatlar yenilene bilmedi</div>';}

         }
     }
     
   else
     {echo'<div class="alert alert-success" role="alert">
           Zehmet olmasa xanalari tam dolduirun</div>';}

   }





// 3)----------------------------DELETE--------------------------------



   if(isset($_POST['delete']))
   {
      $sec=mysqli_query($con, "SELECT * FROM xerc WHERE id='".$_POST['id']."'");
      $info=mysqli_fetch_array($sec);

      echo'<div class="alert alert-success" role="alert">
         Seciminizi silmek istediyinize eminsiniz? <br><br>

      <form method="post">
        <input type="hidden" name="id" value="'.$_POST['id'].'">
        <button type="submit" name="beli" class="btn btn-danger btn-lg btn-block">Beli</button>
        <button type="submit" name="xeyr" class="btn btn-success btn-lg btn-block">Xeyr</button>
      </form></div>';

   }


   if(isset($_POST['beli']))
   {
      $delete=mysqli_query($con, "DELETE FROM xerc WHERE id='".$_POST['id']."'");

      if($delete==true)
          {echo'<div class="alert alert-success" role="alert">
                Ugurla silindi</div><br><br>';}

      else
          {echo'<div class="alert alert-success" role="alert">
                Silmek mumkun olmadi</div><br><br>';}
   }




// 4)--------------------------INSERT----------------------------------


   if(isset($_POST['d1']))
   {  
    $teyinat=trim($_POST['teyinat']);
    $teyinat=strip_tags($teyinat);
    $teyinat=htmlspecialchars($teyinat);
    $teyinat=mysqli_real_escape_string($con, $teyinat);

    $mebleg=trim($_POST['mebleg']);
    $mebleg=strip_tags($mebleg);
    $mebleg=htmlspecialchars($mebleg);
    $mebleg=mysqli_real_escape_string($con, $mebleg);

    

       if(!empty($teyinat) && !empty($mebleg))
       { 
         

         $elaveet=mysqli_query($con, "INSERT INTO xerc(teyinat,mebleg,tarix)
         VALUES('".$teyinat."','".$mebleg."','".$tarix."')");

         if($elaveet==true)
            {echo'<div class="alert alert-success" role="alert">
                  Qeydiyyata alindi</div><br><br>';}

         else
            {echo'<div class="alert alert-success" role="alert">
             Melumatlar qeyde alinmadi</div><br><br>';}
         }
     

   }


if(!isset($_POST['edit']))

{echo'<div class="alert alert-success" role="alert">

<form method="post">

   <b>Teyinat:</b><br>
   <input type="text" class="form-control" placeholder="Misal ucun: Kredit" name="teyinat"><br>
   <b>Mebleg:</b><br>
   <input type="text" class="form-control" placeholder="Misal ucun: 1000" name="mebleg"><br><br>

   <button type="submit" name="d1" class="btn btn-primary btn-lg btn-block">Ireli</button>
   
</form></div>';
}


	// 5)-----------------------------------SELECT------------------------------


   
   $sec=mysqli_query($con, "SELECT * FROM xerc ORDER BY id DESC");
   if($say=mysqli_num_rows($sec))
   {echo'<div class="alert alert-success" role="alert">
          Siyahida olan melumatlar: <b>'.$say.'</b> </div>';}

   $i=0;

   echo'<table class="table table-"=table>
         <thead class="table table-dark">
            <th>Sira</th>
            <th>Teyinat</th>
            <th>Mebleg</th>
            <th>Tarix</th>
            <th>Secimler</th>
         </thead>

         <tbody>';

   while($info=mysqli_fetch_array($sec))
   {
   	 $i++;

       echo'<tr>';

 	 echo'<td>'.$i.')</td>';
    echo'<td>'.$info['teyinat'].'</td>';
    echo'<td>'.$info['mebleg'].'</td>';
    echo'<td>'.$tarix.'</td>';
      
    echo' <td>
         <form method="post">
         <input type="hidden" name="teyinat" value="'.$info['teyinat'].'">
         <input type="hidden" name="mebleg" value="'.$info['mebleg'].'">
         <input type="hidden" name="id" value="'.$info['id'].'">

         <button type="submit" name="edit"class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/></button>


         <button type="submit" name="delete" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
           </button>
         </form> 
      </td>';
       echo'</tr>';
    }
     echo'</tbody>
      </table>';
    ?>

 </div>