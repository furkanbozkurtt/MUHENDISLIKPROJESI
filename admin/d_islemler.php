<?php
$baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");

if(!empty($_POST["kaydet"]))
{

	$d_tc=$_POST['d_tc'];
$d_ad=$_POST['d_ad'];
$d_soyad=$_POST['d_soyad'];
$d_unvan=$_POST['d_unvan'];
$d_adres=$_POST['d_adres'];
$d_tel=$_POST['d_tel'];
 $d_email=$_POST['email'];

if( $d_ad!="" && $d_soyad!="" && $d_unvan!="" && $d_adres!="" ) 
{		
	if(  strlen($d_tc) == "11" && strlen($d_tel)== "11" )
	{
		$i=0;
  $sorgu=mysql_query("select * from personelkaydi");
  while($yazdir=mysql_fetch_array($sorgu)){
    $metin1=strip_tags($yazdir['personel_tc']);
 if($d_tc==$metin1 ){$i++;}
    }
$j=0;
      $sorgu = mysql_query("SELECT * FROM doktorkaydi");
       while($yazdir = mysql_fetch_array($sorgu))
       {
        $metin =strip_tags($yazdir['doktor_tc']);
      if($d_tc==$metin){$j++;}        
        }
        if($i>="1" || $j>="1"){echo "GİRDİĞİNİZ TC NUMARASINA AİT KAYIT BULUNMAKTADIR";}
  else{       	
      if($_FILES["resim"]["size"]<=1040*1024)
      {
  
 if($_FILES["resim"]["type"]=="image/jpeg")
 {    $sifre="123456";
    $dosya_adi=$_FILES["resim"]["name"]; 
    $yeni_ad="../doktor foto/".$dosya_adi;
if(move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad))
{
  $tarihsaat=date("Y-m-d ");
      mysql_query("INSERT INTO doktorkaydi(resim ,doktor_tc, doktor_ad, doktor_soyad,doktor_unvan,doktor_adres,doktor_tel,tarih,email,sifre,kisi) 
        VALUES ( '$yeni_ad','$d_tc','$d_ad','$d_soyad','$d_unvan','$d_adres','$d_tel','$tarihsaat','$d_email','$sifre','0')",$baglanti)
         or die ("veritabanına eklenemedi".mysql_error());
           $sql='select *from doktorkaydi order by doktorid DESC LIMIT 1';   //son eklenen doktorun bilgilerini almak için
         $sonuc=mysql_query($sql);
           while($satir=mysql_fetch_assoc($sonuc))
              {
            $id=$satir["doktorid"];
            $doktor_ad=$satir["doktor_ad"];
            $doktor_soyad=$satir["doktor_soyad"];          
            $doktor_unvan=$satir["doktor_unvan"];
              } 
          $i=0; 
 $mm="İŞLEMİNİZ BAŞARIYLA GERÇEKLEŞTİRİLMİŞTİR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/admin_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;            
        }
      }

else { 
 $mm="RESİM TÜRÜ JPEG OLACAK";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_ekle.php';
                         </script>" ;
                       echo $mesaj ;


}


      }
else {

 $mm="RESİM BOYUTU BÜYÜK";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_ekle.php';
                         </script>" ;
                       echo $mesaj ;
}

        }
	}



		else{ 

 $mm= "TC NO VEYA TEL NO EKSİK GİRDİNİZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_ekle.php';
                         </script>" ;
                       echo $mesaj ;



			}


}
else 
	{
 
     $mm= "BOŞ ALAN BIRAKMAYINIZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_ekle.php';
                         </script>" ;
                       echo $mesaj ;
	}

}


if(!empty($_GET["SIL"]))  
{

   $id=$_GET["SIL"];

$sor=mysql_query( " delete from doktorkaydi where doktorid='$id'");
if($sor){
 $mm="İŞLEMİNİZ BAŞARIYLA GERÇEKLEŞTİRİLMİŞTİR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/admin_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;
}
 
}


if(!empty($_POST["duzelt"]))/////////////GUNCELLE BUTONA BASILDIĞINDA BURAYA GELİR
{
 session_start();
 	$id=$_SESSION["secilen"];
 $ad=$_POST["doktorad"];
  $soyad=$_POST["doktorsoyad"];
   $unvan=$_POST["doktorunvan"];
    $tel=$_POST["doktortel"];
     $adres=$_POST["doktoradres"];
   	$email=$_POST["email"];
 	$tarih= date("Y-m-d ");
if( strlen($tel) =="11")
{
 if($_FILES["resim"]["type"]=="")
{
 $sql="select * from doktorkaydi where doktorid='$id'";
 $sonuc=mysql_query($sql); 
 $yaz=mysql_fetch_assoc($sonuc);
 $yeni_ad=$yaz["resim"];
$sorgu=mysql_query("update doktorkaydi set   resim='$yeni_ad', doktor_ad='$ad', doktor_soyad='$soyad', doktor_unvan='$unvan',doktor_adres='$adres', 
  doktor_tel='$tel', email='$email',tarih='$tarih' where doktorid='$id'");
if($sorgu)
{      
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

else

{

  if($_FILES["resim"]["size"]<1024*1024)
  {


if($_FILES["resim"]["type"]=="image/jpeg")
{

$dosya_adi=$_FILES["resim"]["name"];
 $yeni_ad="../doktor foto/".$dosya_adi;
if(move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad)){

$sorgu=mysql_query("update doktorkaydi set   resim='$yeni_ad', doktor_ad='$ad', doktor_soyad='$soyad', doktor_unvan='$unvan',doktor_adres='$adres', doktor_tel='$tel', email='$email',tarih='$tarih' where doktorid='$id'");
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


  
}


else {  
 $mm="DOSYA TÜRÜ JPEG OLACAK";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_guncelle.php';
                         </script>" ;
                       echo $mesaj ;


}



}

else
{
   $mm="RESİM BOYUTU BÜYÜK TEKRAR DENEYİNİZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_guncelle.php';
                         </script>" ;
                       echo $mesaj ;
}




}


}
 
else
{
   $mm="TEL NOYU EKSİK GİRDİNİZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../admin/d_guncelle.php';
                         </script>" ;
                       echo $mesaj ;
}
  
}








?>