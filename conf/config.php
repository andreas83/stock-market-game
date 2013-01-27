<?php
Config::create_instance();
Config::set('debug', true);
Config::set('dsn', 'mysql:host=localhost;dbname=boerse');
Config::set('db_user', '');
Config::set('db_pass', '');
Config::set('basedir', '/var/www/');
Config::set('template', 'default');
Config::set('allowed',  array("Uebersicht", "Info", "Register", "Anmelden", "Chart", "Abmelden", "Login", "Speichern"));

// gettext settings
Config::set('directory', Config::get('basedir') . '/app/lang');
Config::set('domain','Boersenspiel');

// memcache
Config::set('memcache_config', array(
//array("host" => "localhost", "port" => "11211", "persistent" => true, "weight" => 100, "timeout" => 1)
));

// facebook settings
Config::set('fb_appId','');
Config::set('fb_secret','');
?>
