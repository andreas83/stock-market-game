<?php
class Spiel_Nachrichten
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Template["Lesen"] = "lesen.php";
        $this->Template['Schreiben'] = "schreiben.php";
        $this->Template['Senden'] = "index.php";
        $this->Template['Antworten'] = "schreiben.php";
        $this->Template['Autocomplete'] = "json.php";
        $this->Title = _("Nachrichten");
    }
    
    function index()
    {
        $nachrichten = new Nachrichten_Table;
        
        $this->nachrichten=$nachrichten->get_list(array("an"=>$_SESSION['login']));
    }
    function Lesen()
    {
        $nachrichten = new Nachrichten_Table($_GET['nid']);
        $nachrichten->status="read";
        $nachrichten->save();
        $this->nachricht=$nachrichten;
    }  
    function Schreiben()
    {
        $this->ExtraHeader = include("app/views/Spiel/Nachrichten/header.php");
        if(isset($_GET['nid']))
        {
            $nachrichten = new Nachrichten_Table($_GET['nid']);
            $this->nachricht=$nachrichten;
        }
        if(isset($_GET['bid']))
        {
            $benutzer = new Benutzer_Table($_GET['bid']);
            $this->benutzer=$benutzer;
        }
        
    }  
    function Antworten()
    {
        $this->Schreiben();
        $this->Template['Antworten'] = "schreiben.php";
    }
    
    function Loeschen()
    {
        $nachrichten = new Nachrichten_Table($_GET['nid']);
        $nachrichten->status="deleted";
        $nachrichten->save();
        
        $this->index();
        $this->Template['Loeschen'] = "index.php";
    }    
    
    function Senden()
    {
        
        if(!isset($_POST['an']) or $_POST['an']=="")
        {
            $this->Template['Senden'] = "schreiben.php";         
            $this->result = _("Empf&auml;nger konnte nicht gefunden werden.");
            return false;               
        }
        
        $benutzer = new Benutzer_Table();
        $res=$benutzer->get_list(array("nick"=>$_POST['an']));
        if(!is_numeric($res['0']->bid))
        {
            $this->Template['Senden'] = "schreiben.php";         
            $this->result = _("Empf&auml;nger konnte nicht gefunden werden.");
            return false;
        }
        $nachricht = new Nachrichten_Table();
        $nachricht->betreff     = $_POST['betreff'];
        $nachricht->nachricht   = $_POST['nachricht'];
        $nachricht->von         = $_SESSION['login'];
        $nachricht->an          = $res['0']->bid;
        $nachricht->date        = date("U");
        $nachricht->status      = "unread";
        $nachricht->save();
        $this->index();

        $this->Template['Senden'] = "schreiben.php";
        $this->result = sprintf(_("Deine Nachricht wurde erfolgreich an %s gesendet."), $_POST['an']);

    }
    
    
    function Autocomplete()
    {
        $benutzer = new Benutzer_Table();
        $res=$benutzer->getLike(array("nick"=>$_GET['term']));
        $data = array();
        foreach ($res as $row)
        {
            $data[] = $row->nick;
        }
        $this->result = json_encode($data);
    }
}
?>
