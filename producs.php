<?php
        include"header.php";
        echo'<div class="container">';
        $tarix=date('Y-m-d H:i:s');
?>

<h2> <span class="badge badge-pill badge-Warning">Producs</span></h2>

<?php 
//FILTER START

        if($_GET['f1']=='ASC')
        {
            $order='ORDER BY brand_id ASC';
            $f1='<a href="?f1=DESC"><i class="bi bi-arrow-down-up"></i> A-Z</a>';
        }
        elseif ($_GET['f1']=='DESC')
        {
            $order='ORDER BY brand_id DESC';
            $f1='<a href="?f1=ASC"><i class="bi bi-arrow-down-up"></i> Z-A</a>';
        }
        else
            {$f1 = '<a href="?f1=ASC"><i class="bi bi-arrow-down-up"></i></a>';}


        if($_GET['f2']=='ASC')
        {
            $order='ORDER BY tarix ASC';
            $f2='<a href="?f2=DESC"><i class="bi bi-arrow-down-up"></i>Sona doğru</a>';
        }
        elseif ($_GET['f2']=='DESC')
        {
            $order='ORDER BY tarix DESC';
            $f2='<a href="?f2=ASC"><i class="bi bi-arrow-down-up"></i>Yeniyə doğru</a>';
        }
        else
            {$f2 = '<a href="?f2=ASC"><i class="bi bi-arrow-down-up"></i></a>';}

        if(!isset($_GET['f1']) && !isset($_GET['f2']))
        {
          $order='ORDER BY id DESC'; 
        }

//FILTER END


// 1) EDIT
// 2) UPDATE
// 3) DELETE
// 4) INSERT
// 5) SELECT



        // 1)---------------------------------EDIT---------------------------



   if(isset($_POST['edit']))
   {  	
       
          $sec=mysqli_query($con, "SELECT * FROM producs WHERE id='".$_POST['id']."'");
          $info=mysqli_fetch_array($sec);

          echo'<div class="alert alert-success" role="alert">
          <form method="post" enctype="multipart/form-data">

             <b>Brend:</b><br>
          <select name="brand_id" value="" class="form-control">

            <option value="">Brend seçin</option>';

            $bsec=mysqli_query($con, "SELECT * FROM brands ORDER BY ad ASC");
            while($binfo = mysqli_fetch_array($bsec))
            {
                if($info['brand_id']==$binfo['id']){$x='selected';}

            else{$x='';}

            echo'<option '.$x.' value="'.$binfo['id'].'">'.$binfo['ad'].'</option>';
        }
        echo'
        </select><br>

       <b>Ad</b><br>
       <input type="text" class="form-control" name="ad" value="'.$info['ad'].'">
       <b>Alish</b><br>
       <input type="text" class="form-control" name="alish" value="'.$info['alish'].'">
       <b>Satish</b><br>
       <input type="text" class="form-control" name="satish" value="'.$info['satish'].'">
       <b>Miqdar</b><br>
       <input type="text" class="form-control" name="miqdar" value="'.$info['miqdar'].'"><br>

       <input type="hidden" name="id" value="'.$info['id'].'">

       <button type="submit" name="update" class="btn btn-primary">Yenile</button>

      </form></div>';
   }






