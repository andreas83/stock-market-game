<?php
class Config
{
    public static $instance = NULL;

    protected $debug = true;

    protected $dsn = '';

    protected $db_user = '';

    protected $db_pass = '';

    protected $basedir = '';

    protected $template = 'default';

    protected $allowed = array();

    /**
     * Constructor
     */
    protected function __construct()
    {       
        // posible addons
    }
    
    
    /**
     * singelton constructor
     */
    public static function create_instance()
    {
    	if (self::$instance === NULL)
    	{
    		self::$instance = new Config();
    	}
    	return self::$instance;
    }
     
    
    /**
     * dynamic get method 
     * 
     * @param $var
     * 
     * @return $var
     */
    public static function get($var)
    {
        if (!property_exists(self::$instance, $var)) return false;
        
        return self::$instance->$var;
    }
    
    
    
    /**
     * dynamic setter
     * 1st param property name
     * 2nd param property val
     * 
     * @param string $var 
     * @param string|int|bool|array $val
     * 
     * @return bool
     */
    public static function set($var, $val)
    {
        self::$instance->$var = $val;
        return true;
    }
    
    
    
    public function __destruct()
    {
    	// possible addons
    }
}
?>
