<?php

 $baglanti=mysql_connect("localhost","root") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");

if(!empty($_POST["uyeol"]))
{
header('Location:../uye_ol.php');
}
if(!empty($_POST["giris"]))
{

$tc=$_POST["k_adi"];
$sifre=$_POST["sifre"];
 if($tc!="" && $sifre!="")
 {

  $sorgu = mysql_query("select * from kullanici ");
$veri=mysql_fetch_array($sorgu);
$admintc=$veri["tc"];
$kullanicisifre=$veri["kullanici_sifre"];
    if($admintc==$tc)
    {
  if($kullanicisifre==$sifre)
    {
  header("location:../admin/admin_anasayfa.php");
    }
   else 
   {
    echo "ŞİFRE YANLIŞ";
    }

    }
   else
    { 
      $sorgu=mysql_query("select * from k_kaydi");
    $i=0;

  while($yazdir=mysql_fetch_array($sorgu))
    {
      
    $metin1=strip_tags($yazdir['tc']);
    @session_start();
    $_SESSION['tc'] = $tc ;
    if($tc==$metin1 )
    { 
      $i++;
      $t_sifre=$yazdir['sifre'];
    }

    }
    if($i=="0") 
    {
      echo "GİRDİĞİNİZ TC NUMARASINA AİT ÜYE BULUNMAMAKTADIR";
       header("refresh:2;url=../index.php");
    }
     if($i>"0")
     {
     if($sifre==$t_sifre)
      {
    echo "SAYFA YÜKLENİYOR";
    header("location:../kullanici/kullanicianasayfa.php");
      }
      else
        { 
          echo "ŞİFRE YANLIŞ TEKRAR DENEYİNİZ";
           header("refresh:2;url=anasayfa.php");
        }

         }

    }

}
    else {echo  "ALANLARI DOLDURUNUZ";}



}



 
?>