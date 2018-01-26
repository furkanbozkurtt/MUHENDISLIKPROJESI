<?php
session_start();
 $baglanti=mysql_connect("localhost","root") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");




if(!empty($_POST["uyeol"]))
{
header('Location:../uye_ol.php');
}

if(!empty($_POST["giris"]))
{
  $simdi=date("Y-m-d");                           ///burda günlük randevular siliniyor
$sql="select * from rhasta_tablo ";
   $sonuc=mysql_query($sql);
 
     while($satir=mysql_fetch_assoc($sonuc))
     {  
      $m_tarih=$satir["r_tarih"];
      $h_tc=$satir["h_tc"];
  if (strtotime($m_tarih) < strtotime($simdi))  
  { 

   mysql_query( " delete from rhasta_tablo  where h_tc='$h_tc'");
   

   }
  }


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

 $mm="ŞİFRE YANLIŞ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../index.php';
                         </script>" ;
                       echo $mesaj ;
 }
   }
   else
    { 
      $sorgu=mysql_query("select * from k_kaydi");
    $i=0;

  while($yazdir=mysql_fetch_array($sorgu))
    {
      
    $metin1=strip_tags($yazdir['tc']);
   
    $_SESSION['tc'] = $tc ;
    if($tc==$metin1 )
    { 
      $i++;
      $t_sifre=$yazdir['sifre'];
    }

    }

    if($i=="0") 
    {





$sorgu=mysql_query("select * from doktorkaydi");
 $i=0;
 while($yazdir=mysql_fetch_array($sorgu))
    {
      
    $metin2=strip_tags($yazdir['doktor_tc']);
    if($tc==$metin2 )
    { 
      $i++;
      $t_sifre=$yazdir['sifre'];
      $_SESSION['giren_tc']=$tc;  /////doktoru global tanımlandı
    }

    }

if($i=="0") {
   $mm= "GİRDİĞİNİZ TC NUMARASINA AİT ÜYE BULUNMAMAKTADIR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../index.php';
                         </script>" ;
                       echo $mesaj ;
}
else 
{
echo "SAYFA YÜKLENİYOR";

    header("location:../doktor/d_anasayfa.php");

}

       






    }




     else
     {


      echo $i;
     if($sifre==$t_sifre)
      {
    echo "SAYFA YÜKLENİYOR";

    header("location:../kullanici/kullanicianasayfa.php");
      }
      else
        { 

 $mm="ŞİFRE YANLIŞ TEKRAR DENEYİNİZ";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../index.php';
                         </script>" ;
                       echo $mesaj ;


        }

         }

    }

}
    else 
  {
$mm= "ALANLARI DOLDURUNUZ";

                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../index.php';
                         </script>" ;
                       echo $mesaj ;
  
  }



}



 
?>