<?php
class Aktien_Chart
{
    function __construct()
    {
        $this->Template["index"] = "json.php";
    }
    function index(){
        $firma = new Firma_Table($_GET['firma']);
        
        $this->firma=$firma->getChart();
    }
}
?>