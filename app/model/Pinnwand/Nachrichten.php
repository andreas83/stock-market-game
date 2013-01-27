<?php

class Pinnwand_Nachrichten extends BaseApp {


    /**
     * @var int
     */
    public $pid = 0; 

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
    public $text = ''; 

    /**
     * @var int
     */
    public $date = 0; 

    /**
     * @var string
     */
    public $von_nick = ''; 

    /**
     * @var string
     */
    public $an_nick = ''; 
    
    
    protected $db;

        
    /**
     * The constructer
     */
    public function __construct ($pid = '')
    {
        if (!isset($this->db))
           $this->db = parent::getInstance();

        if (!empty($pid))
        {
           $this->pid = $pid;
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
        'pid' => FILTER_SANITIZE_NUMBER_INT,
        'von' => FILTER_SANITIZE_NUMBER_INT,
        'an' => FILTER_SANITIZE_NUMBER_INT,
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
        if (empty($this->pid) || !is_numeric($this->pid))
            return false;

        $sql = "DELETE FROM Pinnwand WHERE pid = :pid and (an=".$_SESSION['login']." or von=".$_SESSION['login'].")";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->bindValue(':pid', $this->pid, PDO::PARAM_INT);
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
        $sql = "SELECT P.pid, P.von, P.an, P.text, P.date, Von.Nick as von_nick, An.Nick as an_nick FROM Pinnwand as P, Benutzer as Von, Benutzer as An";
        if (is_array($data))
        {
            $data = $this->check($data);
            $sql .= " WHERE P.von=Von.bid and P.an=An.bid AND";
            foreach ($data as $key => $value)
            {
                if ($value)
                    $sql .= " P.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        $sql.=" order by P.date desc"; 
        $stmt = $this->db->dbh->query($sql);
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Pinnwand_Nachrichten');
        return $obj;

    }


    /**
     * Get one Dataset from the db
     */
    public function get ()
    {
        if (empty($this->pid) || !is_numeric($this->pid))
            return false;

        $sql = "SELECT P.pid, P.von, P.an, P.text, P.date FROM Pinnwand as P WHERE
        P.pid = $this->pid";
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
        if (empty($this->pid))
        {
            $sql = 'INSERT INTO Pinnwand 
            (von, an, text, date) VALUES
            (:von, :an, :text, :date)';
            $stmt = $this->db->dbh->prepare($sql);
        }
        else
        {
            $sql = 'UPDATE Pinnwand set
                         von = :von, 
                         an = :an, 
                         text = :text, 
                         date = :date';        
            $sql .= " WHERE pid = :pid";
            $stmt = $this->db->dbh->prepare($sql);
            $stmt->bindValue(':pid', $this->pid, PDO::PARAM_INT);
        }
        $stmt->bindValue(':von', $this->von, PDO::PARAM_INT);
        $stmt->bindValue(':an', $this->an, PDO::PARAM_INT);
        $stmt->bindValue(':text', $this->text, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
