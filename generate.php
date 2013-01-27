<?php
require_once ("./app/init/init.php");

function db_connect() {
    $connect=@mysql_connect('localhost', Config::get('db_user'), Config::get('db_pass'))
    or die("<li>Cant connect to: Config::get('db_host')  with user: Config::get('db_user')</li>");
    @mysql_select_db("boerse", $connect) or die("Cant select DB");
}

function create($v) {
    db_connect();
    $i = 0;

    while ($i < 360) {

        $rand = rand(-9, 10);
        $i++;
        $datum = date("Y-m-d H:i:s", mktime(0, 0, 0, 0, $i, 2010));
        $wert = $wert + $rand;
        $sql = "INSERT INTO Kurse (kid, fid, kurs, datum) VALUES ('', $v, '$wert', '$datum')";
        mysql_query($sql);
    }
}

function daily() 
{
    db_connect();
    $sql = "SELECT * FROM Firma";
    $row = mysql_query($sql);
    while ($afirm = mysql_fetch_array($row)) {

        $kurs = "SELECT kurs FROM Kurse WHERE fid={$afirm['fid']} ORDER BY kid DESC LIMIT 1";
        $query = mysql_query($kurs);
        $kursrow = mysql_fetch_row($query);
        #if($kursrow[0]>500 && $kursrow[0]<1000)
        #$neuer_wert=rand(-50, 50);
        #elseif($kursrow[0]>1000)
        #$neuer_wert=rand(-80, 70);
        #else
        $neuer_wert = rand(-20, 20);

        $wert = $neuer_wert + $kursrow[0];
        $datum = date("Y-m-d H:i:s");
        $daily_sql = "INSERT INTO Kurse (kid, fid, kurs, datum) VALUES ('', '{$afirm['fid']}', '$wert', '$datum')";
        #echo $daily_sql . "\n";
        mysql_query($daily_sql);

    }
}

function cleanup(){
    db_connect();
    $sql = "DELETE FROM Kurse WHERE DATE_SUB(NOW() , INTERVAL 1 MINUTE ) > datum AND kid NOT IN (SELECT kid FROM Aktien)";
    mysql_query($sql);
#    mysql_query("optimize table kurs");
}

#foreach (range(1, 11) as $numer)
#    create($numer);
while(1)
{
    sleep(1);
    daily();
    cleanup();
}
?>

