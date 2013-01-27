<?php

class Pinnwand_Kommentare extends BaseApp {


    /**
     * @var int
     */
    public $kid = 0; 

    /**
     * @var int
     */
    public $pid = 0; 

    /**
     * @var int
     */
    public $von = 0; 

    /**
     * @var string
     */
    public $text = ''; 

    /**
     * @var int
     */
    public $date = 0; 

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
        'pid' => FILTER_SANITIZE_NUMBER_INT,
        'von' => FILTER_SANITIZE_NUMBER_INT,
        'text' => FILTER_SANITIZE_STRING,
        'date' => FILTER_SANITIZE_NUMBER_INT
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

        $sql = "DELETE FROM PinnwandKommentare WHERE kid = :kid";
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
        $sql = "SELECT P.kid, P.pid, P.von, P.text, P.date FROM PinnwandKommentare as P";
        if (is_array($data))
        {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value)
            {
                if ($value)
                    $sql .= " P.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Pinnwand_Kommentare');
        return $obj;

    }


    /**
     * Get one Dataset from the db
     */
    public function get ()
    {
        if (empty($this->kid) || !is_numeric($this->kid))
            return false;

        $sql = "SELECT P.kid, P.pid, P.von, P.text, P.date FROM PinnwandKommentare as P WHERE
        P.kid = $this->kid";
        $stmt = $this->db->dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key=>$val)
        {
            $this->$key=$val;
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
            $sql = 'INSERT INTO PinnwandKommentare 
            (pid, von, text, date) VALUES
            (:pid, :von, :text, :date)';
            $stmt = $this->db->dbh->prepare($sql);
        }
        else
        {
            $sql = 'UPDATE PinnwandKommentare set
                         pid = :pid, 
                         von = :von, 
                         text = :text, 
                         date = :date';        
            $sql .= " WHERE kid = :kid";
            $stmt = $this->db->dbh->prepare($sql);
            $stmt->bindValue(':kid', $this->kid, PDO::PARAM_INT);
        }
        $stmt->bindValue(':pid', $this->pid, PDO::PARAM_INT);
        $stmt->bindValue(':von', $this->von, PDO::PARAM_INT);
        $stmt->bindValue(':text', $this->text, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>