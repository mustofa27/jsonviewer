
<?php
$now = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $now);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0

class DB {
        function DB()
  {
                $this->host = "localhost";
                $this->db = "fids";
                $this->user = "root";
                $this->pass = "elbansub";

    $this->link = @mysql_connect($this->host, $this->user, $this->pass);
                mysql_select_db($this->db);
        }
}
$db = new DB();
$sql = "SELECT flts.flt_no,flts.carrier,flts.sch_d,flts.via_1,flts.via_2,flts.via_5,flts.gate,flts.est_d,flts.remark,flts.codeshare,kode_band.lname FROM flts LEFT JOIN kode_band ON flts.via_1=kode_band.treelcode WHERE (flts.oper_d BETWEEN DATE_ADD(CURDATE(),INTERVAL -1 DAY) AND DATE_ADD(CURDATE(), INTERVAL +1 DAY)) AND `leg`='D' AND `range`='D' AND `deleted`='N' ORDER BY flts.oper_d,flts.sch_d LIMIT 11";
if(!$result = mysql_query($sql)) die("query gagal");
//**********
//  Header
//**********
$content_for_body1="<div class='judul'>\n";
$content_for_body1.="<div class='j1'><span class='h'>Airline</span></div>\n";
$content_for_body1.="<div class='j2'><span class='h'>Flight</span></div>\n";
$content_for_body1.="<div class='j3'><span class='h'>Schedule</span></div>\n";
$content_for_body1.="<div class='j4'><span class='h'>Destination</span></div>\n";
$content_for_body1.="<div class='j5'><span class='h'>Gate</span></div>\n";
$content_for_body1.="<div class='j6'><span class='h'>ETD</span></div>\n";
$content_for_body1.="<div class='j7'><span class='h'>Remark</span></div>\n";
$content_for_body1.="</div>\n";
//*********
// flight
//*********
$array_via=array();
$array_cs=array();
$k=0;
//----------------------------------------------------------------------------------------*-----*-----*
while(list($flt_no,$carrier,$sch_d,$via_1,$via_2,$via_5,$gate,$est_d,$remark,$codeshare,$lname) = mysql_fetch_row($result))
{
$sch_d=substr($sch_d,0,5);
$gambar="/display/images/".strtolower($carrier)."-t.gif";
if($remark=="Final Call" || $remark=="Boarding") {
    $content_for_body1.="<div class='barisf'>";
} elseif($remark=="Departed" || $remark=="No Operate" || $remark=="Delayed") {
    $content_for_body1.="<div class='barisd'>";
} else {
    $content_for_body1.="<div class='baris'>";
}
$content_for_body1.="<div class='c1'><img name='img".$k."' src='".$gambar."' width='115' height='25' /></div>";
$content_for_body1.="<div class='c2' id='cstext".$k."'>".$flt_no."</div>";
$content_for_body1.="<div class='c3'>".$sch_d."</div>";
if(!$lname=="") {
$content_for_body1.="<div class='c4' id='".$k."'>".$lname."</div>";
} else {
$content_for_body1.="<div class='c4' id='".$k."'>".$via_1."</div>";
}
$content_for_body1.="<div class='c5'>".$gate."</div>";
if($est_d=="00:00:00") {
  $est_d="";
} else {
  $est_d=substr($est_d,0,5); }
$content_for_body1.="<div class='c6'>".$est_d."</div>";
$content_for_body1.="<div class='c7'>".$remark."</div>";
$content_for_body1.="</div>"."\n";
//---------------------------------------------------------------------*
//  array for via's
//---------------------------------------------------------------------*
if(!(lname=="")) { $via1=$lname; } else { $via1=$via_1; }
if(!($via_2=="")) {
$via2=nama_panjang($via_2);
  if(!($via_5=="")) {
    $via5=nama_panjang($via_5);
    array_push($array_via,array($k,$via1,$via2,$via5));
  } else {
    array_push($array_via,array($k,$via1,$via2));
  }
}
//----------------------------------------------------------------------*
//------------array codeshare-------------------------------------*-----*
$jum_kota=1;
if(!($via_2=="")) { $jum_kota+=1; }
if(!($via_5=="")) { $jum_kota+=1; }
if(!($codeshare=="")) {
array_push($array_cs,array($k,$flt_no,$codeshare,$jum_kota));
}
//----------------------------------------------------------------*-----*
$k++;
}
//mysql_close($db->link);
//----------------------------------------------------------------------------------------*-----*-----*
//----------------------------------------------------------------------**
// content_for_script
//----------------------------------------------------------------------**
if(count($array_via) > 0) {
$var_content_for_script="var i=0\n";
$content_for_script.="function showRotateText()\n{\n";
for($i=0;$i<count($array_via);$i++) {
$content_for_script.="var flt".$i."Container = document.getElementById('".$array_via[$i][0]."')\n";
$content_for_script.="flt".$i."Container.innerHTML=kota".$i."[i%".(count($array_via[$i])-1)."]\n";
$var_content_for_script.="var kota$i=['".$array_via[$i][1];
if(!($array_via[$i][2]=="")) { $var_content_for_script.="','".$array_via[$i][2]; }
if(!($array_via[$i][3]=="")) { $var_content_for_script.="','".$array_via[$i][3]; }
$var_content_for_script.="']\n";
}
$content_for_script.="i+=1\n";
$content_for_script.="setTimeout('showRotateText()',3000)\n";
$content_for_script.="}\n";
$content_for_script=$var_content_for_script.$content_for_script;
}
//----------------------------------------------------------------------**
//------for codeshare------------
$inner_cs1="";
$inner_cs2="";
if(count($array_cs > 0)) {
for($j=0;$j<count($array_cs);$j++) {
$inner_cs1.="var cs".$j."Img2=new Image()\n";
$inner_cs1.="cs".$j."Img2.src="."'/display/images/".strtolower(substr($array_cs[$j][2],0,2))."-t.gif'\n";
$inner_cs1.="document['img".$array_cs[$j][0]."'].src=cs".$j."Img2.src\n";
$inner_cs1.="document.all.cstext".$array_cs[$j][0].".innerHTML='".$array_cs[$j][2]."'\n";

$inner_cs2.="var cs".$j."Img2=new Image()\n";
$inner_cs2.="cs".$j."Img2.src="."'/display/images/".strtolower(substr($array_cs[$j][1],0,2))."-t.gif'\n";
$inner_cs2.="document['img".$array_cs[$j][0]."'].src=cs".$j."Img2.src\n";
$inner_cs2.="document.all.cstext".$array_cs[$j][0].".innerHTML='".$array_cs[$j][1]."'\n";
}
$for_cs="function cs()\n{\n";
$for_cs.=$inner_cs1;
$for_cs.="setTimeout('bcs()',1500);\n";
$for_cs.="}\nfunction bcs()\n{\n";
$for_cs.=$inner_cs2;
$for_cs.="setTimeout('cs()',1500);\n";
$for_cs.="}\n";
}
//------for codeshare------------
//---------------------------------------------------------------------***
//  nama panjang
//---------------------------------------------------------------------***
function nama_panjang($cari) {
$db = new DB();
$sql = sprintf("SELECT lname FROM kode_band WHERE treelcode='%s'",$cari);
$result = mysql_query($sql);
$baris = mysql_fetch_row($result);
//$nama_panjang = $baris[0];
mysql_close($db->link);
if(!($baris[0]=="")) {
return $baris[0];
} else {
return $cari; }
}
//---------------------------------------------------------------------***
?>

