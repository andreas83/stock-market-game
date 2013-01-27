<?php

class Spiel_Chat {

    function __construct() {
        $this->Template["index"] = "index.php";
        $this->Template["getContent"] = "json.php";
        $this->Template["saveContent"] = "json.php";
        $this->Title = "Chat";
    }

    function index() {
        $this->ExtraHeader = include("app/views/Spiel/Chat/header.php");
    }

    function getContent() {
        if (!is_numeric($_SESSION['login'])) {
            $this->result = array("result" => "error", "content" => "Bitte neu Anmelden");
            return false;
        }
        $benutzer = new Benutzer_Table($_SESSION['login']);
        $chat = new Chat_Table();
        $content = "";
        $data = $chat->getChat();
        $data = array_reverse($data);

    function getRTime($date) {

        $diff = time() - $date;
    if ($diff <= 10)
        return _("Vor wenigen Sekunden");
    elseif ($diff < 60)
        return _("Vor weniger als einer Minute");

        $diff = round($diff / 60);
    if ($diff == 1)
        return _("Vor etwa einer Minute");
    elseif ($diff < 60)
        return sprintf(_("Vor etwa %s Minuten"), $diff);

        $diff = round($diff / 60);
    if ($diff == 1)
        return _("Vor etwa einer Stunde");
    elseif ($diff < 24)
        return sprintf(_("Vor etwa %s Stunden"), $diff);

        $diff = round($diff / 24);
    if ($diff == 1)
        return _("Vor etwa einem Tag");
    elseif ($diff < 7)
        return sprintf(_("Vor etwa %s Tagen"), $diff);

        $diff = round($diff / 7);
    if ($diff == 1)
        return _("Vor etwa einer Woche");
    elseif ($diff < 4)
        return sprintf(_("Vor etwa %s Wochen"), $diff);

        return sprintf(_("Am %s um %s Uhr"), date("d.m.Y", $date), date("H:i", $date));
    }

        foreach ($data as $row) {

            $content.="<div class=\"chatcontainer\">
                <img class=\"chatimg\" src=\"/public/img/chatuser.png\" alt=\"\"/> 
                    <a href=\"/Benutzer/Profil?user=".$row->nick."\">".$row->nick."</a>
                    <br/>
                    <span class=\"chattime\">".getRTime($row->datum)."</span>
                <p class=\"bubble top\">".$row->text."<p/>
            </div>\n";
        }

        $users = "";

        foreach ($benutzer->getActive() as $user) {

            $users.="<img class=\"chatimg\" src=\"/public/img/chatuser.png\" alt=\"\"/> <a href=\"/Benutzer/Profil?user=".$user->nick."\">".$user->nick."</a><br/>";
        }

        function makeLinks($content) {

            $content = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '<a href="\\1" target="_blank">\\1</a>', $content);
            $content = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '\\1<a href="http://\\2" target="_blank">\\2</a>', $content);
            $content = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})', '<a href="mailto:\\1">\\1</a>', $content);

            return $content;
        }

        $content = str_replace("[biggrin]", "<img alt=\"\" src=\"/public/img/smilies/icon_biggrin.png\" alt=\"biggrin\" title=\"biggrin\"/>", $content);
        $content = str_replace("[confused]", "<img alt=\"\" src=\"/public/img/smilies/icon_confused.png\" alt=\"confused\" title=\"confused\"/>", $content);
        $content = str_replace("[cool]", "<img alt=\"\" src=\"/public/img/smilies/icon_cool.png\" alt=\"cool\" title=\"cool\"/>", $content);
        $content = str_replace("[huh]", "<img alt=\"\" src=\"/public/img/smilies/icon_huh.png\" alt=\"huh\" title=\"huh\"/>", $content);
        $content = str_replace("[mad]", "<img alt=\"\" src=\"/public/img/smilies/icon_mad.png\" alt=\"mad\" title=\"mad\"/>", $content);
        $content = str_replace("[neutral]", "<img alt=\"\" src=\"/public/img/smilies/icon_neutral.png\" alt=\"neutral\" title=\"neutral\"/>", $content);
        $content = str_replace("[sad]", "<img alt=\"\" src=\"/public/img/smilies/icon_sad.png\" alt=\"sad\" title=\"sad\"/>", $content);
        $content = str_replace("[smile]", "<img alt=\"\" src=\"/public/img/smilies/icon_smile.png\" alt=\"smile\" title=\"smile\"/>", $content);
        $content = str_replace("[surprised]", "<img alt=\"\" src=\"/public/img/smilies/icon_money.png\" alt=\"money\" title=\"money\"/>", $content);
        $content = str_replace("[wink]", "<img alt=\"\" src=\"/public/img/smilies/icon_wink.png\" alt=\"wink\" title=\"wink\"/>", $content);
        $content = str_replace("[tongue]", "<img alt=\"\" src=\"/public/img/smilies/icon_tongue.png\" alt=\"tongue\" title=\"tongue\"/>", $content);
        $content = str_replace("[kiss]", "<img alt=\"\" src=\"/public/img/smilies/icon_kiss.png\" alt=\"kiss\" title=\"kiss\"/>", $content);

        $this->result = array("result" => "done", "content" => makeLinks($content), "user" => $users);
    }

    function saveContent() {
        if (!is_numeric($_SESSION['login'])) {
            $this->result = array("result" => "error", "content" => "Bitte neu Anmelden");
            return false;
        }
        $benutzer = new Benutzer_Table($_SESSION['login']);
        $chat = new Chat_Table();
        $chat->bid = $_SESSION['login'];
        $chat->datum = @date("U");
        $newcont = $_POST['text'];
        $chat->text = $newcont;
        $chat->save();
        $this->result = array("result" => "done");
    }

}
?>

