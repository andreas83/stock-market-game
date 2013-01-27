<?php

class Kurse_Table extends BaseApp {


    /**
     * @var int
     */
    public $kid = 0; 

    /**
     * @var int
     */
    public $fid = 0; 
    
    /**
     * @var int
     */
    public $kurs = 0; 
    
    /**
     * @var string
     */
    public $datum = ''; 

    protected $db;

        
    /**
     * The constructer
     */
    public function __construct ($kid = '')
    {
        if (!isset($this->db))
           $this->db = parent::getInstance();

        if (!empty($kid))
        {
           $this->kid = $kid;
           $this->get();
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
        'kid' => FILTER_SANITIZE_NUMBER_INT,
        'kurs' => FILTER_SANITIZE_NUMBER_INT,
        'fid' => FILTER_SANITIZE_NUMBER_INT,
        'datum' => FILTER_SANITIZE_STRING
        );
        return filter_var_array($data, $check);
    }


    /**
     * Delete a element in the Database
     */
    public function del ()
    {
        if (empty($this->kid) || !is_numeric($this->kid))
            return false;

        $sql = "DELETE FROM Kurse WHERE kid = :kid";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->bindValue(':kid', $this->kid, PDO::PARAM_INT);
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
        $sql = "SELECT K.kid, K.fid, K.kurs, K.datum FROM Kurse as K";
        if (is_array($data))
        {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value)
            {
                if ($value)
                    $sql .= " K.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Kurse_Table');
        return $obj;

    }


    /**
     * Get one Dataset from the db
     */
    public function get ()
    {
        if (empty($this->kid) || !is_numeric($this->kid))
            return false;

        $sql = "SELECT K.kid, K.fid, K.kurs, K.datum FROM Kurse as K WHERE
        K.kid = $this->kid";
        
        $stmt = $this->db->dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key=>$val)
        {
            $this->$key=$val;
        }
    }

    
    /**
     * Get one Dataset from the db
     */
    public function getStocks ($fid)
    {
        
        $sql = "SELECT K.kid, K.kurs, K.fid, K.datum FROM Kurse as K WHERE
        K.fid = $fid order by K.kid desc limit 1";
        
        $stmt = $this->db->dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result))
        {
	        foreach ($result as $key=>$val)
	        {
	            $this->$key=$val;
	        }
        }
    }
    

    /**
     * The save method is responsability for
     * saving and updating a dataset
     */
    public function save ()
    {
        if (empty($this->kid))
        {
            $sql = 'INSERT INTO Kurse 
            (fid, kurs, datum) VALUES
            (:fid, kurs, :datum)';
            $stmt = $this->db->dbh->prepare($sql);
        }
        else
        {
            $sql = 'UPDATE Kurse set
                         fid = :fid, 
                         kurs = :kurs,
                         datum = :datum';        
            $sql .= " WHERE kid = :kid";
            $stmt = $this->db->dbh->prepare($sql);
            $stmt->bindValue(':kid', $this->kid, PDO::PARAM_INT);
        }
        $stmt->bindValue(':fid', $this->fid, PDO::PARAM_INT);
        $stmt->bindValue(':kurs', $this->kurs, PDO::PARAM_INT);
        $stmt->bindValue(':datum', $this->datum, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>