<?php

class Facebook_User
{
    public $facebook;
    private $user=false;
    private $user_profile;
    
    function __construct() {
        
        include(Config::get('basedir') . "/lib/facebook-php-sdk/src/base_facebook.php");
	include(Config::get('basedir') . "/lib/facebook-php-sdk/src/facebook.php");

        // Create our Application instance (replace this with your appId and secret).
        $this->facebook = new Facebook(array(
          'appId'  => Config::get('fb_appId'),
          'secret' => Config::get('fb_secret'),
        ));
        // Get User ID
        $this->user = $this->facebook->getUser();
        if ($this->user) {
          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $this->user_profile = $this->facebook->api('/me');
          } catch (FacebookApiException $e) {
            error_log($e);
            $this->user = null;
          }
        }
        
        $this->Template["Register"] = "register.php";
        $this->Template["Login"] = "index.php";
        $this->Template["Logout"] = "index.php";
    }
    
    function Register()
    {

#	if(!$this->user_profile['email'])
#		header("Location: https://www.facebook.com/dialog/oauth?client_id=142118852542611&redirect_uri=http://beta.boersenspiel.ath.cx/Facebook/User/Login&scope=email");
        $this->result=array();
        if($_POST && $_POST['nick']!="" && $this->user_profile)
        {

            $benutzer = new Benutzer_Table();

            if ($benutzer->isBenutzer($_POST['nick'], $this->user_profile['email'])) {
                $this->result[] = _("Der Benutzername oder die E-Mail Adresse ist berreits vergeben.");
                return false;
            } else {
                $benutzer->mail = $this->user_profile['email'];
                $benutzer->nick = $_POST['nick'];
                $pass = Benutzer_Register::generateCode(5);
                $benutzer->pass = hash("sha512", $pass);
                $benutzer->guthaben = 5000;
                $benutzer->fbid = $this->user_profile['id'];
		$benutzer->lastlogin=@date("H:i:s Y-m-s");
		$benutzer->geschlecht=($this->user_profile['gender']=="male" ? "m" : "f");
                $benutzer->save();
                Benutzer_Register::sendConfirmation($benutzer->nick, $pass, $this->user_profile['email']);
                $_SESSION['login'] = $benutzer->bid;
                header("Location: /Aktien/Uebersicht");
            }
        }
        $this->fbuser=$this->user_profile;
    }
    
    function Login()
    {
     if (empty($this->user)) {
            echo("<script> top.location.href='" . $this->facebook->getLoginUrl(array('scope' => 'email'))  . "'</script>");
     } else {
        $benutzer = new Benutzer_Table();
        $benutzer->fbid = $this->user;
        $benutzer->getByFBID();
        //schauen ob benutzer berreits regestriert ist
        if(is_numeric($benutzer->bid) and $benutzer->bid>0)
        {
            $_SESSION['login']=$benutzer->bid;
            header("Location: /Aktien/Uebersicht");
        }
        else
        {

	    $this->Register();
            $this->Template["Login"] = "register.php";
        }
     } 

    }
    
    function Logout()
    {
        if($this->user)
            header("Location: ".$this->facebook->getLogoutUrl());
    }
}

