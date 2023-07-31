<?php
include"header.php";
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');

?>

<h2> <span class="badge badge-pill badge-Warning">Orders</span></h2>

<?php 


// 1) EDIT
// 2) UPDATE
// 3) DELETE
// 4) INSERT
// 5) SELECT


        // 1)---------------------------------EDIT---------------------------


if(isset($_POST['edit']))

{

    $sec=mysqli_query($con, "SELECT * FROM orders WHERE id='".$_POST['id']."'");
      $info=mysqli_fetch_array($sec);

    {echo'<div class="alert alert-success" role="alert">

        <form method="post">
        <h3>Redakte</h3>

           <b>Musteri:</b>
           <select name="clients_id" class="form-control">
           <option value="">Musterini secin</option>';

            $csec=mysqli_query($con, "SELECT * FROM clents ORDER BY ad ASC");
            while($cinfo = mysqli_fetch_array($csec))
        {
        

            if($info['clients_id']==$cinfo['id']){$x='selected';}

            else{$x='';}

            echo'<option '.$x.' value="'.$cinfo['id'].'">'.$cinfo['ad'].' '.$cinfo['soyad'].'</option>';

        }
        echo'
        </select><br>

    <b>Mehsul:</b>
         <select  name="producs_id" class="form-control">
   
    <option value=""><b>Mehsulu secin</b></option>';

           $psec=mysqli_query($con, "SELECT 
           producs.id,
           producs.ad AS mehsul,
           producs.miqdar,
           brands.ad AS brend
           FROM producs, brands
           WHERE producs.brand_id=brands.id
           ORDER BY producs.id DESC");
           while($pinfo = mysqli_fetch_array($psec))
        {

            if($info['producs_id']==$pinfo['id']){$x='selected';}

            else{$x='';}

            echo'<option '.$x.' value="'.$pinfo['id'].'">'.$pinfo['brend'].' - '.$pinfo['mehsul'].' ('.$pinfo['miqdar'].' eded qalib)</option>';
        }
        echo'

   </select><br>
   <b>Miqdar:</b><br>
   <input type="text" name="miqdar" value="'.$info['miqdar'].'" class="form-control">
   <br>
   <button type="submit" name="update" class="btn btn-primary btn-lg btn-block">Yenile</button><br>
 
   </form></div>';
   }

}


// 2)---------------------------------UPDATE---------------------------


   if(isset($_POST['update']))
   {   
    $clients_id=trim($_POST['clients_id']);
    $clients_id=strip_tags($clients_id);
    $clients_id=htmlspecialchars($clients_id);
    $clients_id=mysqli_real_escape_string($con, $clients_id);

    $producs_id=trim($_POST['producs_id']);
    $producs_id=strip_tags($producs_id);
    $producs_id=htmlspecialchars($producs_id);
    $producs_id=mysqli_real_escape_string($con, $producs_id);

    $miqdar=trim($_POST['miqdar']);
    $miqdar=strip_tags($miqdar);
    $miqdar=htmlspecialchars($miqdar);
    $miqdar=mysqli_real_escape_string($con, $miqdar);




    if(!empty($producs_id) && !empty($clients_id) && !empty($miqdar))
      {

         $yoxla=mysqli_query($con, "SELECT * FROM orders WHERE clients_id='".$clients_id."'");
         
         if(mysqli_num_rows($yoxla)==0)
        {
         $yenile=mysqli_query($con, "UPDATE orders SET 
          clients_id='".$clients_id."',
          producs_id='".$producs_id."',
          miqdar='".$miqdar."'
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
      $sec=mysqli_query($con, "SELECT * FROM orders WHERE id='".$_POST['id']."'");
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
      $delete=mysqli_query($con, "DELETE FROM orders WHERE id='".$_POST['id']."'");

      if($delete==true)
          {echo'<div class="alert alert-success" role="alert">
                Ugurla silindi</div>';}

      else
          {echo'<div class="alert alert-success" role="alert">
                Silmek mumkun olmadi</div>';}
   }




// 4)--------------------------INSERT----------------------------------

   if(isset($_POST['d1']))
   {  
        $clients_id=trim($_POST['clients_id']);
        $clients_id=strip_tags($clients_id);
        $clients_id=htmlspecialchars($clients_id);
        $clients_id=mysqli_real_escape_string($con, $clients_id);

        $producs_id=trim($_POST['producs_id']);
        $producs_id=strip_tags($producs_id);
        $producs_id=htmlspecialchars($producs_id);
        $producs_id=mysqli_real_escape_string($con, $producs_id);

        $miqdar=trim($_POST['miqdar']);
        $miqdar=strip_tags($miqdar);
        $miqdar=htmlspecialchars($miqdar);
        $miqdar=mysqli_real_escape_string($con, $miqdar);

    

       if(!empty($clients_id) && !empty($producs_id) && !empty($miqdar))
       { 
         

         $elaveet=mysqli_query($con, "INSERT INTO orders(clients_id,producs_id,miqdar,tarix)
         VALUES('".$clients_id."','".$producs_id."','".$miqdar."','".$tarix."')");

         if($elaveet==true)
            {echo'<div class="alert alert-success" role="alert">
                  Qeydiyyata alindi</div>';}

         else
            {echo'<div class="alert alert-success" role="alert">
             Melumatlar qeyde alinmadi</div>';}
         }
     
else
    {echo'<div class="alert alert-success" role="alert">
     Zehmet olmasa melumatlari yeniden yoxlayin</div>';}

   }



if(!isset($_POST['edit']))

{echo'<div class="alert alert-success" role="alert">

<form method="post">
   <b>Musteri:</b>
   <select name="clients_id" class="form-control">
   <option value="">Secilmeyib</option>';

    $csec=mysqli_query($con, "SELECT * FROM clents ORDER BY ad ASC");
     while($cinfo = mysqli_fetch_array($csec))
        {
            echo'<option value="'.$cinfo['id'].'">'.$cinfo['ad'].' '.$cinfo['soyad'].'</option>';
        }
        echo'
        </select><br>
    <b>Mehsul:</b>
         <select  name="producs_id" class="form-control">
   
   <option value=""><b>Secilmeyib</b></option>';

   $psec=mysqli_query($con, "SELECT 
   producs.id,
   producs.ad AS mehsul,
   producs.miqdar,
   brands.ad AS brend
   FROM producs, brands
   WHERE producs.brand_id=brands.id
   ORDER BY producs.id DESC");
     while($pinfo = mysqli_fetch_array($psec))
        {
            echo'<option value="'.$pinfo['id'].'">'.$pinfo['brend'].' - '.$pinfo['mehsul'].' ('.$pinfo['miqdar'].' eded qalib)</option>';
        }
        echo'

   </select><br>
   <b>Miqdar:</b><br>
   <input type="text" name="miqdar" class="form-control">
   <br>
   <button type="submit" name="d1" class="btn btn-primary btn-lg btn-block">Daxil et</button><br>
 
</form></div>';
}


	// 5)-----------------------------------SELECT------------------------------


if(isset($_POST['tesdiq']))
{
    if($_POST['smiq']<$_POST['pmiq'])
    {
        $pupdate = mysqli_query($con,"UPDATE producs SET miqdar=miqdar-".$_POST['smiq']." WHERE id='".$_POST['pid']."'");

        if($pupdate==true)
        {
            $supdate = mysqli_query($con,"UPDATE orders SET tesdiq=1 WHERE id='".$_POST['id']."'");

            if($supdate==true)
            {echo'<div class="alert alert-success" role="alert">Sifariş uğurla təsdiq edildi</div>';}
            else
            {
                echo'<div class="alert alert-danger" role="alert">Sifarişi təsdiq etmək mümkün olmadı</div>';

                $pupdate = mysqli_query($con,"UPDATE producs SET miqdar=miqdar+".$_POST['smiq']." WHERE id='".$_POST['pid']."'");

            }
        }
    }
    else
    {echo'<div class="alert alert-warning" role="alert">Sifarişi təsdiq etmək üçün anbarda kifayət qədər məhsul yoxdur</div>';}
}
  

if(isset($_POST['legv']))
{
   
        $pupdate = mysqli_query($con,"UPDATE producs SET miqdar=miqdar+".$_POST['smiq']." WHERE id='".$_POST['pid']."'");

        if($pupdate==true)
        {
            $supdate = mysqli_query($con,"UPDATE orders SET tesdiq=0 WHERE id='".$_POST['id']."'");

            if($supdate==true)
            {echo'<div class="alert alert-success" role="alert">Sifariş uğurla legv edildi</div>';}
            else
            {
                echo'<div class="alert alert-danger" role="alert">Sifarişi legv etmək mümkün olmadı</div>';

            }
        }
}


       $sec=mysqli_query($con, "SELECT 
       orders.id,
       clents.ad AS mushteri,
       clents.soyad,
       brands.ad AS marka,
       producs.ad AS cesid,
       producs.alish,
       producs.satish,
       orders.miqdar,
       orders.producs_id,
       orders.tesdiq,
       producs.miqdar AS stok,
       orders.tarix
       FROM orders, producs, clents, brands
       WHERE orders.producs_id=producs.id AND
       producs.brand_id=brands.id AND
       orders.clients_id=clents.id
       ORDER BY orders.id DESC");


       $say=mysqli_num_rows($sec);
       echo'<div class="alert alert-success" role="alert">
              Siyahida olan melumatlar: <b>'.$say.'</b> </div>';


        $ms=mysqli_query($con,"SELECT * FROM clents");
        $musteri=mysqli_num_rows($ms);

        $bs=mysqli_query($con,"SELECT * FROM brands");
        $brend=mysqli_num_rows($bs);

        $ps=mysqli_query($con,"SELECT * FROM producs");
        $ceshid=mysqli_num_rows($ps);

        $txerc = 0;

        $xsec=mysqli_query($con,"SELECT SUM(mebleg) AS tmebleg FROM xerc");
        $xinfo=mysqli_fetch_array($xsec);

        if($xinfo['tmebleg']>0)
        {$txerc = $xinfo['tmebleg'];}

         $psec=mysqli_query($con, "SELECT 
           producs.alish,
           producs.satish,
           producs.miqdar
           FROM producs, brands
           WHERE producs.brand_id=brands.id");

        while($pinfo = mysqli_fetch_array($psec))
        {
            $mehsul = $pinfo['miqdar'] + $mehsul;
            $talis = ($pinfo['alish'] * $pinfo['miqdar']) + $talis;
            $tsatis = ($pinfo['satish'] * $pinfo['miqdar']) + $tsatis;
        }

        $qazanc = $tsatis - $talis - $txerc;



        echo'<div class="alert alert-secondary" role="alert">
            <b>Musteri:</b> '.$musteri.' |
            <b>Brend:</b> '.$brend.'  |
            <b>Ceshid:</b> '.$ceshid.'  |
            <b>Mehsul:</b> '.$mehsul.'  |
            <b>Alish:</b> '.$talis.' |
            <b>Satish:</b> '.$tsatis.'   |
            <b>Xerc:</b> '.$txerc.' |
            <b>Sifarish:</b>   '.$say.'  |
            <b>Qazanc:</b> '.$qazanc.'    |
            <b>Cari qazanc:</b>  '.$cariqazanc.'  |

            </div>';

           $i=0;

           echo'<table class="table table-"=table>
                 <thead class="table table-dark">
                    <th>Sira</th>
                    <th>Musteri</th>
                    <th>Brend</th>
                    <th>Mehsul</th>
                    <th>Alish</th>
                    <th>Satish</th>
                    <th>Stok</th>
                    <th>Sifaris</th>
                    <th>Tarix</th>
                    <th>Secimler</th>
                 </thead>

                 <tbody>';

   while($info=mysqli_fetch_array($sec))
   {
   	 $i++;

       echo'<tr>';

 	 echo'<td>'.$i.')</td>';
    echo'<td>'.$info['mushteri'].' '.$info['soyad'].'</td>';
    echo'<td>'.$info['marka'].'</td>';
    echo'<td>'.$info['cesid'].'</td>';
    echo'<td>'.$info['alish'].' AZN</td>';
    echo'<td>'.$info['satish'].' AZN</td>';
     echo'<td>'.$info['stok'].' eded</td>';
    echo'<td>'.$info['miqdar'].' eded</td>';
    echo'<td>'.$info['tarix'].'</td>';
      
    echo' <td>
         <form method="post">
         <input type="hidden" name="musteri" value="'.$info['musteri'].'">
         <input type="hidden" name="mehsul" value="'.$info['mehsul'].'">

         <input type="hidden" name="id" value="'.$info['id'].'">
         <input type="hidden" name="pid" value="'.$info['producs_id'].'">
         <input type="hidden" name="smiq" value="'.$info['miqdar'].'">
         <input type="hidden" name="pmiq" value="'.$info['stok'].'">';


    if($info['tesdiq']==0)
    {
        echo'
         <button type="submit" name="edit"class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/></button>


         <button type="submit" name="delete" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
           </button>

        <button type="submit" name="tesdiq" class="btn btn-success btn-sm" title="Təsdiq et">
        <i class="bi bi-check"></i>
        </button>';
    }
    else
    {
        echo'
        <button type="submit" name="legv" class="btn btn-danger btn-sm" title="Ləğv et">
        <i class="bi bi-x"></i>
        </button>';
    }
     echo'
         </form> 
      </td>
      </tr>';
    }
     echo'</tbody>
      </table>';
    ?>

 </div>