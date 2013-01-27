<?php
require_once('app/init/init.php');
header("Content-Type: text/html; charset=utf-8");

$modul = (isset($_GET['modul']) ? $_GET['modul'] : false);

if (!$modul) {
    $view = new stdClass();
    $view->Title = "B&ouml;rsenspiel";
    include("template/" . Config::get('template') . "/header.php");
    include("template/" . Config::get('template') . "/navigation.php");
    include("template/" . Config::get('template') . "/footer.php");
    return true;
}

$modul = explode("/", $modul);
$filename = implode("/", $modul) . ".php";

if (file_exists("./app/controller/" . $filename)) {
    if (!in_array(end($modul), Config::get('allowed')) && !isset($_SESSION['login'])) {
        header('Location: /Benutzer/Anmelden');
    } else {
        include ("./app/controller/" . $filename);
        $classname = implode("_", $modul);
        $view = new $classname;
        $view->index();
    }

    //include template
    if ($view->Template['index'] !== "json.php") {
        include("template/" . Config::get('template') . "/header.php");
        include("template/" . Config::get('template') . "/navigation.php");
    }
    else
    {
        header('Content-type: application/json');
    }


    if (!in_array(end($modul), Config::get('allowed')) && !isset($_SESSION['login'])) {
        header('Location: /Benutzer/Anmelden');
        return false;
    }
    //include template
    $template = $modul[0] . "/" . end($modul) . "/" . $view->Template['index'];
    include ("./app/views/" . $template);

    if ($view->Template['index'] !== "json.php") {
        //add footer
        include("template/" . Config::get('template') . "/footer.php");
    }
} elseif (file_exists("./app/controller/" . implode("/", array_slice($modul, 0, -1)) . ".php")) {
    if (!in_array(end($modul), Config::get('allowed')) && !isset($_SESSION['login'])) {
        header('Location: /Benutzer/Anmelden');
    } else {
        include ("./app/controller/" . implode("/", array_slice($modul, 0, -1)) . ".php");
        $classname = implode("_", array_slice($modul, 0, -1));
        $view = new $classname;
        $method = end($modul);
        $view->$method();
    }
    //include template
    if ($view->Template[end($modul)] !== "json.php") {
        include("template/" . Config::get('template') . "/header.php");
        include("template/" . Config::get('template') . "/navigation.php");
    }
    else
    {
        header('Content-type: application/json');
    }
    $template = $modul[0] . "/" . end(array_slice($modul, 0, -1)) . "/" . $view->Template[end($modul)];
    if (file_exists("./app/views/" . $template))
        include("./app/views/" . $template);
    else
        echo "Template not found: ./module/" . $template;

    if ($view->Template[end($modul)] !== "json.php") {
        //add footer
        include("template/" . Config::get('template') . "/footer.php");
    }
} else {
    echo "wtf <img src=\"/public/img/smilies/icon_huh.png\" />";
}
?>
