<?php

class Benutzer_Anmelden
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Title = _("Anmelden");
        $this->ExtraHeader = include("app/views/Benutzer/Anmelden/header.php");
    }
    
    function index()
    {	
        if(is_numeric($_SESSION['login'])){
            $this->Template["index"] = "erfolgreich.php";
            return true;
        }
        if($_POST)
        {
            $benutzer = new Benutzer_Table;
            
            if ($benutzer->checkLogin($_POST['nick'], $_POST['pass']))
            {
                $this->benutzer = $benutzer;
                
                $_SESSION['login'] = $benutzer->bid;
                header("Location: /Benutzer/Anmelden");
            }
            else
            {
                $this->result = "";
            }

        }
    }
}
?>
