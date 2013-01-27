<?php

class Nachrichten_Table extends BaseApp {


    /**
     * @var int
     */
    public $nid = 0; 

    /**
     * @var int
     */
    public $von = 0; 

    /**
     * @var int
     */
    public $an = 0; 

    /**
     * @var string
     */
    public $betreff = ''; 

    /**
     * @var string
     */
    public $nachricht = ''; 

    /**
     * @var string
     */
    public $status = ''; 

    /**
     * @var int
     */
    public $date = ''; 
    
    protected $db;

        
    /**
     * The constructer
     */
    public function __construct ($nid = '')
    {
        if (!isset($this->db))
           $this->db = parent::getInstance();

        if (!empty($nid))
        {
           $this->nid = $nid;
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
        'nid' => FILTER_SANITIZE_NUMBER_INT,
        'von' => FILTER_SANITIZE_NUMBER_INT,
        'an' => FILTER_SANITIZE_NUMBER_INT,
        'betreff' => FILTER_SANITIZE_STRING,
        'nachricht' => FILTER_SANITIZE_STRING,
        'status' => FILTER_SANITIZE_STRING,
        'date' => FILTER_SANITIZE_STRING
        );
        return filter_var_array($data, $check);
    }


    /**
     * Delete a element in the Database
     */
    public function del ()
    {
        if (empty($this->nid) || !is_numeric($this->nid))
            return false;

        $sql = "DELETE FROM Nachrichten WHERE nid = :nid";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->bindValue(':nid', $this->nid, PDO::PARAM_INT);
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
        $sql = "SELECT N.nid, N.von, N.an, N.betreff, N.nachricht, N.status, N.date FROM Nachrichten as N";
        if (is_array($data))
        {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value)
            {
                if ($value)
                    $sql .= " N.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        $sql.= " and status!='deleted' and (N.von=".$_SESSION['login']." or N.an=".$_SESSION['login'].") order by N.status desc";
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Nachrichten_Table');
        return $obj;

    }


    /**
     * Get one Dataset from the db
     */
    public function get ()
    {
        if (empty($this->nid))
            return false;

        $sql = "SELECT N.nid, N.von, N.an, N.betreff, N.nachricht, N.status, N.date FROM Nachrichten as N WHERE
        md5(N.nid) = '$this->nid' and (N.von=".$_SESSION['login']." or N.an=".$_SESSION['login'].")";
        
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
        if (empty($this->nid))
        {
            $sql = 'INSERT INTO Nachrichten 
            (von, an, betreff, nachricht, status, date) VALUES
            (:von, :an, :betreff, :nachricht, :status, :date)';
            $stmt = $this->db->dbh->prepare($sql);
        }
        else
        {
            $sql = 'UPDATE Nachrichten set
                         von = :von, 
                         an = :an, 
                         betreff = :betreff, 
                         nachricht = :nachricht, 
                         status = :status,
                         date = :date';        
            $sql .= " WHERE nid = :nid";
            $stmt = $this->db->dbh->prepare($sql);
            $stmt->bindValue(':nid', $this->nid, PDO::PARAM_INT);
        }
        $stmt->bindValue(':von', $this->von, PDO::PARAM_INT);
        $stmt->bindValue(':an', $this->an, PDO::PARAM_INT);
        $stmt->bindValue(':betreff', $this->betreff, PDO::PARAM_STR);
        $stmt->bindValue(':nachricht', $this->nachricht, PDO::PARAM_STR);
        $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>