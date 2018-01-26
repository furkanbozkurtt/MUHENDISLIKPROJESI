 
<html>
<head>
  <title></title>
</head>
<body>
<script type="text/javascript" language="javascript">
   function sedeceSayi(evt) {
      evt = (evt) ? evt : window.event
      var charCode = (evt.which) ? evt.which : evt.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false
   }
   return true
}
</script>
<form action="../uye_ol_onay.php"  method="POST">
<section >
 <table  cellspacing="8" >
 
 <tr ><td>TC NO</td>
 <td ><input id="text" type="text" name="tc" onKeyPress="return sedeceSayi(event)"  size="25" /></td>
  <td  >EMAİL</td>
 <td  ><input id="text" type="text" name="email"  size="25" /></td>
 </tr>
 <tr><td>AD</td>
 <td><input id="text" type="text" name="ad" size="25"  /></td>
<td>ŞİFRE</td>
 <td><input id="text" type="text" name="sifre"  size="25" /></td>
 </tr>
  <tr><td>SOYAD</td>
 <td><input id="text" type="text" size="25" name="soyad"  /></td>
 <td>ŞİFRE(Tekrar)</td>
 <td><input id="text" type="text" size="25" name="s_tekrar"    /></td>
 </tr>
  <tr> <td>TEL</td>
 <td><input id="text" type="text" size="25" name="tel" onKeyPress="return sedeceSayi(event)" placeholder="T.C"/></td>
<td>D. TARİHİ</td>
<td>
	<input id="text" type="date" name="d_tarihi" size="25">

</td>
 </tr> 
 <tr><td>CİNSİYET</td>
  <td width=>  <input type="radio" name="group1" value="bay">  &nbspBAY 
<input type="radio" name="group1" value="bayan" > &nbspBAYAN </td>
 <td>ADRES</td>
 <td><textarea id="text" name="adres" rows="4" cols="30" size="25">
</textarea></td>
  	
 </tr>
 <tr></tr>
   <tr>
   	<td></td>
   	<td><input  type="submit" class="button" name="gnder" value="GÖNDER" />  </td>
   	<td></td>
   </tr>

 </table>
 


</section>
</form>
 
</body>

<style type="text/css">
  
section{
    padding-right: 11px;
    padding-bottom: 121px;
    padding-top: 10px;
background:rgba(133,133,133, 0.4);
margin:8%auto;
width:50%;
height: 270px;
padding:8%;
text-align:left;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
-webkit-box-shadow:0 0 65px rgba(0,0,0,0.2);
-moz-box-shadow:0 0 65px rgba(0,0,0,0.2);
box-shadow:0 0 65px rgba(0,0,0,0.2);
}
#text
{
	margin:0px 0px 0px 0px;
 width: 70%;
padding:10px;
outline:none;
border-radius: 4px;
border:none;
}
.giris-yap {
margin:5px 5px 15px 5px;
width:70%;
padding:10px;
outline:none;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
border:none;
 
 
color:#fff;
transition: all .3s ease-in-out;
-moz-transition: all .3s ease-in-out;
-webkit-transition: all .3s ease-in-out;
}

.giris-yap:focus {
background:#fff;
transition: all .3s ease-in-out;
-moz-transition: all .3s ease-in-out;
-webkit-transition: all .3s ease-in-out;
color:#1d2b37;
}

.button{
border:none;
padding:17px;
 
color:white;
letter-spacing:5px;
text-shadow:1px 1px 0px rgba(0, 0, 0, 0.5);
cursor:pointer;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
margin-top:5px;
font-family: Helvetica, serif;
background: #fff6e4;
background: -moz-linear-gradient(top,#8b9da9 0%, #687e8d 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8b9da9), color-stop(100%,#687e8d));
background: -webkit-linear-gradient(top,#8b9da9 0%,#687e8d 100%);
background: -o-linear-gradient(top,#8b9da9 0%,#687e8d 100%);
background: -ms-linear-gradient(top,#8b9da9 0%,#687e8d 100%);
background: linear-gradient(to bottom,#8b9da9 0%,#687e8d 100%);
}

button:active {
box-shadow:inset 0px 2px 1px rgba(0, 0, 0, 0.4);
}

 
 
 

</style>
</html>