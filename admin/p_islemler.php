<?php

$baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");

if(!empty($_POST["kaydet"]))
{

	$p_tc=$_POST['p_tc'];
$p_ad=$_POST['p_ad'];
$p_soyad=$_POST['p_soyad'];
$p_unvan=$_POST['p_unvan'];
$p_adres=$_POST['p_adres'];
$p_tel=$_POST['p_tel'];
 $p_email=$_POST['email'];

if( $p_ad!="" && $p_soyad!="" && $p_unvan!="" && $p_adres!="" ) 
{		 
	if(strlen($p_tc) == "11" && strlen($p_tel)== "11" )
	{
		$i=0;


  $sorgu=mysql_query("select * from personelkaydi");
  while($yazdir=mysql_fetch_array($sorgu)){
    $metin1=strip_tags($yazdir['personel_tc']);
 if($p_tc==$metin1 ){$i++;}
    }


$j=0;
      $sorgu = mysql_query("SELECT * FROM doktorkaydi");
       while($yazdir = mysql_fetch_array($sorgu))
       {
        $metin =strip_tags($yazdir['doktor_tc']);
      if($p_tc==$metin){$j++;}        
        }


        if($i>="1" || $j>="1"){echo "GİRDİĞİNİZ TC NUMARASINA AİT KAYIT BULUNMAKTADIR";}

        else{       	

      if($_FILES["resim"]["size"]<=1040*1024){
  
 if($_FILES["resim"]["type"]=="image/jpeg"){

    $dosya_adi=$_FILES["resim"]["name"]; 
    $yeni_ad="../personel foto/".$dosya_adi;
if(move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad))
{
  $tarihsaat=date("Y-m-d ");
      mysql_query("INSERT INTO personelkaydi(resim ,personel_tc,personel_ad, personel_soyad,personel_unvan,personel_adres,personel_tel,tarih,email) VALUES ( '$yeni_ad','$p_tc','$p_ad','$p_soyad','$p_unvan','$p_adres','$p_tel','$tarihsaat','$p_email')",$baglanti) or die ("veritabanına eklenemedi".mysql_error());


    $mm= "KAYIT İŞLEMİ TAMAMLANDI";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/admin_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;
            
        }
      }

else
  {

 $mm= "DOSYA TÜRÜ JPEG OLACAK";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/p_ekle.php';
                         </script>" ;
                       echo $mesaj ;


  }


      }
else { $mm= "DOSYA BOYUTU BÜYÜK";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/p_ekle.php';
                         </script>" ;
                       echo $mesaj ;}

        }
	}



		else{

 $mm=  "TC NO VEYA TEL NO EKSİK GİRDİNİZ"; 
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/p_ekle.php';
                         </script>" ;
                       echo $mesaj ;


			}


}
else 
	{


 $mm=  "BOŞ ALAN BIRAKMAYINIZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/admin_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;



	}

}



if(!empty($_GET["SIL_p"]))

{

    $id=$_GET["SIL_p"];

$sor=mysql_query( " delete from personelkaydi where id='$id'");
if($sor)
{
 $mm="İŞLEMİNİZ BAŞARIYLA GERÇEKLEŞTİRİLMİŞTİR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/admin_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;
}
}


if(!empty($_POST["duzelt"]))/////////////GUNCELLE BUTONA BASILDIĞINDA BURAYA GİRER
{
 session_start();
 	$id=$_SESSION["p_secilen"];
 $ad=$_POST["personelad"];
  $soyad=$_POST["personelsoyad"];
   $unvan=$_POST["personelunvan"];
    $tel=$_POST["personeltel"];
     $adres=$_POST["personeladres"];
   	$email=$_POST["email"];
 	$tarih= date("Y-m-d ");
if( strlen($tel) =="11")
{







 if($_FILES["resim"]["type"]=="")
{
 $sql="select * from personelkaydi where id='$id'";
  $sonuc=mysql_query($sql); 
    $yaz=mysql_fetch_assoc($sonuc);
    $yeni_ad=$yaz["resim"];
   $sorgu=mysql_query("update personelkaydi set   resim='$yeni_ad', personel_ad='$ad', personel_soyad='$soyad', personel_unvan='$unvan',personel_adres='$adres', personel_tel='$tel', email='$email',tarih='$tarih' where id='$id'");
if($sorgu){      
 

 $mm=" GÜNCELLEME İŞLEMİNİZ TAMAMLANDI";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/admin_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;


 }
 else
 {
  $mm="HATA OLUŞTU TEKRAR DENEYİNİZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_guncelle.php';
                         </script>" ;
                       echo $mesaj ;
 }

}





 else{

  if($_FILES["resim"]["size"]<1024*1024)
  {
if($_FILES["resim"]["type"]=="image/jpeg")
{

$dosya_adi=$_FILES["resim"]["name"];
 $yeni_ad="../personel foto/".$dosya_adi;
if(move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad))
{

$sorgu=mysql_query("update personelkaydi set   resim='$yeni_ad', personel_ad='$ad', personel_soyad='$soyad', personel_unvan='$unvan',personel_adres='$adres', personel_tel='$tel', email='$email',tarih='$tarih' where id='$id'");
if($sorgu){      
 

 $mm=" GÜNCELLEME İŞLEMİNİZ TAMAMLANDI";
                 			 $mesaj ="<script>alert ('$mm'); 		
         					 window.location.href='../admin/admin_anasayfa.php';
                       	 </script>" ;
                     	 echo $mesaj ;


 }



}


  
}
else {


 $mm= "DOSYA TÜRÜ JPEG OLACAK";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/p_guncelle.php';
                         </script>" ;
                       echo $mesaj ;


}



}

else
{
  $mm= "RESİM BOYUTU BÜYÜK";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/p_guncelle.php';
                         </script>" ;
                       echo $mesaj ;

}
}

}
 

  
}





?>