<HEAD>

<script LANGUAGE="javascript">
<!--
<?php echo $content_for_script; ?>
function panggil()
{
Nifty("div.footer","top big");
<?php if(count($array_via) > 0) { echo "showRotateText();"; } ?>
<?php if(count($array_cs) > 0) { echo "setTimeout('cs()',1500);"; } ?>
}
<?php echo $for_cs; ?>
-->
</script>
<script type="text/javascript" src="niftycube.js"></script>

<style type="text/css">
body { margin: 0; padding: 0; background-color: #000; text-align: center; cursor:text; overflow: hidden; }

#container { width: 802; height: 512px; position:relative; overflow: hidden;
             margin-left: auto; margin-right: auto; background-color: #ffffff; }
@font-face {
    font-family: "roboto-condensed.light";
    src: url(/depdomt2/roboto-condensed.light.ttf)
    }
@font-face {
    font-family: "roboto-condensed.bold";
    src: url(/depdomt2/roboto-condensed.bold.ttf)
    }
@font-face {
    font-family: "roboto-condensed.regular";
    src: url(/depdomt2/roboto-condensed.regular.ttf)
    }	
.header {
    width: 802; height: 90px;
    color: #FFF; position:relative; overflow: hidden;
    margin-left: auto; margin-right: auto; background: url("/depdomt2/header.jpg") no-repeat scroll;
    text-align:left; 
    }
	
.header .jam {
    margin-left: 670px;
    margin-top: 25px;
    font-size: 40px;
    font-family: "roboto-condensed.regular"; font-weight:bold;
    }
.header .tanggal {
    margin-left: -130px;
    margin-top: -30px;
    font-size: 20px;
    font-family: "roboto-condensed.light";
    }
	
.header .title1 {
    margin: -83;
    margin-left: -520px;
    font-size: 22px;
    font-family: "roboto-condensed.light";
    color: white;
      
    }
.header .icon {
    margin: -56;
    margin-left: -520px;
    border: 0;
    font-size: 100%;
    font: inherit;
     }
.header .icon img { width: 70px }


div.judul { width:802px; height:11px; clear:both; font-size:26px; line-height:10px;padding-top:15px;padding-bottom:15px;
            color:#fff; background-color:#0A4580; font-family: "roboto-condensed.regular"; }
div.j1 { float:left; margin-left:45px; }
div.j2 { float:left; margin-left:40px; }
div.j3 { float:left; margin-left:30px; }
div.j4 { float:left; margin-left:35px; }
div.j5 { float:left; margin-left:40px; }
div.j6 { float:left; margin-left:35px; }
div.j7 { float:left; margin-left:55px; }


div.baris,div.barisf,div.barisd { width:802px; height:22px; clear:both; padding-top:8px; padding-bottom:8px;
font-size:19px; border-bottom:1px solid #CBCBCB; font-family: "roboto-condensed.regular" }
div.baris { color:#222222; }
div.barisf { -webkit-animation:blink 1s linear infinite; -moz-animation:blink 3s linear infinite;
animation:blink 3s linear infinite; }
div.barisd { color:#0b60bb; }

div.c1 { width:104; height:24px; float:left; margin-left:15px; }
div.c2 { width:110; height:24px; float:left; color:#222222; text-align:left:10px; }
div.c3 { width:90; height:24px; float:left; color:#0b60bb; }
div.c4 { width:170; height:24px; float:left; color:#0b60bb; font-family: "roboto-condensed.regular"; font-weight:bold; }
div.c5 { width:60; height:1px; float:left; color:#0b60bb; }
div.c6 { width:90; height:1px; float:left; color:#0b60bb; }
div.c7 { width:135; height:15px; float:left; font-family: "roboto-condensed.regular"; text-transform: uppercase;  }

div.footer { height: 36px; width: 830px; left:-10px; bottom:0px; position: absolute;
             color: #fff; background:#0A4580; font-family: "roboto-condensed.regular";
             text-align: center; font-size: 20px; font-weight:bold; }
			 
span.h { color::#FFFFFF;font-size:24px; }

@keyframes blink{
0%{color:red}
50%{color:white}
100%{color:red}
}
@-webkit-keyframes blink{
0%{color:red}
50%{color:white}
100%{color:red}
}

</style>
</HEAD>
<div class="header"> 
<div class="jam"><?php echo "".date('H:i '); ?>
<div class="tanggal"><?php echo "".date('j M Y '); ?>
<div class="title1"><h1>Departures Terminal 1B</h1>
 

</div>
</div>
</div>
</div>


<BODY onload="panggil()">
<div id="container">
<?php echo $content_for_body1; ?>
<div class="footer">
<marquee onmouseout='this.start()' onmouseover='this.stop()' scrollamount='5'><img src="/depdomt2/ap1logo.png" width="60" height="30"/>&nbsp&nbspSELAMAT DATANG DI TERMINAL 1 BANDAR UDARA INTERNASIONAL JUANDA SURABAYA&nbsp&nbsp<img src="/depdomt2/ap1logo.png" width="60" height="30"/>&nbsp&nbspJANGAN MENINGGALKAN BARANG BAWAAN ANDA TANPA PENGAWASAN&nbsp&nbsp<img src="/depdomt2/ap1logo.png" width="60" height="30"/>&nbsp&nbspDO NOT LEAVE YOUR LUGGAGE UNATTENDED&nbsp&nbsp<img src="/depdomt2/ap1logo.png"width="60" height="30"/>&nbsp&nbspSILENT AIRPORT SUDAH DIBERLAKUKAN, MOHON PARA PENUMPANG SELALU MEMPERHATIKAN INFORMASI PENERBANGAN PADA MONITOR FIDS YANG TERSEDIA. TERIMAKASIH.&nbsp&nbsp<img src="/depdomt2/ap1logo.png" width="60" height="30"/>&nbsp&nbspSILENT AIRPORT POLICY HAS BEEN ENFORCED, PASSANGERS ARE ADVISED TO CHECK FLIGHT INFORMATION ON AVAILABLE FIDS SCREEN. THANK YOU.&nbsp&nbsp</marquee>

</div>
</div>


</BODY>

</HTML>
