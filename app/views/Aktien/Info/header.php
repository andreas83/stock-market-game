<?php
/* 
    get the globals below from basedir > index.php
*/
global $chartColor, $chartColors, $chartSecondColors;

$chart = "<script type=\"text/javascript\">
function renderchart()
{
    jQuery.get('/Aktien/Chart?firma=" . $this->firma->fid . "', function(jsondata, textStatus)
        {
          
            $.plot($('#chart'),
            [{ 
            label: '" . $this->firma->name . "',
            data: jsondata, 
            lines: { show: true, lineWidth: 2.5, fill: 0.4, fillColor: { colors: [ { opacity: 0.8 }, { opacity: 0.1 } ] }, shadowSize: 0 },
            color: '#" . Config::get('chartcolor1') . "'
            }],
         { xaxis: { mode: 'time' },
             yaxis: { min: 0, autoscaleMargin:1 },
             grid: { 
             borderWidth: 2, 
             borderColor: '#" . Config::get('chartcolor2') . "',
             color: '#" . Config::get('chartcolor2') . "',
             backgroundColor: { colors: ['#" . Config::get('chartcolor3') . "', '#" . Config::get('chartcolor2') . "']  }
        },
            legend: { show: false, position: 'ne' } });
            var now = new Date();
            var Std = now.getHours();
            var Min = now.getMinutes();
            var Sec = now.getSeconds();
            var StdAusgabe = ((Std < 10) ? '0' + Std : Std);
            var MinAusgabe = ((Min < 10) ? '0' + Min : Min);
            var SecAusgabe = ((Sec < 10) ? '0' + Sec : Sec);
            jQuery('#update').html(StdAusgabe+':'+MinAusgabe+':'+SecAusgabe);
                setTimeout('renderchart();', 1000); // refresh chart every 1second
            }
        );
}
</script>";
return $chart;
