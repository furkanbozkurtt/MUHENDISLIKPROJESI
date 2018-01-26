<?php
if(!empty($_POST["yolla"]))
{
 $ad=$_POST["ad"];
 $email=$_POST["email"];
 $tel=$_POST["tel"];
$konu=$_POST["konu"];
$mesaj=$_POST["mesaj"];


 
    $mailheader = "From: ". $email."\r\n";   //mail atıldığında gösterilecek mail adresi
    $mailheader .= "Reply-To: ".$$email."\r\n"; 
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    $MESSAGE_BODY ="Sifreniz :".$mesaj; 
    $mail=mail("akifabi74@hotmail.com", $konu, $MESSAGE_BODY , $mailheader); 
                if($mail){  echo "ŞİFRENİZ BAŞARIYLA GÖNDERİLMİŞTİR <br>"; 
                     header("refresh:2;url=../index.php"); 


}

}
?>