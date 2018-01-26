<?php 
if(!empty($_POST["gnder"]))
{
 $tc=$_POST["tc"];


$baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
   mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
  mysql_query("SET NAMES UTF8");

    $i=0;

	  $sorgu=mysql_query("select * from k_kaydi");
  

  while($yazdir=mysql_fetch_array($sorgu))
    {
      
    $metin1=strip_tags($yazdir['tc']);
   
    if($tc==$metin1 )
    { 
      $i++;
      $t_sifre=$yazdir['sifre'];
       $t_email=$yazdir['email'];

    }
  	 }

 
	 if($i=="0")
	  {  


 $sorgu = mysql_query("select * from kullanici ");
  $j=0;

  $veri=mysql_fetch_array($sorgu);
$admintc=$veri["tc"];
$kullanicisifre=$veri["kullanici_sifre"];
 $email=$veri["email"];     
   
   
    if($tc==$metin1 )
    { 
      $j++;
    }


   if($j=="0")
   {   $mm="GİRDİĞİNİZ TCYE AİT ÜYE BULUNMAMAKTADIR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../kullanici/sifre_unuttum.php';
                         </script>" ;
                       echo $mesaj ;}




else

{
     $konu="ŞİFRENİZ";
  $mailheader = "From: "."yollayacak mail adresi" ."\r\n";   //mail atıldığında gösterilecek mail adresi
  $mailheader .= "Reply-To: "."yollayacak mail adresi"."\r\n"; 
  $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
  $MESSAGE_BODY ="Sifreniz :".$k_sifre; 
  $mail=mail($email, $konu, $MESSAGE_BODY , $mailheader); 
              if($mail){    $mm="ŞİFRENİZ BAŞARIYLA GÖNDERİLMİŞTİR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../index.php';
                         </script>" ;
                       echo $mesaj ;
}

}



	 }
	 else
	 {
    $konu="ŞİFRENİZ";
  $mailheader = "From: "."yollayacak mail adresi" ."\r\n";   //mail atıldığında gösterilecek mail adresi
  $mailheader .= "Reply-To: "."yollayacak mail adresi"."\r\n"; 
  $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
  $MESSAGE_BODY ="Sifreniz :".$t_sifre; 
  $mail=mail($t_email, $konu, $MESSAGE_BODY , $mailheader); 
   if($mail){  $mm="ŞİFRENİZ BAŞARIYLA GÖNDERİLMİŞTİR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../index.php';
                         </script>" ;
                       echo $mesaj ;
	 }





		}}
?>