<?php
class Aktien_Uebersicht
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Title = _("Aktien Übersicht");
    }
    
    function index()
    {
        $firma = new Firma_Table();
        $kurs = new Kurse_Table();

        $this->kurs = $kurs;
        
        $page = (int)(isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
        $firma->getPages();
        $AlleFirmen = $firma->Firmen;
        $ZeigeProSeite = 5;
        $this->Seiten=(int)ceil($AlleFirmen/$ZeigeProSeite);
        $this->page = $page;
        
        $start_pointer=(int)($page*$ZeigeProSeite)-$ZeigeProSeite;
        $this->firma = $firma->getPages($start_pointer, $ZeigeProSeite);
        
        
    }
}
?>