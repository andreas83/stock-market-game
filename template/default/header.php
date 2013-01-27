<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
    <head>
        <title><?php echo $view->Title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" type="image/x-icon" href="/public/img/favicon.ico"/>
        <link rel="stylesheet" href="/public/css/default.css" type="text/css"/>
        <link rel="stylesheet" href="/public/css/<?php echo Config::get('design'); ?>.css" type="text/css"/>
        <link rel="stylesheet" href="/public/css/jquery-ui-1.8.16.custom.css" type="text/css"/>
        <script type="text/javascript" src="/public/js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="/public/js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="/public/js/excanvas.min.js"></script>
        <script type="text/javascript" src="/public/js/jquery.flot.min.js"></script>
        <script type="text/javascript" src="/public/js/jquery.menu.js"></script>
        <script type="text/javascript" src="/public/js/jquery.tooltip.js"></script>
	
	 <?php
        if (isset($view->ExtraHeader))
            echo $view->ExtraHeader;
        ?>

    </head>
<body<?php echo (isset($view->BodyOnload) ? " onload=\"$view->BodyOnload\"" : ""); ?>>
	<div class="logo">
		<a href="/index.php"><img src="/public/img/boerse_<?php echo Config::get('locale'); ?>.png" alt="Logo" title="Das B&ouml;rsenspiel f&uuml;r Jung und Alt!" /></a>
		</div>

		<div class="pageframe">
