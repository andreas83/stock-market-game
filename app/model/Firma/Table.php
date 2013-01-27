<?php

class Firma_Table extends BaseApp {


    /**
     * @var int
     */
    public $fid = 0; 

    /**
     * @var string
     */
    public $name = ''; 

    /**
     * @var int
     */
    public $anteile = 0; 

    /**
     * @var string
     */
    public $ueber = ''; 

    /**
     * @var string
     */
    public $url = ''; 

    /**
     * @var string
     */
    public $code = ''; 

    protected $db;

        
    /**
     * The constructer
     */
    public function __construct ($fid = '')
    {
        if (!isset($this->db))
           $this->db = parent::getInstance();
 
        if (!empty($fid))
        {
           
           $this->fid = $fid;
           
           //try to get data from memcache
           $this->cache = parent::memcache_connect();
           if($this->cache->get("Firma_Table".$fid))
           {
               foreach($this->cache->get("Firma_Table".$fid) as $key => $value)
               {
                   $this->$key = $value;
               }
               if (!isset($this->db))
                    $this->db = parent::getInstance();
               return;
           }
           
           
           $this->get();
           
           unset($this->db);
           $this->cache->set("Firma_Table".$fid, $this);
           $this->db = parent::getInstance();
           
        }

    }


    /**
     * Sanitize a input array
     *
     * @param array $data
     * @return array
     */
    public function check($data = '')
    {
        $check = array(
        'fid' => FILTER_SANITIZE_NUMBER_INT,
        'name' => FILTER_SANITIZE_STRING,
        'anteile' => FILTER_SANITIZE_NUMBER_INT,
        'ueber' => FILTER_SANITIZE_STRING,
        'url' => FILTER_SANITIZE_STRING,
        'code' => FILTER_SANITIZE_STRING
        );
        return filter_var_array($data, $check);
    }


    /**
     * Delete a element in the Database
     */
    public function del ()
    {
        if (empty($this->fid) || !is_numeric($this->fid))
            return false;

        $sql = "DELETE FROM Firma WHERE fid = :fid";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->bindValue(':fid', $this->fid, PDO::PARAM_INT);
        $stmt->execute();
    }


    /**
     * Get a list of objects
     *
     * @param array $data optional if you like to get only a subset of data
     *
     * @return obj
     */
    public function get_list ($data = '')
    {
        $sql = "SELECT F.fid, F.name, F.anteile, F.ueber, F.url, F.code FROM Firma as F";
        if (is_array($data))
        {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value)
            {
                if ($value)
                    $sql .= " F.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        $stmt = $this->db->dbh->query($sql);
        
        
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Firma_Table');
        return $obj;

    }


    /**
     * Get one Dataset from the db
     */
    public function get ()
    {
        if (empty($this->fid) || !is_numeric($this->fid))
            return false;

        $sql = "SELECT F.fid, F.name, F.anteile, F.ueber, F.url, F.code FROM Firma as F WHERE
        F.fid = $this->fid";
        $stmt = $this->db->dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key=>$val)
        {
            $this->$key=$val;
        }
    }
    
    
    public function getUserStocks ($aid = false)
    {
        $sql="select * from Aktien, Firma, Kurse where Aktien.bid=".$_SESSION['login']." and Aktien.kid=Kurse.kid and Kurse.fid=Firma.fid";
        
        if($aid and is_numeric($aid))
        {
            $sql.=" and Aktien.aid=".$aid;
        }
        
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Firma_Table');
        return $obj;
    }
    
    
    /**
     * Get total stocks, and specific pages
     */
    public function getPages ($pointer = false, $zeige = false)
    {
        
        if(!$pointer && !$zeige)
        {
            $sql = "SELECT count(fid) as Firmen FROM Firma";
            $stmt = $this->db->dbh->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $key=>$val)
            {
                $this->$key=$val;
            }
        
            return true;
        }
        
        $sql = "SELECT F.fid, F.name, F.anteile, F.ueber, F.url, F.code FROM Firma as F limit $pointer, $zeige";
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Firma_Table');
        return $obj;
    }
    
    
    /**
     * Get one Dataset from the db for chart
     */
    public function getChart ()
    {
        if (empty($this->fid) || !is_numeric($this->fid))
            return false;

        $sql = "
        SELECT 
            Firma.name, 
            UNIX_TIMESTAMP(Kurse.datum) as datum, 
            Kurse.kurs
        FROM 
            Kurse, 
            Firma 
        WHERE 
            Kurse.fid = Firma.fid and 
            Firma.fid=$this->fid and 
            Kurse.kid NOT IN (SELECT kid FROM Aktien)

        order by datum desc limit 200";
        
        $stmt = $this->db->dbh->query($sql);
        
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Firma_Table');
        return $obj;
    }


    /**
     * The save method is responsability for
     * saving and updating a dataset
     */
    public function save ()
    {
        if (empty($this->fid))
        {
            $sql = 'INSERT INTO Firma 
            (name, anteile, ueber, url, code) VALUES
            (:name, :anteile, :ueber, :url, :code)';
            $stmt = $this->db->dbh->prepare($sql);
        }
        else
        {
            $sql = 'UPDATE Firma set
                         name = :name, 
                         anteile = :anteile, 
                         ueber = :ueber, 
                         url = :url, 
                         code = :code';        
            $sql .= " WHERE fid = :fid";
            $stmt = $this->db->dbh->prepare($sql);
            $stmt->bindValue(':fid', $this->fid, PDO::PARAM_INT);
        }
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':anteile', $this->anteile, PDO::PARAM_INT);
        $stmt->bindValue(':ueber', $this->ueber, PDO::PARAM_STR);
        $stmt->bindValue(':url', $this->url, PDO::PARAM_STR);
        $stmt->bindValue(':code', $this->code, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
