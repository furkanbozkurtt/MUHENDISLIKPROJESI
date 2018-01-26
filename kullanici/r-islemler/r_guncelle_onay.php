<?php

session_start();
        $tc=$_SESSION['tc']; //kullanicinin tcsi
               $baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");

if (!empty($_POST["btn"])) 
{

$saat=$_POST["btn"];
$_SESSION["g_saat"]=$saat;
$d_ilk=$_SESSION["secilen_d_id"];

$d_id=$_SESSION["g_doktor_id"];
$tarih=$_SESSION["g_tarih"];

$sql="select * from doktorkaydi where doktorid='$d_id'"; //seçilen doktor
 $sonuc=mysql_query($sql); 
 $yaz=mysql_fetch_assoc($sonuc);  

 $d_ad=$yaz["doktor_ad"];
$d_soyad=$yaz["doktor_soyad"];
$d_tc=$yaz["doktor_tc"];
$kisi=$yaz["kisi"]; 
 
  

$sql="select * from k_kaydi where tc='$tc' ";

$sonuc=mysql_query($sql); 
 $yaz=mysql_fetch_assoc($sonuc);
 $h_tc=$yaz["tc"];
 $h_ad=$yaz["ad"];
$h_soyad=$yaz["soyad"];
$h_dtarih=$yaz["dogum_tarih"];
$h_cinsiyet=$yaz["cinsiyet"];
$h_tel=$yaz["tel"];

echo '
<form action="r_guncelle_onay.php" method="POST" >
<table class="table-fill">
<thead>
 
</thead>
<tbody class="table-hover">
<tr>
<td class="text-left">Hekim Adı</td>
<td class="text-left">'.$d_ad.' '.$d_soyad.'</td>

</tr>
 <tr>
<td class="text-left">Randevu Zamanı</td>
<td class="text-left">'.$tarih.' '.$saat.' </td>

</tr>
<tr>
<td class="text-left">Hasta TC. Kimlik No </td>
<td class="text-left">'.$h_tc.'</td>

</tr>
<tr>
<td class="text-left">Hasta Ad Soyad</td>
<td class="text-left">'.$h_ad.' '.$h_soyad.'</td>

</tr>

<tr>
<td class="text-left">Hasta Cinsiyeti</td>
<td class="text-left">'.$h_cinsiyet.'</td>

</tr>
 <tr>
<td class="text-left">Hasta Doğum Tarihi </td>
<td class="text-left">'.$h_dtarih.'</td>

</tr>
 <tr>
<td class="text-left">Hasta Tel. No </td>
<td class="text-left">'.$h_tel.'</td>

</tr>
 <tr>
<td class="text-right"> </td>
<td class="text-left"> <input type="submit" name="kaydet" value="KAYDET" > 
      <input type="submit"   name="iptal" value="İPTAL"></td>

</tr>

</tbody>
</table>
</form>
';







}
    if(!empty($_POST["iptal"]))
    {
        $mm="İŞLEMİNİZ İPTAL EDİLDİ";
                  $mesaj ="<script>alert ('$mm');
                    window.location.href='../kullanicianasayfa.php';
                        </script>" ;
                      echo $mesaj ;
    }

if(!empty($_POST["kaydet"]))
{
 
$saat= $_SESSION["g_saat"];
$d_ilk=$_SESSION["r_s_d_tc"];
$d_id=$_SESSION["g_doktor_id"];
$tarih=$_SESSION["g_tarih"];

$sql="select * from doktorkaydi where doktor_tc='$d_ilk'";
                     $sonuc=mysql_query($sql); 
                    $yaz=mysql_fetch_assoc($sonuc);
                    $kisi1=$yaz["kisi"];
                    $kisi1--;
                     mysql_query("UPDATE doktorkaydi set kisi='$kisi1' where  doktor_ilk='$d_ilk'");   



$sql="select * from doktorkaydi where doktorid='$d_id'";
                     $sonuc=mysql_query($sql); 
                    $yaz=mysql_fetch_assoc($sonuc);
                      $d_tc=$yaz["doktor_tc"];
                    $_SESSION['r_s_d_tc']=""; ////randevu aldaki doktor tc iptal ediliyor
                    $_SESSION['g_s_d_tc']=$d_tc;
                    $d_ad=$yaz["doktor_ad"];

          $d_soyad=$yaz["doktor_soyad"];
          $d_tc=$yaz["doktor_tc"];
          $kisi=$yaz["kisi"]; 
           $d_unvan=$yaz["doktor_unvan"];
                    $kisi=$yaz["kisi"];
                    $kisi++;

 mysql_query("UPDATE doktorkaydi set kisi='$kisi' where doktorid='$d_id'");  
 mysql_query("UPDATE rhasta_tablo set doktorid='$d_id',doktor_tc='$d_tc',d_ad='$d_ad',d_soyad='$d_soyad',d_unvan='$d_unvan' , r_tarih='$tarih' ,r_saat='$saat', kisi='$kisi' where h_tc='$tc'");     
    
    if(empty($yaz))
              {
           $mm="RANDEVU ALINIZ";
                  $mesaj ="<script>alert ('$mm');
                    window.location.href='r_guncelle.php';
                        </script>" ;
                      echo $mesaj ;
                          }
          if(!empty($yaz))  
              {
                    $mm="DOKTOR DEĞİŞTİRİLMİŞTİR";
                  $mesaj ="<script>alert ('$mm');
                    window.location.href='../kullanicianasayfa.php';
                        </script>" ;
                      echo $mesaj ;
                          }
         
}

?>
<style type="text/css">
  div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}


/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:black;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
 
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
 
tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}


 </style>
</style>