      <?php 
      @session_start();
      if(isset($_POST["s_degistir"]))
			{	
				
$baglanti=mysql_connect("localhost","root","") or die ("veritabanına bağlanılamadı".mysql_error());    //VERİTABANINA BAĞLANIYOR
                    mysql_select_db("dis_hastanesi") or die ("veritabanına bağlanılamadı".mysql_error());  //MYSQL VERİTABNINI SEÇİYOR
                    mysql_query("SET NAMES UTF8");
                    $k_tc=$_SESSION['tc']; 
                    $k_eski=$_POST["e_sifre"];
                    $y_sifre=$_POST["y_sifre1"];
                    $y_sifre1=$_POST["y_sifre2"];
                     $sql="select * from doktorkaydi where tc='$k_tc'";
                    $sonuc=mysql_query($sql); 
                    $yaz=mysql_fetch_assoc($sonuc);  
                    $sif=$yaz["sifre"];


                      if($k_eski!="" && $y_sifre!="" && $y_sifre1!="" )
                      {
                     if($k_eski==$sif)
                      {

                        if($y_sifre==$y_sifre1)
                        {
                        
                         mysql_query("UPDATE doktorkaydi set sifre='$y_sifre' where tc='$k_tc'");

                         echo "ŞİFRENİZ BAŞARIYLA DEĞİŞTİRİLDİ";
  
                         header("refresh:3; location:../doktor/d_anasayfa.php");
                        
                        }

                       else 
                       {
                        
                       $mm="GİRDİĞİNİZ ŞİFRE AYNI DEĞİL";
                            $mesaj ="<script>alert ('$mm');
                    window.location.href='../doktor/sifredegistir.php';
                        </script>" ;
                      echo $mesaj ;
                       }

                      }
                       else 
                          {
                        $mm ="ŞİFRENİZİ  DOĞRU GİRİNİZ";
                           $mesaj ="<script>alert ('$mm');
                    window.location.href='../doktor/sifredegistir.php';
                        </script>" ;
                      echo $mesaj ;
                          }
                    
                    }
                    else{
                 $mm="ALANLARI DOLDURUNUZ";
                  $mesaj ="<script>alert ('$mm');
                    window.location.href='../doktor/sifredegistir.php';
                        </script>" ;
                      echo $mesaj ;


                        }


		}

      ?>