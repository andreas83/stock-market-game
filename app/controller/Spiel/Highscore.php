<?php
class Spiel_Highscore
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Title = "Highscore";
    }
    
    function index()
    {
        $benutzer = new Benutzer_Table;
        $page = (int)(isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
        $benutzer->getHighscore();
        $Alle = $benutzer->Benutzer;
        $ZeigeProSeite = 5;
        $this->Seiten=(int)ceil($Alle/$ZeigeProSeite);
        $this->page = $page;
        $start_pointer=(int)($page*$ZeigeProSeite)-$ZeigeProSeite;
        $this->highscore = $benutzer->getHighscore($start_pointer, $ZeigeProSeite);
    }
}
?>