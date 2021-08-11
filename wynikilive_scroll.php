<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
$urlResultsCSV="https://docs.google.com/spreadsheets/d/e/2PACX-1vQP0nVZD_QQNxjkfNxN3r9kISBAw0ZdnWYLBJWb_gTSHK6Ikyr2a_qFuOSftrE86HsT6T40CptbyfbK/pub?gid=341869762&single=true&output=csv";

function PrintMainName($fRow)
{
    echo "<tr style=\"\">";
    echo "<th colspan=\"7\" style=\"font-size:18; border-bottom: 1px solid #ddd;\">". $fRow[0] ."</th>";
    echo "</tr>\n";
}

function PrintHeaderRow($fRow)
{
    echo "<tr>";
    for($i=0;$i<count($fRow);$i++)
    {
        echo "<th style=\"text-align:center; padding-left:5px; padding-right:5px\">".$fRow[$i]."</th>";
    }
    echo "</tr>\n";
}

function PrintRegularRow($fRow)
{
    echo "<tr>";
    for($i=0;$i<count($fRow);$i++)
    {
        $style="";
        if($i==0) $style="style=\"text-align:center; padding-left:5px; padding-right:5px\"";
        if($i==3) $style="style=\"text-align:center; padding-left:5px; padding-right:5px\"";
        if($i==4) $style="style=\"text-align:center; padding-left:5px; padding-right:5px\"";
        if($i==5) $style="style=\"text-align:center; padding-left:5px; padding-right:5px; font-weight: bold;\"";
        if($i==6) $style="style=\"text-align:center; padding-left:5px; padding-right:5px\"";
        if($i==1){
            $splitted = explode(" ", $fRow[$i],2);
            echo "<td ". $style ." >".strtoupper($splitted[0])." ".$splitted[1]."</td>"; 
        }
        else 
            echo "<td ". $style ." >".$fRow[$i]."</td>";
    }
    echo "</tr>\n";    
}

function LoadCSVREsuts($url)
{
    echo "<table>";
    $fileHandle = fopen($url,'r');
    while (($fileRow = fgetcsv($fileHandle, 1000, ","))!==FALSE) {
        if(count($fileRow)<6) return;
        if(strlen($fileRow[0])>0&& strlen($fileRow[1])==0){
            PrintMainName($fileRow);
        }
        elseif (strlen($fileRow[0]) == 0 && strlen($fileRow[1]) > 0) {
            PrintHeaderRow($fileRow);
        } 
        else {
            PrintRegularRow($fileRow);
        }
    }
    echo "</table>";
    return;
}

?>
<html>
<head>

    <meta http-equiv="Page-Enter" content="revealtrans(duration=2.0, transition=2)">
    <meta http-equiv="Page-Exit" content="revealtrans(duration=2.0, transition=3)">
    <title>Klub Strzelecki Feniks Twardogóra</title>
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="pl">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="last-modified" content="2016-06-11@21:59:00 CET" />
    <link rel="shortcut icon" href="http://www.feniks.twardogora.org.pl/grafika_feniks/favicon.ico" type="image/x-icon">

    <style>
        a:hover {
            font-size: 12pt;
            font-family: Verdana;
            font-weight: bold;
            text-decoration: none;
            color: red;
            BACKGROUND-COLOR: NONE;
        }

        a {
            font-size: 12pt;
            font-family: Verdana;
            font-weight: bold;
            text-decoration: underline;
            color: navy;
            BACKGROUND-COLOR: none;
        }
    </style>

    <style type="text/css">
        BODY {
            background-color: teal;
            background-image: url(grafika/oo.gif);
            background-position: bottom center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
    <script src="scripts/jquery-1.6.4.js"
            type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.11.4.js"
            type="text/javascript"></script>
    <script src="scripts/DatePickerReady.js"
            type="text/javascript"></script>

</head>
<body>

<script language="javascript" type="text/javascript">

    function GoBackToTop() {
        var body = $("html, body");
        var documentHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight);
        body.stop().delay(5000).animate({ scrollTop: 0 }, 500, 'linear', GoBottom);
    }

    function GoBottom(notreload) {
        if (notreload != 1) window.location.reload(true);

        var documentHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight);
        var body = $("html, body");
        body.stop().delay(2000).animate({ scrollTop: (documentHeight - window.innerHeight) }, (documentHeight - window.innerHeight) * 40, 'linear', GoBackToTop);
    }
    
    function FullReload()
    {
        window.location.reload(true);
    }

    $(document).ready(function () {

		function wait_start(){
		    var documentHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight);
                       //html.clientHeight, html.scrollHeight, html.offsetHeight);
					   
			if (documentHeight > window.innerHeight) {
				GoBottom(1);
			}else
                            window.setTimeout(FullReload, 60000); 
		};
		window.setTimeout(wait_start, 2000);
    });
    
</script><!-- okienka   head-->

<!-- data -->
<center>
<!--<img src="grafika_feniks/stopka9.jpg" border="0" width="1024">-->
<!-- menu -->

<table bgcolor="white" border="1" cellpadding="2" cellspacing="0" width="1024">
  <tbody>
    <tr>
      <td align="left" width="1024">
            
          <hr align="center" color="red" width="80%">
          <center>
          <?php
              LoadCSVREsuts($urlResultsCSV);
          ?>
          </center>
          <hr align="center" color="red" width="80%">
          
      </td>
    </tr>
  </tbody>
</table>
</center>
</body></html>