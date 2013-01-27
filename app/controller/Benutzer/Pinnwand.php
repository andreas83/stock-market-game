<?php

class Benutzer_Pinnwand{
    
    function __construct()
    {
        
        $this->Template["Loeschen"] = "json.php";
        $this->Template["Links"] = "json.php";
        $this->Template["Speichern"] = "json.php";
                
    }
    function Speichern(){
        $pinnwand = new Pinnwand_Nachrichten();
        $pinnwand->von=$_SESSION['login'];
        $pinnwand->text=$_POST['pinnwand'].$_POST['link'];
        $pinnwand->an = $_POST['id'];
        $pinnwand->date=date("U");
        $pinnwand->save();
        
       echo json_encode(array("result" => "done", "pid" => $pinnwand->pid));

    }
    
   function Loeschen()
    {      
        
        $pinnwand = new Pinnwand_Nachrichten();
        $pinnwand->pid = $_GET['pid'];
        $pinnwand->del();
        echo json_encode(array("result" => "done", "pid" => $pinnwand->pid));
    }
    
    function Links()
    {
        $data=$this->replaceYoutube($_GET['input']);
        $this->result = json_encode(array("result" => $data[0]));
    }
    
    function replaceYoutube($input)
    {
        $search = "/((http|ftp)\:\/\/)?([w]{3}\.)?(youtube\.)([a-z]{2,4})(\/watch\?v=)([a-zA-Z0-9_-]+)(\&feature=)?([a-zA-Z0-9_-]+)?/";
        $youtube = '<br/><span class="youtube"><object width="325" height="230">
                    <param name="movie" value="http://www.youtube.com/v/$7"/>
                    <param name="wmode" value="transparent"/>
                    <embed src="http://www.youtube.com/v/$7" type="application/x-shockwave-flash" wmode="transparent" width="325" height="230"/>
                    </object></span><br/>';

        $input = preg_replace($search, $youtube, $input);

        return $input;

    }
    
    function getRTime($dt) {

        $diff = time() - $dt;
    if ($diff <= 10)
        return _("vor wenigen Sekunden");
    elseif ($diff < 60)
        return _("vor weniger als einer Minute");

        $diff = round($diff / 60);
    if ($diff == 1)
        return _("vor etwa einer Minute");
    elseif ($diff < 60)
        return sprintf(_("vor etwa %s Minuten"), $diff);

        $diff = round($diff / 60);
    if ($diff == 1)
        return _("vor etwa einer Stunde");
    elseif ($diff < 24)
        return sprintf(_("vor etwa %s Stunden"), $diff);

        $diff = round($diff / 24);
    if ($diff == 1)
        return _("vor etwa einem Tag");
    elseif ($diff < 7)
        return sprintf(_("vor etwa %s Tagen"), $diff);

        $diff = round($diff / 7);
    if ($diff == 1)
        return _("vor etwa einer Woche");
    elseif ($diff < 4)
        return sprintf(_("vor etwa %s Wochen"), $diff);

        return sprintf(_("am %s um %s Uhr"), date("d.m.Y", $dt), date("H:i", $dt));
    }
}
    ?>
