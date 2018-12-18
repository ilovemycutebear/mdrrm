<?php
$data = explode(',',$sms_message_body);
if($data[2] == 1) {
    $link = mysql_connect('localhost', 'marikina', 'marikinawarning123');
    $db = "rainfall_cnt";
    mysql_select_db($db);

    //epoch to datetime

    $epochTime = $data[0];
    $findatetime = date("Y-m-d H:i:s", substr("$epochTime", 0, 10));
    $finTime = date("H:i:s", substr("$epochTime", 0, 10));
    $finDate = date("Y-m-d", substr("$epochTime", 0, 10));

    $Wlevel = 0;
    if((int)$data[1]==01){
    $elevone = 9.5;
    $Rawval = (float)$data[3];
    $toInch = ((float)$Rawval * 0.013536);
    $toMeters = ((float)$toInch * 0.0254);
    $Wlevel =(float)$elevone - (float)$toMeters;

    }
    else if((int)$data[1]==02){
    $elevtwo = 4.5;
    $Rawval = (float)$data[3];
    $toInch = ((float)$Rawval * 0.013536);
    $toMeters = ((float)$toInch * 0.0254);
    $Wlevel =(float)$elevtwo - (float)$toMeters;

    }
    ######

                                            
  $q = mysql_query("INSERT INTO logs VALUES(NULL,'".$finDate."','".$finTime."','".$data[24]."','".$Wlevel."','".$data[20]."','".$data[1]."','".$findatetime."','".$findatetime."')");
    if (!$q) {
        echo mysql_error();
    }
    mysql_close($link);
}
        
?>