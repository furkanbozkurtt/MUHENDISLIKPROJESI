 <div style="width: 101%; margin:-6px; height:101%; font-size: 0.9em;" class="ui-widget ui-corner-all">
<div style="padding: 20px; margin:0px;" class="ui-widget-header ui-corner-top"></div>
<div style="padding: 0px; height:100%; margin:0px;" class="ui-widget-content ui-corner-bottom">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" />
<input name="SnapHostID" type="hidden" value="HNNRET58BNAG" />
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
<center>
<?php 

  $baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
 mysql_query("SET NAMES UTF8");
 session_start();


if (empty($_POST["gnder"])) {
	 $s_doktor=$_GET["d_sec"];	
$_SESSION['secilen_doktor']= $s_doktor;
echo"	<form action='../admin/d_rapor_detay.php'  method='POST'>
<section > <br>
  <p align='center' >  
   TARİH SEÇİNİZ
 
	<input type='date' name='tarih' size='25'>  
 &nbsp&nbsp&nbsp <input  type='submit' class='button' name='gnder' value='GÖZ AT' /></p> 
   	 
</section>
</form><hr><br><br><br><br><br><br>  ";

	}

if(!empty($_POST["gnder"])) {
				$secilen_doktor=$_SESSION['secilen_doktor'];
			 
		   $i=0;
$s_tarih=$_POST["tarih"];

$sql="select *from m_olan_tablo where d_tc='$secilen_doktor' and m_tarih='$s_tarih' ";
         $sonuc=mysql_query($sql);
         while($satir=mysql_fetch_assoc($sonuc))
         {
         	$i++;
         }




       $sql="select *from doktorkaydi where doktor_tc='$secilen_doktor'";
         $sonuc=mysql_query($sql);
 
 $satir=mysql_fetch_assoc($sonuc);
 
           
           
    
echo "
<br><br><br><br><br><br><br><br>
<table border='0'  cellpadding='10' cellspacing='0' valign='right' width='50%'>
<tr>
<td><b>TC:</b></td>
<td><input name='tc' type='text' value='$satir[doktor_tc]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b> </b></td>
 <td> </td>
</tr>
<tr>
<td><b>UNVAN:</b></td>
<td><input name='ad' type='text' value='$satir[doktor_unvan]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td><b></b></td>
<td></td>
</tr>
<tr>
<td><b>AD SOYAD:</b></td>
<td><input name='soyad' type='text' value='$satir[doktor_ad] $satir[doktor_soyad]'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>
<td> </td>
<td> </td>
</tr>
<tr>
<td><b>BAKILAN KİŞİ: </b><br>
 </td>
 <td><input name='d_tarih' type='text' value='$i'  maxlength='60' disabled='readonly' style='width:275px; border:1px solid #999999;' class='ui-corner-all' /></td>

 </tr>
<tr>
<td colspan='2' align='center'> 
 
<center></center>
</td></tr>
</table><br />
</form>
";
 






 
            } 
  

?>
 </center>
</div>
</div>