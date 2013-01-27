<?php

class Chat_Table extends BaseApp {


    /**
     * @var int
     */
    public $cid = 0; 

    /**
     * @var int
     */
    public $bid = 0; 

    /**
     * @var string
     */
    public $text = ''; 

    /**
     * @var int
     */
    public $datum = 0; 

    protected $db;

        
    /**
     * The constructer
     */
    public function __construct ($cid = '')
    {
        if (!isset($this->db))
           $this->db = parent::getInstance();

        if (!empty($cid))
        {
           $this->cid = $cid;
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
        'cid' => FILTER_SANITIZE_NUMBER_INT,
        'bid' => FILTER_SANITIZE_NUMBER_INT,
        'text' => FILTER_SANITIZE_STRING,
        'datum' => FILTER_SANITIZE_NUMBER_INT
        );
        return filter_var_array($data, $check);
    }


    /**
     * Delete a element in the Database
     */
    public function del ()
    {
        if (empty($this->cid) || !is_numeric($this->cid))
            return false;

        $sql = "DELETE FROM Chat WHERE cid = :cid";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->bindValue(':cid', $this->cid, PDO::PARAM_INT);
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
        $sql = "SELECT C.cid, C.bid, C.text, C.datum FROM Chat as C";
        if (is_array($data))
        {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value)
            {
                if ($value)
                    $sql .= " C.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Chat');
        return $obj;

    }


    /**
     * Get one Dataset from the db
     */
    public function get ()
    {
        if (empty($this->cid) || !is_numeric($this->cid))
            return false;

        $sql = "SELECT C.cid, C.bid, C.text, C.datum FROM Chat as C WHERE
        C.cid = $this->cid";
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
    public function getChat ()
    {


        $sql = "SELECT C.cid, C.bid, C.text, C.datum, B.nick FROM Chat as C, Benutzer as B WHERE C.bid=B.bid order by C.datum desc limit 10";
        $stmt = $this->db->dbh->query($sql);
        
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Chat_Table');
        return $obj;
    }

    /**
     * The save method is responsability for
     * saving and updating a dataset
     */
    public function save ()
    {
        if (empty($this->cid))
        {
            $sql = 'INSERT INTO Chat 
            (bid, text, datum) VALUES
            (:bid, :text, :datum)';
            $stmt = $this->db->dbh->prepare($sql);
        }
        else
        {
            $sql = 'UPDATE Chat set
                         bid = :bid, 
                         text = :text, 
                         datum = :datum';        
            $sql .= " WHERE cid = :cid";
            $stmt = $this->db->dbh->prepare($sql);
            $stmt->bindValue(':cid', $this->cid, PDO::PARAM_INT);
        }
        $stmt->bindValue(':bid', $this->bid, PDO::PARAM_INT);
        $stmt->bindValue(':text', $this->text, PDO::PARAM_STR);
        $stmt->bindValue(':datum', $this->datum, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>