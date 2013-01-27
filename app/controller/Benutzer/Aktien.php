<?php
class Benutzer_Aktien{

    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Template["Verkaufen"] = "Verkaufen.php";
        $this->Template["Transaktion"] = "Transaktion.php";
        $this->Title = _("Meine Aktien");
        
    }
    
    function index()
    {
        $firma = new Firma_Table();
        $kurs = new Kurse_Table();
        $this->aktien=$firma->getUserStocks();
        $this->kurs = $kurs;
       
    }
    
    function Verkaufen()
    {
        if(!is_numeric($_GET['aid']))
        {
            die(_("Go screw someone else"));
        }
        
        $firma = new Firma_Table();
        $this->aktien=$firma->getUserStocks($_GET['aid']);
        
        if(!isset($this->aktien['0']))
                die(_("Go screw someone else"));
        
        $this->Title = _("Meine Aktien verkaufen");
        $this->BodyOnload = "updatekurs(".$this->aktien['0']->fid.")";
        $this->ExtraHeader = include("app/views/Benutzer/Aktien/header.php");     
        
    }
    
    function Transaktion ()
    {
            
        $error=false;
        if(isset($_GET['anzahl']) && !is_numeric($_GET['anzahl']))
        {
            $error .= _("Bitte &uuml;berpr&uuml;fe deine Anzahl."); 
        }
        if($error)
        {
            $this->result = $error;
            return false;
        }
        $benutzer = new Benutzer_Table($_SESSION['login']);
        $firma = new Firma_Table;
        $kurs = new Kurse_Table();
        $aktien = new Aktien_Table();
        $aktien->aid = $_GET['aid'];
        if(!$aktien->get($_SESSION['login']))
            die("Go screw someone else");
        $aktien->get($_SESSION['login']);
        if($_GET['anzahl'] > $aktien->anzahl)
        {
            $this->result= _("Du kannst nicht mehr Verkaufen als du Besitzt.");
            return false;
        }
        
        //wir holen uns den aktuelen kurs der firma
        $kurs->kid=$aktien->kid;
        $kurs->get();
	$kurs->getStocks($kurs->fid);
        $result = $kurs->kurs*$_GET['anzahl'];
        //wir schreiben das neue guthaben den benutzer gut
        $benutzer->guthaben=$benutzer->guthaben+$result;
       
        $benutzer->save();            
        //wir lösche den eintrag wenn der benutzer alle aktien verkauft
        if($_GET['anzahl'] == $aktien->anzahl)
        {
            $aktien->del();
            $this->check_anzahl="0";

        }elseif($_GET['anzahl'] < $aktien->anzahl && $_GET['anzahl'] > "0")
        {
            $aktien->anzahl=$aktien->anzahl-$_GET['anzahl'];
            $aktien->save();
        }
        
        $firma->fid=$kurs->fid;
        $firma->get();
        $firma->anteile=$firma->anteile+$_GET['anzahl'];
        $firma->save();            
        
        $this->result = sprintf(_("Du hast erfolgreich %s Anteile der Firma %s verkauft."), $_GET['anzahl'], $firma->name);
                
        return true;
    }
}
?>
