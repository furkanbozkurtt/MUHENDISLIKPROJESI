 <!DOCTYPE html>
<html>
<head>
  <title>ŞİFRE UNUTTUM</title>
</head>
<body>
<form action="../kullanici/sifre_unut_kontrol.php"  method="POST">
<section>

<h1>Şifremi Unuttum</h1> <br>
<input class="giris-yap" type="text" name="tc" placeholder="T.C"/> 
<input  type="submit"id="button" name="gnder" value="GÖNDER" /> 
</section>
</form>







</body>
<style type="text/css">
  
section{
background:rgba(225, 225, 225, 0.4);
margin:10%auto;
width:300px;
padding:7%;
text-align:center;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
-webkit-box-shadow:0 0 65px rgba(0,0,0,0.2);
-moz-box-shadow:0 0 65px rgba(0,0,0,0.2);
box-shadow:0 0 65px rgba(0,0,0,0.2);
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

#button{
border:none;
padding:17px;
 
color:white;
letter-spacing:2px;
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