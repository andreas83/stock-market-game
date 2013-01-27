<?php
class Benutzer_Profil
{
    function __construct()
    {
        $this->Template["index"] = "index.php";
        $this->Template["Passwort"] = "passwort.php";
        $this->Template["Optionen"] = "optionen.php";
        $this->Template["Upload"] = "json.php";
        $this->Template["AvatarLoeschen"] = "index.php";


        $this->Title = _("Profil");

        $benutzer = new Benutzer_Table($_SESSION['login']);
        $this->ExtraHeader = include("app/views/Benutzer/Profil/header.php");
        
    }
    
    function index()
    {
        
        if(isset($_GET['user']))
        {
            $benutzer = new Benutzer_Table();
            $this->benutzer = $benutzer->get_list(array("nick"=>$_GET['user']));
            
            $this->avatar_url = $this->getAvatar($this->benutzer[0]->bid);
            
            $pinnwand = new Pinnwand_Nachrichten();
            $this->pinnwand = $pinnwand->get_list(array("an" => $this->benutzer[0]->bid));            
            
            $this->Template["index"] = "profil.php";
            return true;
        }
        $benutzer = new Benutzer_Table($_SESSION['login']);
        
        $this->benutzer = $benutzer;
        $this->avatar_url = $this->getAvatar($_SESSION['login']);
        
        $pinnwand = new Pinnwand_Nachrichten();
        
        $this->pinnwand = $pinnwand->get_list(array("an" => $benutzer->bid));
    }
    
    /**
     * This function gets the Url of Avatar
     * 
     * First we try to get the uploaded Avatar
     * Second we try to get the Avtar from Facebook
     * Third we try to get the Avatar from Gravatar
     * 
     * @param type $benutzer 
     */
    function getAvatar($bid)
    {
        
        $benutzer = new Benutzer_Table($bid);
        
        $size = 80;
        if(file_exists(Config::get('basedir')."/public/avatar/".$benutzer->nick.".jpg"))
        {
            return "/public/avatar/".$benutzer->nick.".jpg";
        }
        if(is_numeric($benutzer->fbid) && $benutzer->fbid>1)
        {
            return "https://graph.facebook.com/".$benutzer->fbid."/picture?type=large";
        }
        else
        {
            return "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $benutzer->mail ) ) ) . "?s=" . $size;
        }        
        
    }
    
    
    function Passwort()
    {
        $benutzer = new Benutzer_Table($_SESSION['login']);
        
        if($benutzer->pass!==$_POST['oldpass'])
        {
            $this->result=_("Dein altes Passwort stimmt nicht &uuml;berein!");
            return false;
        }
        if(strlen($_POST['newpass'])=="0")
        {
             $this->result=_("Bitte &uuml;berpr&uuml;fe dein neues Passwort!");
             return false;
        }
        $benutzer->pass = $_POST['newpass'];
        $benutzer->save();
        $this->result=_("Dein neues Passwort wurde erfolgreich gespeichert.");
        
    }


    
    function Optionen()
    {
        
        $benutzer = new Benutzer_Table($_SESSION['login']);
        
        if($_POST['sprache'] == "1")
            $benutzer->lang = "1";
        elseif($_POST['sprache'] == "2")
            $benutzer->lang = "2";
        
        if($_POST['design'] == "1")
            $benutzer->design = "1";
        elseif($_POST['design'] == "2")
            $benutzer->design = "2";
        elseif($_POST['design'] == "3")
            $benutzer->design = "3";
        elseif($_POST['design'] == "4")
            $benutzer->design = "4";
        
        $benutzer->save();
        header("Location: /Benutzer/Profil");

    }

    function Daten()
    {
        $benutzer = new Benutzer_Table($_SESSION['login']);
        $benutzer->ueber=$_POST['aboutme'];
        $benutzer->herkunft = $_POST['herkunft'];
        $benutzer->geschlecht = $_POST['geschlecht'];
        $benutzer->name = $_POST['name'];
        
        $benutzer->geburtstag = @date("U", mktime(0, 0, 0, $_POST['monat'], $_POST['tag'], $_POST['jahr']));
        
        $benutzer->save();
        
        $this->index();
        $this->Template["Daten"] = "index.php";
    }
    
    function AvatarLoeschen()
    {      
        $benutzer = new Benutzer_Table($_SESSION['login']);
        if(file_exists(Config::get('basedir') . '/public/avatar/' . $benutzer->nick . ".jpg"))
            unlink(Config::get('basedir') . '/public/avatar/' . $benutzer->nick . ".jpg");
        $this->index();
    }

    
    
    function Upload()
    {
        include(Config::get('basedir') . "/lib/PHPThumb/ThumbLib.inc.php");
        $targetPath = Config::get('basedir') . '/public/avatar'; // Relative to the root
        
        if (!empty($_FILES)) 
        {
            $tempFile = $_FILES['Filedata']['tmp_name'];

            $benutzer = new Benutzer_Table($_SESSION['login']);
            // Validate the file type
            $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            $targetFile=rtrim($targetPath,'/') . '/' .$benutzer->nick.".".$fileParts['extension'];
            if (in_array($fileParts['extension'],$fileTypes)) 
            {
                move_uploaded_file($tempFile,$targetFile);
                try
                {
                     $thumb = PhpThumbFactory::create($targetFile);
                }
                catch (Exception $e)
                {
                     // handle error here however you'd like
                }
                #$thumb->resize(80, 80);
                $thumb->adaptiveResize(80, 80);

                $thumb->save(rtrim($targetPath,'/') . '/' . $benutzer->nick . ".jpg", 'jpg');
                //someone uploaded a file in different format
                if ($targetFile!=rtrim($targetPath,'/') . '/' . $benutzer->nick . ".jpg")
                    unlink ($targetFile);
                
                echo $benutzer->nick . ".jpg";
            } 
            else 
            {
                echo 'none';
            }
        }
    }
        


}
?>
