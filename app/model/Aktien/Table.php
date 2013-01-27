<?php

class Aktien_Table extends BaseApp {


    /**
     * @var int
     */
    public $aid = 0; 

    /**
     * @var int
     */
    public $kid = 0; 

    /**
     * @var int
     */
    public $bid = 0; 

    /**
     * @var int
     */
    public $anzahl = 0; 

    protected $db;

        
    /**
     * The constructer
     */
    public function __construct ($aid = '')
    {
        if (!isset($this->db))
           $this->db = parent::getInstance();

        if (!empty($aid))
        {
           $this->aid = $aid;
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
        'aid' => FILTER_SANITIZE_NUMBER_INT,
        'kid' => FILTER_SANITIZE_NUMBER_INT,
        'bid' => FILTER_SANITIZE_NUMBER_INT,
        'anzahl' => FILTER_SANITIZE_NUMBER_INT
        );
        return filter_var_array($data, $check);
    }


    /**
     * Delete a element in the Database
     */
    public function del ()
    {
        if (empty($this->aid) || !is_numeric($this->aid))
            return false;

        $sql = "DELETE FROM Aktien WHERE aid = :aid";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->bindValue(':aid', $this->aid, PDO::PARAM_INT);
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
        $sql = "SELECT A.aid, A.kid, A.bid, A.anzahl FROM Aktien as A";
        if (is_array($data))
        {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value)
            {
                if ($value)
                    $sql .= " A.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Aktien');
        return $obj;

    }


    /**
     * Get one Dataset from the db
     */
    public function get ($bid = false)
    {
        if (empty($this->aid) || !is_numeric($this->aid))
            return false;

        $sql = "SELECT A.aid, A.kid, A.bid, A.anzahl FROM Aktien as A WHERE
        A.aid = $this->aid";
        if($bid)
            $sql.=" and A.bid=".$bid;
        
        $stmt = $this->db->dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result)
        {
            foreach ($result as $key=>$val)
            {
                $this->$key=$val;
            }
            return true;
        }else
        {
            return false;
        }
        
    }


    /**
     * The save method is responsability for
     * saving and updating a dataset
     */
    public function save ()
    {
        if (empty($this->aid))
        {
            $sql = 'INSERT INTO Aktien 
            (kid, bid, anzahl) VALUES
            (:kid, :bid, :anzahl)';
            $stmt = $this->db->dbh->prepare($sql);
        }
        else
        {
            $sql = 'UPDATE Aktien set
                         kid = :kid, 
                         bid = :bid, 
                         anzahl = :anzahl';        
            $sql .= " WHERE aid = :aid";
            $stmt = $this->db->dbh->prepare($sql);
            $stmt->bindValue(':aid', $this->aid, PDO::PARAM_INT);
        }
        $stmt->bindValue(':kid', $this->kid, PDO::PARAM_INT);
        $stmt->bindValue(':bid', $this->bid, PDO::PARAM_INT);
        $stmt->bindValue(':anzahl', $this->anzahl, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>