 
<html>

 <div style="width: 101%; margin:-6px; height:101%; font-size: 0.9em;" class="ui-widget ui-corner-all">
<div style="padding: 20px; margin:0px;" class="ui-widget-header ui-corner-top"></div>
<div style="padding: 0px; height:100%; margin:0px;" class="ui-widget-content ui-corner-bottom">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" />
<input name="SnapHostID" type="hidden" value="HNNRET58BNAG" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

 <link rel="stylesheet" href="büyüt.css"/>

<script src=  "büyüt.js"  ></script>
 <script type="text/javascript">



function ValidateForm(frm) {
if (frm.Name.value == "") {alert('Name is required.');frm.Name.focus();return false;}
if (frm.FromEmailAddress.value == "") {alert('Email address is required.');frm.FromEmailAddress.focus();return false;}
if (frm.FromEmailAddress.value.indexOf("@") < 1 || frm.FromEmailAddress.value.indexOf(".") < 1) {alert('Please enter a valid email address.');frm.FromEmailAddress.focus();return false;}
if (frm.Comments.value == "") {alert('Please enter comments or questions.');frm.Comments.focus();return false;}
if (frm.CaptchaCode.value == "") {alert('Enter web form code.');frm.CaptchaCode.focus();return false;}
return true; }
function ReloadCaptchaImage(captchaImageId) {
var obj = document.getElementById(captchaImageId);
var src = obj.src;
var date = new Date();
var pos = src.indexOf('&rad=');
if (pos >= 0) { src = src.substr(0, pos); }
obj.src = src + '&rad=' + date.getTime();
return false; }
</script>
<style type="text/css">
    input#button{
    width:80px; height:30px;  background:#59d2ed; border-radius:5px; color:#FFF
}
</style>
<form action="../doktor/muayene.php" id="ContactUsCaptchaWebForm" method="post" onsubmit="return ValidateForm(this);">

<?php 
$baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");
session_start();

if(!empty($_GET["SEC1"]))
{
 
$tc=$_GET["SEC1"];    ////gunluk muayene
$_SESSION["d_sec"]=$tc;
 $sql="select * from rhasta_tablo where h_tc='$tc'";
    $sonuc=mysql_query($sql); 
    $yaz=mysql_fetch_assoc($sonuc);
 
 
echo "

<table border='0' cellpadding='10' cellspacing='0' width='100%'>
<tr>
<td><b>TC:</b></td>
<td><input name='tc' type='text' value='$yaz[h_tc]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b>TEL:</b></td>
 <td><input name='tel' type='text' value='$yaz[tel]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
</tr>
<tr>
<td><b>AD:</b></td>
<td><input name='ad' type='text' value='$yaz[h_ad]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b>CİNSİYET:</b></td>
<td><input name='cinsiyet' type='text' value='$yaz[cinsiyet]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
</tr>
<tr>
<td><b>SOYAD:</b></td>
<td><input name='soyad' type='text' value='$yaz[h_soyad]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b>DOĞUM TARİHİ:</b></td>
<td><input name='d_tarih' type='text' value='$yaz[dogum_tarih]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>

</tr>
<tr>
<td><b>RAPOR: </b><br>
<td><textarea name='rapor'  rows='7' cols='40' style='width:275px; border:1px solid #999999;' class='ui-corner-all'></textarea></td>
 </td>
<td><b>RÖNTGEN: </b><br>

<td class='tdImg'> <a href='../röntgen/".$tc.".jpg'    rel='lyteshow[gallery]'  ><img src='../röntgen/".$tc.".jpg' style='width:229px;height:196px;'/></a> </td>
   
   
 </tr>
<tr>
<td colspan='2' align='center'> 
<table border='0' cellpadding='0' cellspacing='0'>
<tr valign='left'><input name='kaydet' type='submit'  id='button' style='widht:70px;' value='KAYDET' />
 </tr>
</table> 
<center></center>
</td></tr>
</table><br />
</form>
";
}


 if(!empty($_GET["SEC"]))   //Geçmiş için seçilen
 {
$tc=$_GET["SEC"];
 $_SESSION["d_sec"]=$tc;

 $sql="select * from m_olan_tablo where h_tc='$tc'";
    $sonuc=mysql_query($sql); 
    $yaz=mysql_fetch_assoc($sonuc);
 
echo "

<table border='0' cellpadding='10' cellspacing='0' width='100%'>
<tr>
<td><b>TC:</b></td>
<td><input name='tc' type='text' value='$yaz[h_tc]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b>TEL:</b></td>
 <td><input name='tel' type='text' value='$yaz[h_tel]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
</tr>
<tr>
<td><b>AD:</b></td>
<td><input name='ad' type='text' value='$yaz[h_ad]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b>CİNSİYET:</b></td>
<td><input name='cinsiyet' type='text' value='$yaz[cinsiyet]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
</tr>
<tr>
<td><b>SOYAD:</b></td>
<td><input name='soyad' type='text' value='$yaz[h_soyad]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b>DOĞUM TARİHİ:</b></td>
<td><input name='d_tarih' type='text' value='$yaz[d_tarih]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>

</tr>
<tr>
<td><b>RAPOR: </b><br>
<td><textarea name='g_rapor'  rows='7' cols='40' style='width:275px; border:1px solid #999999;' class='ui-corner-all'>$yaz[rapor]</textarea></td>
 </td>
<td><b>RÖNTGEN: </b><br>

<td class='tdImg'> <a href='../röntgen/".$tc.".jpg'    rel='lyteshow[gallery]'  ><img src='../röntgen/".$tc.".jpg' style='width:229px;height:196px;'/></a> </td>
   
   

   
 </tr>
<tr>
<td colspan='2' align='center'> 
<table border='0' cellpadding='0' cellspacing='0'>
<tr valign='left'><input name='kaydet1' type='submit'  id='button' style='widht:70px;' value='KAYDET' />
 </tr>
</table> 
<center></center>
</td></tr>
</table><br />
</form>
";
 

}




