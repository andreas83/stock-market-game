<?php
class BaseApp
{
    protected $dbh;

    protected $cache;
    
    private static $instance;

    public function  __construct() 
    {        
        set_exception_handler(array(__CLASS__, 'fallback_handler'));
        //database init
        $this->dbh = new PDO(Config::get('dsn'), Config::get('db_user'), Config::get('db_pass'));

        restore_exception_handler();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    public static function fallback_handler($exception) 
    {
        die('Uncaught exception: ' . $exception->getMessage());
    }
    
    public function memcache_connect()
    {
        //memcache init
        if (count(Config::get('memcache_config'))>0)
        {
            $memcache_config = Config::get('memcache_config');
            $memcache = new Memcache;
            foreach ($memcache_config as $key => $value)
               $memcache->addserver($memcache_config[$key]['host'],
                                  $memcache_config[$key]['port'],
                                  $memcache_config[$key]['persistent'],
                                  $memcache_config[$key]['weight'],
                                  $memcache_config[$key]['timeout']);
           
           return $memcache;            
        }
    }
}

?>
