<?php 
if(!empty($_POST["gnder"]))
{
 $tc=$_POST["tc"];


$baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
   mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
  mysql_query("SET NAMES UTF8");

 $sorgu=mysql_query("select * from k_kaydi");
    $i=0;

  while($yazdir=mysql_fetch_array($sorgu))
    {
      
    $metin1=strip_tags($yazdir['tc']);
   
    if($tc==$metin1 )
    { 
      $i++;
      $t_sifre=$yazdir['email'];
    }
	 }
	  $sorgu=mysql_query("select * from kullanici");
  

  while($yazdir=mysql_fetch_array($sorgu))
    {
      
    $metin1=strip_tags($yazdir['tc']);
   
    if($tc==$metin1 )
    { 
      $i++;
      $t_sifre=$yazdir['email'];
    }
	 }

 
	 if($i=="0")
	  {  
	 $mm="GİRDİĞİNİZ TCYE AİT ÜYE BULUNMAMAKTADIR";
                       $mesaj ="<script>alert ('$mm');    
                   window.location.href='../kullanici/sifre_unuttum.php';
                         </script>" ;
                       echo $mesaj ;
	 }
	 else
	 {
	 	ECHO "MAİL YOLLAYACAK";
	 }





		}
?>