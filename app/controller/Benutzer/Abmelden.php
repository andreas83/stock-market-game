<?php

class Benutzer_Abmelden
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
    }
    
    function index()
    {
        
        session_destroy();
        if($_SESSION['login'])
            header("Location: /Benutzer/Abmelden");
    }
}
?>
