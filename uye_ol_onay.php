<?php

 $baglanti=mysql_connect("localhost","root") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");
 if(!empty($_POST["gnder"]))
{$tc=$_POST["tc"];  
 $ad=$_POST["ad"];
$soyad=$_POST["soyad"];
$tel=$_POST["tel"];
$email=$_POST["email"];
$adres=$_POST["adres"];
$sifre=$_POST["sifre"];
$s_tekrar=$_POST["s_tekrar"];
$dogum=$_POST["d_tarihi"];
if(  $email!="" && $sifre!="" && $s_tekrar!="" && $ad!="" && $soyad!="" && $dogum!="" && $adres!="")
{
  if(  strlen($tc) == "11" )
  {
    if(strlen($tel)== "11")
    {
 if(!empty($_POST["group1"]))
 {
 	 $secilen=$_POST["group1"];

$sorgu=mysql_query("select * from k_kaydi");
$i=0;
while ($yazdir=mysql_fetch_array($sorgu)) 
{
$metin1=strip_tags($yazdir['tc']);
if($tc==$metin1)
{
	$i++;
}

}
 
if($i=="0")
{
 mysql_query("INSERT INTO k_kaydi(tc,ad,soyad,dogum_tarih,cinsiyet,tel,email,sifre) VALUES ( '$tc','$ad','$soyad','$dogum','$secilen','$tel','$email','$sifre')",$baglanti) or die ("veritabanına eklenemedi".mysql_error());
  $mesaj="ÜYE KAYDI TAMAMLANMIŞTIR";
                       $mesaj ="<script>alert ('$mesaj');    
                   window.location.href='../index.php';
                         </script>" ;
                       echo $mesaj ;

}
else 
{
	$mm="TC NOYA AİT ÜYE BULUNMAKTADIR ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../uye_ol.php';
                         </script>" ;
                       echo $mesaj ;
}

}
else
{
	 $mm="CİNSİYET SEÇİNİZ ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../uye_ol.php';
                         </script>" ;
                       echo $mesaj ;
}

}

else
{
   $mm="TEL NOYU EKSİK GİRDİNİZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../uye_ol.php';
                         </script>" ;
                       echo $mesaj ;
}


}
else
{
   $mm="TC NOYU EKSİK GİRDİNİZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../uye_ol.php';
                         </script>" ;
                       echo $mesaj ;
}


}
else
{
   $mm="ALANLARI DOLDURUNUZ ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../uye_ol.php';
                         </script>" ;
                       echo $mesaj ;
}


}

?>