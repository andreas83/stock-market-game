<?php 
/**
 * Auto loader
 * @param string $className
 */
function autoload($className) 
{
    $class = "app/model/" . str_replace("_", "/", $className) . ".php";
    if (file_exists($class)) {
        require_once($class);
        return true;
    }
    $class = "app/controller/" . str_replace("_", "/", $className) . ".php";
    if (file_exists($class)) {
        require_once($class);
        return true;
    }
    $class = "app/init/" . str_replace("_", "/", $className) . ".php";
    if (file_exists($class)) {
        require_once($class);
        return true;
    }
    return false;
}
spl_autoload_register("autoload");

require_once('conf/config.php');
require_once("app/init/BaseApp.php");

if (isset($_GET['sid'])) session_id($_GET['sid']);

session_start();

// initialize the user
if (isset($_SESSION['login']) && is_numeric($_SESSION['login']) && $_SESSION['login']>0) {
    $benutzer = new Benutzer_Table((int) $_SESSION['login']);
    $benutzer->lastlogin = @date("Y-m-d H:i:s");
    $benutzer->save();
}

if (!empty($benutzer)) 
{
    switch ($benutzer->design) {
        case '1':
            Config::set('design', 'blue');
            Config::set('chartcolor1', '5B9828');
            Config::set('chartcolor2', 'BED5E7');
            Config::set('chartcolor3', '6EA1C9');
            break;
        case '2':
            Config::set('design', 'grey');
            Config::set('chartcolor1', 'A45700');
            Config::set('chartcolor2', 'BFBFBF');
            Config::set('chartcolor3', 'A2A2A2');
            break;
        case '3':
            Config::set('design', 'green');
            Config::set('chartcolor1', '70A2CA');
            Config::set('chartcolor2', 'C5EAC0');
            Config::set('chartcolor3', '629C29');
            break;
        case '4':
            Config::set('design', 'orange');
            Config::set('chartcolor1', '808080');
            Config::set('chartcolor2', 'E9DAC0');
            Config::set('chartcolor3', 'D89213');
            break;
        default:
            Config::set('design', 'blue');
            Config::set('chartcolor1', '5B9828');
            Config::set('chartcolor2', 'BED5E7');
            Config::set('chartcolor3', '6EA1C9');
            break;
    }

    if ($benutzer->lang == "2") {
        Config::set('locale', 'en_GB');
    } elseif ($benutzer->lang == "1") {
    	Config::set('locale', 'de_DE');
    } else {
   		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if ($lang == "de") {
            Config::set('locale', 'de_DE');
        } else {
            Config::set('locale', 'en_GB');
        }
    }
} else {
    // basic default values
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if ($lang == "de") {
		Config::set('locale', 'de_DE');
	} else {
		Config::set('locale', 'en_GB');
	}
    Config::set('design', 'blue');
	Config::set('chartcolor1', '5B9828');
	Config::set('chartcolor2', 'BED5E7');
	Config::set('chartcolor3', '6EA1C9');
}
// check if the init script is from a http agent
if (!empty($_SERVER['HTTP_HOST']))
{
	putenv("LANG=". Config::get('locale'));
	setlocale(LC_MESSAGES, Config::get('locale'));
	bindtextdomain(Config::get('domain'), Config::get('directory'));
	textdomain(Config::get('domain'));
	bind_textdomain_codeset(Config::get('domain'), 'UTF-8');
}
?>
