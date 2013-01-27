<?php
class Aktien_Info
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Title = _("Aktien Information");
    }
    function index()
    {
        
        $firma = new Firma_Table($_GET['firma']);
        $this->firma = $firma;
        $this->BodyOnload = "renderchart()";
        $this->ExtraHeader = include("app/views/Aktien/Info/header.php");
    }
    
}
?>
