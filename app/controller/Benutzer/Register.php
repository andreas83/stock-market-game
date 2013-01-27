<?php

class Benutzer_Register {

    function __construct() {
        $this->Template["index"] = "index.php";
        $this->Template["Speichern"] = "Speichern.php";
        $this->Title = "Benutzer";
    }

    function index() {
        $this->benutzer = new Benutzer_Table;
    }

    function Speichern() {
        $this->result = array();
        
        if (!$_POST['nick'] or !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            if (!$_POST['nick']) {
                $this->result[] = _("Bitte gib einen Namen an.");
            }
            if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $this->result[]= _("Bitte &uuml;berpr&uuml;fe deine eMail Adresse.");
            }
            return false;
        }

        $benutzer = new Benutzer_Table;
        if ($benutzer->isBenutzer($_POST['nick'], $_POST['mail'])) {
            $this->result[] = _("Der Benutzername und oder die E-Mail Adresse ist berreits vergeben.");
            return false;
        } else {
            $benutzer->mail = $_POST['mail'];
            $benutzer->nick = $_POST['nick'];
            $pass = $this->generateCode(8);
            $benutzer->pass = hash("sha512", $pass);
            $benutzer->guthaben = '5000';
            
            $benutzer->save();
            $this->result[] = _("Deine Registrierung war erfolgreich!<br/>Dir wird in k&uuml;rze eine E-Mail mit deinen Zugangsdaten geschickt.");
            $this->sendConfirmation($benutzer->nick, $pass, $benutzer->mail);

            return true;
        }
    }

    function generateCode($characters) {
        /* list all possible characters, similar looking characters and vowels have been removed */
        $possible = '23456789bcdfghjkmnpqrstvwxyz';
        $code = '';
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            $i++;
        }
        return $code;
    }

    function sendConfirmation($nick, $pass, $mail) {
        $msg = sprintf(_("
        Hallo %s,<br>
        <br>
        Vielen Dank f&uuml;r deine Registrierung.<br>
        <br>
        Deine Zugangsdaten:<br>
        Benutzername: <b>%s</b><br>  
        Passwort: <b>%s</b><br>
        <br>
        Zum Start wurde dein Konto mit 5000 Euro aufgeladen.<br>
        Wir hoffen, dass du viel Spa&szlig; beim B&ouml;rsenpoker hast.<br>
        <br>
        <br>
        Mit freundlichen Gr&uuml;&szlig;en<br>
        <br>
        Dein B&ouml;rsen Team<br>
        Link: <a href=\"http://www.boersenspiel.ath.cx/\">www.boersenspiel.ath.cx</a>
        "), $nick, $nick, $pass);

        $subject = "Registrierung beim Boersenspiel";
        
        $headers = "From: \"Boersenspiel Team\" <office@codejungle.org>\n";
        $headers .= "To: \"$nick\" <" . $mail . ">\n";
        $headers .= "Return-Path: <office@codejungle.org>\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=utf-8\n";

        return mail("$mail", $subject, $msg, $headers);
        
    }

}

?>
