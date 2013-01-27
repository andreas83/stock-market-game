<?php
class Aktien_Kaufen
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Template["Bezahlen"] = "Bezahlen.php";
        $this->Template['Kurs'] = "json.php";
        $this->Title = _("Aktien Kaufen");
    }
    
    function index()
    {
        $benutzer = new Benutzer_Table($_SESSION['login']);
        $this->benutzer = $benutzer;
        $firma = new Firma_Table($_GET['firma']);
        $this->firma = $firma;
        $kurs = new Kurse_Table();
        $kurs->getStocks($firma->fid);
        $this->kurs = $kurs;
        $this->BodyOnload = "updatekurs(".$firma->fid.")";
        $this->ExtraHeader = include("app/views/Aktien/Kaufen/header.php");        
        
    }
    
    function Bezahlen()
    {
        $firma = new Firma_Table($_GET['firma']);
        $kurs = new Kurse_Table();
        $kurs->getStocks($firma->fid);
        $benutzer = new Benutzer_Table($_SESSION['login']);
        if ($kurs->kurs==0)
        {
            $this->result = _("Der Kauf dieser Aktien sind im Augenblick vom Handel ausgeschlossen. Bitte versuche es zu einem sp&auml;teren Zeitpunkt noch einmal.");
            return false;
        }
        if($firma->anteile<$_GET['anzahl'])
        {
            $this->result = _("Es sind nicht gen&uuml;gend Anteile verf&uuml;gbar.");
            return false;
        }
        $kosten=$_GET['anzahl']*$kurs->kurs;
        if($kosten > $benutzer->guthaben)
        {
            $this->result = _("Du hast leider nicht gen&uuml;gend Guthaben zur Verf&uuml;gung.");
            return false;            
        }
        if(!isset($_GET['anzahl']) or $_GET['anzahl']<1)
        {
            $this->result = _("Du musst mindestens 1 Anteil kaufen.");
            return false;            
        }

        $aktien = new Aktien_Table;
        $aktien->anzahl = $_GET['anzahl'];
        $aktien->bid = $_SESSION['login'];
        $aktien->kid = $kurs->kid;
        $aktien->save();
        $firma->anteile = $firma->anteile - $_GET['anzahl'];
        $firma->save();
        $benutzer->guthaben = $benutzer->guthaben - $kosten;
        $benutzer->save();
        $this->result = sprintf(_("Du hast bei einem Kurs von aktuell %s &euro; erfolgreich %s Anteile von der Firma %s gekauft. Wir w&uuml;nschen dir viel Erfolg!"), $kurs->kurs, $aktien->anzahl, $firma->name);
        return true;         
        
    }
    
    function Kurs()
    {
        $kurs = new Kurse_Table();
        $kurs->getStocks($_GET['firma']);        
        $this->kurs = $kurs;
    }
}
?>
