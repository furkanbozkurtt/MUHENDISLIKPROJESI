  <!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>İLETİŞİM</title>
<style type="text/css">
	label {
    display:block;
    margin-top:20px;
    letter-spacing:2px;
}
.body {
        box-shadow: 0 0 40px 2px rgba(0,0,0,0.4);
    display:block;
    margin:4% auto;
    width:576px;
    padding: 10px;
}

/* Centre the form within the page */
form {
    margin:0 auto;
    width:459px;
}

/* Style the text boxes */
input, textarea {
	width:439px;
	height:27px;
	background:#efefef;
	border:1px solid #dedede;
	padding:10px;
	margin-top:3px;
	font-size:0.9em;
	color:#3a3a3a;
}

textarea {
	height:213px;
	 font-size: 20px;
}

.textarea {

    width:439px;
    height:25px;
    background:#efefef;
    border:1px solid #dedede;
    padding:10px;
    margin-top:3px;
    font-size:0.9em;
    color:#3a3a3a;
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border-radius:5px;
}
input:focus, textarea:focus {
    border:1px solid #97d6eb;
}
#submit {
    width:127px;
    height:38px;
  
    margin-top:20px;
 
}

	#submit:hover {
	    opacity:.9;
	}

</style>
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
</head>

<body>

 
    <section class="body">
    <form action="../kullanici/iletisimkontrol.php" method="POST">
        
    <label>AD SOYAD</label>
    <input name="name" >
    <label>TEL</label>
    <input name="email"   onKeyPress="return sedeceSayi(event)">        
    <label>EMAİL</label>
    <input name="email" type="email"  >
            
    <label>MESAJ</label>
    <textarea name="message" id="textarea" ></textarea>
            
    <input id="submit" name="submit" type="submit" value="GÖNDER">
  
</form>
    </section>

  

</body>

</html>