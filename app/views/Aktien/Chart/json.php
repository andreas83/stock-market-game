<?php
$i=0;
foreach($view->firma as $firma)
{
    $time=$firma->datum+7200;
    $time=(int)$time*1000;
    $data[]=array( $time, $firma->kurs);

}

echo json_encode($data);
?>
