<?php
$stocks='
<script type="text/javascript">
function updatekurs(firma)
{
    jQuery("#loading").show();
    jQuery("#kurs").load("/Aktien/Kaufen/Kurs?firma="+firma, function(data){
    jQuery("#kurs").html(data);
    jQuery("#loading").hide();
    var now = new Date();
    var Std = now.getHours();
    var Min = now.getMinutes();
    var Sec = now.getSeconds();
    var StdAusgabe = ((Std < 10) ? "0" + Std : Std);
    var MinAusgabe = ((Min < 10) ? "0" + Min : Min);
    var SecAusgabe = ((Sec < 10) ? "0" + Sec : Sec);
    jQuery("#update").html(StdAusgabe+":"+MinAusgabe+":"+SecAusgabe);
});
    setTimeout("updatekurs('.$this->aktien[0]->fid.')", 1000);
}

</script>';
return $stocks;
?>