// 2)---------------------------------UPDATE---------------------------


   if(isset($_POST['update']))
   {   
    $ad=trim($_POST['ad']);
    $ad=strip_tags($ad);
    $ad=htmlspecialchars($ad);
    $ad=mysqli_real_escape_string($con, $ad);

    $alish=trim($_POST['alish']);
    $alish=strip_tags($alish);
    $alish=htmlspecialchars($alish);
    $alish=mysqli_real_escape_string($con, $alish);

    $satish=trim($_POST['satish']);
    $satish=strip_tags($satish);
    $satish=htmlspecialchars($satish);
    $satish=mysqli_real_escape_string($con, $satish);

    $miqdar=mysqli_real_escape_string($con, htmlspecialchars(strip_tags(trim($_POST['miqdar']))));
    $brand_id=mysqli_real_escape_string($con, htmlspecialchars(strip_tags(trim($_POST['brand_id']))));




       if(!empty($ad) && !empty($alish) && !empty($satish) && !empty($miqdar) && !empty($brand_id))
      {

         $yoxla=mysqli_query($con, "SELECT * FROM producs WHERE ad='.$ad.'");
         
        
        {
         $yenile=mysqli_query($con, "UPDATE producs SET 
         brand_id='".$brand_id."',
         ad='".$ad."',
         alish='".$alish."',
         satish='".$satish."',
         miqdar='".$miqdar."',
         photo='".$photo."'
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
           Zehmet olmasa xanalari tam doldurun</div>';}

   }





// 3)----------------------------DELETE--------------------------------



   if(isset($_POST['delete']))
   {
      $sec=mysqli_query($con, "SELECT * FROM producs WHERE id='".$_POST['id']."'");
      $info=mysqli_fetch_array($sec);

      echo'<div class="alert alert-success" role="alert">
         Silmek istediyinize eminsiniz? <br><br>

      <form method="post">
        <input type="hidden" name="id" value="'.$_POST['id'].'">
        <button type="submit" name="beli" class="btn btn-danger btn-lg btn-block">Beli</button>
        <button type="submit" name="xeyr" class="btn btn-success btn-lg btn-block">Xeyr</button>
      </form></div>';

   }


   if(isset($_POST['beli']))
   {
      $delete=mysqli_query($con, "DELETE FROM producs WHERE id='".$_POST['id']."'");

      if($delete==true)
          {echo'<div class="alert alert-success" role="alert">
                Melumatlar ugurla silindi</div><br><br>';}

      else
          {echo'<div class="alert alert-success" role="alert">
                Silmek mumkun olmadi</div><br><br>';}
   }



//SECILENLERI SIL

     if(isset($_POST['secsil']))
      {
      
       echo'<div class="alert alert-success" role="alert">
      
       <h6>Secilenleri silmek istediyinize eminsiniz?</h6><br>
       <form method="post">
         <button type="submit" name="belisil" class="btn btn-danger btn-sm btn-block" role="alert">Beli</button>
         <button type="submit" name="silme" class="btn btn-success btn-sm btn-block" role="alert">Xeyr</button>
         <input type="hidden" name="secim" value="'.$_POST['secim'].'">
       </form>

      </div><br>'
      ;}


   if(isset($_POST['belisil']) && count($_POST['secim'])>0)  
   {
     
      $sil=mysqli_query($con, "DELETE FROM producs WHERE id='".$_POST['secim'][$n]."'");
      for($n=0; $n<count($_POST['secim']); $n++)

      if($sil==true)

      {echo'<div class="alert alert-success" role="alert">Melumatlar ugurla silindi</div>';} 

      else
        {echo'Secilmisler siline bilmedi!';}  

   }
 

 //HAMSINI SIL

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
    $deleteall=mysqli_query($con, "DELETE FROM producs WHERE id='".$_POST['id']."'");

    if($deleteall==true)

      { echo'<div class="alert alert-success" role="alert">Butun melumatlar ugurla silindi</div>';}
       else
        {echo'Butun melumatlar siline bilmedi!';}   
   }





            // 4)--------------------------INSERT----------------------------------



   if(isset($_POST['d1']))
{  
    

   
    $ad=trim($_POST['ad']);
    $ad=strip_tags($ad);
    $ad=htmlspecialchars($ad);
    $ad=mysqli_real_escape_string($con, $ad);

    $alish=trim($_POST['alish']);
    $alish=strip_tags($alish);
    $alish=htmlspecialchars($alish);
    $alish=mysqli_real_escape_string($con, $alish);

    $satish=trim($_POST['satish']);
    $satish=strip_tags($satish);
    $satish=htmlspecialchars($satish);
    $satish=mysqli_real_escape_string($con, $satish);

    $miqdar=trim($_POST['miqdar']);
    $miqdar=strip_tags($miqdar);
    $miqdar=htmlspecialchars($miqdar);
    $miqdar=mysqli_real_escape_string($con, $miqdar);

    $brand_id=trim($_POST['brand_id']);
    $brand_id=strip_tags($brand_id);
    $brand_id=htmlspecialchars($brand_id);
    $brand_id=mysqli_real_escape_string($con, $brand_id);


    

       if(!empty($ad) && !empty($alish) && !empty($satish) && 
       !empty($miqdar) && !empty($brand_id))
    
         {
                include"upload.php";

                if(!isset($error))
                 {
                    $elaveet=mysqli_query($con, "INSERT INTO producs(brand_id,ad,alish,satish,miqdar,photo,tarix)
                 VALUES('".$brand_id."','".$ad."','".$alish."','".$satish."','".$miqdar."','".$unvan."','".$tarix."')");

                 if($elaveet==true)
                    {echo'<div class="alert alert-primary" role="alert">
                          Melumatlar qeydiyyata alindi</div><br><br>';}

                 else
                    {echo'<div class="alert alert-success" role="alert">
                     Melumatlar qeyde alinmadi</div><br><br>';}
                }
         
         }
    else
     
    {echo'<div class="alert alert-danger" role="alert">
          Zehmet olmasa melumatlari yeniden yoxlayin</div>';}

   }


if(!isset($_POST['edit']))

{echo'<div class="alert alert-success" role="alert">

<form method="post" enctype="multipart/form-data">
    <b>Brend:</b><br>
    <select name="brand_id" class="form-control">

        <option value="">Secilmeyib</option>';

        $bsec=mysqli_query($con, "SELECT * FROM brands ORDER BY ad ASC");
        while($binfo = mysqli_fetch_array($bsec))
        {
            echo'<option value="'.$binfo['id'].'">'.$binfo['ad'].'</option>';
        }
        echo'
   </select><br>
   <b>Mehsul ucun foto elave et:</b><br>
   <input type="file" name="photo" ><br><br>
   <b>Ad:</b><br>
   <input type="text" class="form-control" placeholder="Misal ucun: Koynek" name="ad"><br>
   <b>Alish:</b><br>
   <input type="text" class="form-control" placeholder="Misal ucun: 99" name="alish"><br>
   <b>Satish:</b><br>
   <input type="text" class="form-control" placeholder="Misal ucun: 199" name="satish"><br>
   <b>Miqdar:</b><br>
   <input type="text" class="form-control" placeholder="Misal ucun: 100 eded" name="miqdar"><br>

   <button type="submit" name="d1" class="btn btn-primary btn-lg btn-block">Ireli</button>
   
</form></div>';
}


	// 5)-----------------------------------SELECT------------------------------


   
   $sec=mysqli_query($con, "SELECT 
   producs.id,
   producs.ad AS mehsul,
   producs.alish,
   producs.satish,
   producs.miqdar,
   producs.photo,
   producs.tarix,
   brands.ad AS brend
   FROM producs, brands
   WHERE producs.brand_id=brands.id
   ORDER BY producs.id DESC");

   if($say=mysqli_num_rows($sec))
   {echo'<div class="alert alert-success" role="alert">
          Siyahida olan melumatlar: <b>'.$say.'</b> </div>';}



   $i=0;

    echo'<form method="post">';

   echo'<table class="table table-"=table>
         <thead class="table table-dark">
            
            <th><button type="submit" name="secsil" title="Secilenleri sil" class="btn btn-danger btn-sm"> <span aria-hidden="true">&times;</span></button></th>

            <th><button type="submit" name="hamisinisil" title="Hamisini sil" class="btn btn-danger btn-sm"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></span></button></th>
            
            <th>Logo</th>
            <th>Brend '.$f1.'</th>
            <th>Ad</th>
            <th>Alish</th>
            <th>Satish</th>
            <th>Miqdar</th>
            <th>Tarix '.$f2.'</th>
            <th>Secimler</th>
         </thead>

         <tbody>';

   while($info=mysqli_fetch_array($sec))
   {
   	 $i++;

       echo'<tr>';
    echo'<td><input type="checkbox" name="secim[]" value="'.$info['id'].'"><td>';
    echo' '.$i.')</td>';
    echo'<td><img style="width:45px; 55px; "src="'.$info['photo'].'"></td>';
    echo'<td>'.$info['brend'].'</td>';
    echo'<td>'.$info['mehsul'].'</td>';
    echo'<td>'.$info['alish'].' AZN</td>';
    echo'<td>'.$info['satish'].' AZN</td>';
    echo'<td>'.$info['miqdar'].' eded</td>';
    echo'<td>'.$info['tarix'].'</td>';
      
    echo' <td>
         <form method="post">
         <input type="hidden" name="ad" value="'.$info['ad'].'">
         <input type="hidden" name="alish" value="'.$info['alish'].'">
         <input type="hidden" name="satish" value="'.$info['satish'].'">
         <input type="hidden" name="miqdar" value="'.$info['miqdar'].'">
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