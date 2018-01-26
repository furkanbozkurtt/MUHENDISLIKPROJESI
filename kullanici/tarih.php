<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>MaviTm Jquery Takvim Uygulaması</title>


    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="theme-desert.css" rel="stylesheet">
    <style>
        pre {
            font-family: monospace,monospace;
            font-size: .9em;
            line-height: 130%;
        }
        pre.prettyprint {
            border: medium none;
            border-radius: 4px;
            padding: 13px 16px;
        }
    </style>
</head>
<body>

<h1>MaviTm Jquery Takvim Uygulaması</h1>

<!--
<a style="position:fixed; top:45px; right:15px; display:block; padding:5px 10px; color:#FFF; font-size:16px; background-color:#333;" href="jsTakvim.rar" target="_blank">Rar Download</a>
<a style="position:fixed; top:75px; right:15px; display:block; padding:5px 10px; color:#FFF; font-size:16px; background-color:#333;" href="mavitm_Jquery_takvim.zip" target="_blank">Zip Download</a>
-->

<a style="position:fixed; top:15px; right:15px; display:block; padding:5px 10px; color:#FFF; font-size:16px; background-color:#333;" href="http://sourceforge.net/projects/jquerytakvim/" target="_blank">Download</a>

<p>Haftanın 1., 3., 5. ve 7. günlerini engellemek için.</p>
    <input type="text" name="tarih" class="rdate" id="checkin" />

   
 

    <hr style="margin:10px 0px;" />
 
   
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="run_prettify.js"></script>
    <script type="text/javascript" src="jquery.takvim.js" charset="utf-8"></script>

<script type="text/javascript">
$('.rdate').mavitmTakvim({
    baslangicYil:2005,
    bitisYil:2035,
   
engelliHaftaGun:'6,7',
    onceUygula: function(tag){
        if ($(tag).attr("id") == "checkout") {
            this._aktifDate = new Date();

            var dates = $("#checkin").val().split('/'); ////0-gun,1-ay,2-yil
            if(dates.length > 1) {
                var d = new Date(dates[1] + "/" + dates[0] + "/" + dates[2]);
                d.setDate(d.getDate() + 1);
                this._aktifDate = d;
            }
        } else {
            this._aktifDate = new Date();
        }
    },
  
 
});</script>
 
</body>
</html>