if (!empty($_POST["kaydet1"])) 
{
  
  $rapor=$_POST['g_rapor'];

$tc=$_SESSION["d_sec"];  ///doktorun seçtiği hasta 
 

$sorgu=mysql_query("update m_olan_tablo set rapor='$rapor' where h_tc='$tc'");


        $mm="İŞLEMİNİZ BAŞARIYLA GERÇEKLEŞTİRİLMİŞTİR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../doktor/d_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;
                     
}
if (!empty($_POST["kaydet"])) 
{
 
  $rapor=$_POST['rapor'];

$tc=$_SESSION["d_sec"];  ///doktorun seçtiği hasta 
 $sql="select * from rhasta_tablo where h_tc='$tc' ";
    $sonuc=mysql_query($sql); 
    $yaz=mysql_fetch_assoc($sonuc);
    $ad=$yaz["h_ad"];
    $soyad=$yaz["h_soyad"];
    $d_tarih=$yaz["dogum_tarih"];
    $cinsiyet=$yaz["cinsiyet"];
    $tel=$yaz["tel"];
    $d_tc=$yaz["doktor_tc"];
    $d_ad=$yaz["d_ad"];
    $d_soyad=$yaz["d_soyad"];
    $d_unvan=$yaz["d_unvan"];
   $m_tarih=date("Y-m-d");
 mysql_query("INSERT INTO m_olan_tablo(h_tc,h_ad,h_soyad,h_tel,d_tarih,cinsiyet,rapor,d_tc,d_ad,d_soyad,d_unvan,m_tarih) VALUES ('$tc','$ad','$soyad','$tel','d_tarih','$cinsiyet','$rapor','$d_tc','$d_ad','$d_soyad','$d_unvan','$m_tarih')",$baglanti)or die ("veritabanına eklenmedi".mysql_error());

        
    $sor=mysql_query( " delete from rhasta_tablo where h_tc='$tc' ");

  $sql="select * from rhasta_tablo where  doktor_tc='$d_tc'";

   $sonuc=mysql_query($sql);
 
    $satir=mysql_fetch_assoc($sonuc);
           
           
     

        $mm="İŞLEMİNİZ BAŞARIYLA GERÇEKLEŞTİRİLMİŞTİR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../doktor/d_anasayfa.php';
                         </script>" ;
                       echo $mesaj ;
                     

                  
                
   


}
 

?>
</div>
</div>
  
</html>