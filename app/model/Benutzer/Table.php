<?php

class Benutzer_Table extends BaseApp {

    /**
     * @var int
     */
    public $bid = 0;
    /**
     * @var string
     */
    public $nick = '';
    /**
     * @var string
     */
    public $pass = '';
    /**
     * @var string
     */
    public $name = '';
    /**
     * @var string
     */
    public $mail = '';
    /**
     * @var string
     */
    public $guthaben = '';    
    /**
     * @var string
     */
    public $lastlogin = '';
    /**
     * @var string
     */
    public $ueber = '';
    /**
     * @var string
     */
    public $herkunft = '';
    /**
     * @var string
     */
    public $geschlecht = '';
    /**
     * @var string
     */
    public $geburtstag = '';
    /**
     * @var string
     */
    public $design = '';
    /**
     * @var string
     */
    public $lang = '';

    /**
     * Facebook user id
     * @var string
     */
    public $fbid = ''; 
    
    protected $db;

    /**
     * The constructer
     */
    public function __construct($bid = '') {
        if (!isset($this->db))
            $this->db = parent::getInstance();
        
        if (!empty($bid)) {
            $this->bid = $bid;
            $this->get();
        }
    }

    /**
     * Sanitize a input array
     *
     * @param array $data
     * @return array
     */
    public function check($data = '') {
        $check = array(
            'bid' => FILTER_SANITIZE_NUMBER_INT,
            'nick' => FILTER_SANITIZE_STRING,
            'pass' => FILTER_SANITIZE_STRING,
            'name' => FILTER_SANITIZE_STRING,            
            'mail' => FILTER_SANITIZE_STRING,
            'lastlogin' => FILTER_SANITIZE_STRING,
            'ueber' => FILTER_SANITIZE_STRING,
            'herkunft' => FILTER_SANITIZE_STRING,
            'geschlecht' => FILTER_SANITIZE_STRING,
            'geburtstag' => FILTER_SANITIZE_NUMBER_INT,
            'design' => FILTER_SANITIZE_STRING,
            'lang' => FILTER_SANITIZE_STRING,
            'fbid' => FILTER_SANITIZE_STRING
        );
        return filter_var_array($data, $check);
    }

    /**
     * Überprüfen ob der Nickname oder die eMail berreits vergeben ist
     * 
     * @param $nick
     * @param $email
     * 
     * @return true|fase
     */
    public function isBenutzer($nick, $email) {
        $data = $this->check(array("nick" => $nick, "mail" => $email));

        $sql = "SELECT B.bid, B.nick, B.pass, B.name, B.mail, B.lastlogin, B.ueber, B.herkunft, B.geschlecht, B.geburtstag, B.design, B.lang, B.fbid FROM Benutzer as B WHERE
        B.nick = '{$data['nick']}' or B.mail = '{$data['mail']}'";
        $stmt = $this->db->dbh->query($sql);
        
        if (!$stmt) return false;
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($result)
        {
            foreach ($result as $key => $val) {
                $this->$key = $val;
            }
            return true;
        }
        return false;
    }  
    
    /**
     * Überprüfen ob Username und Passwort existiert
     * 
     * @param $nick
     * @param $pass
     * 
     * @return true|fase
     */
    public function checkLogin($nick, $pass) {
        $data = $this->check(array("nick" => $nick, "pass" => $pass));
        
        $sql = "SELECT B.bid, B.nick, B.pass, B.name, B.mail, B.lastlogin, B.ueber, B.herkunft, B.geschlecht, B.geburtstag, B.design, B.lang, B.fbid FROM Benutzer as B WHERE
        B.nick = '".$data['nick']."' and B.pass = '".$data['pass']."'";
        
        $stmt = $this->db->dbh->query($sql);
        if (!$stmt) return false;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($result)
        {
            foreach ($result as $key => $val) {
                $this->$key = $val;
            }
            return true;
        }
        return false;
    }  
    
    /**
     * Delete a element in the Database
     */
    public function del() {
        if (empty($this->bid) || !is_numeric($this->bid))
            return false;

        $sql = "DELETE FROM Benutzer WHERE bid = :bid";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->bindValue(':bid', $this->bid, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Get a list of objects
     *
     * @param array $data optional if you like to get only a subset of data
     *
     * @return obj
     */
    public function get_list($data = '') {
        $sql = "SELECT B.bid, B.nick, B.guthaben, B.pass, B.name, B.mail, B.lastlogin, B.ueber, B.herkunft, B.geschlecht, B.geburtstag, B.design, B.lang, B.fbid FROM Benutzer as B";
        if (is_array($data)) {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value) {
                if ($value)
                    $sql .= " B.$key = '$value' and";
            }
            $sql = substr($sql, 0, -4);
        }
        
        $stmt = $this->db->dbh->query($sql);
        if (!$stmt) return false;
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Benutzer_Table');
        return $obj;
    }

    /**
     * Get a list of objects
     *
     * @param array $data optional if you like to get only a subset of data
     *
     * @return obj
     */
    public function getLike($data = '') {
        $sql = "SELECT B.bid, B.nick, B.guthaben, B.pass, B.name, B.mail, B.lastlogin, B.ueber, B.herkunft, B.geschlecht, B.geburtstag, B.design, B.lang, B.fbid FROM Benutzer as B";
        if (is_array($data)) {
            $data = $this->check($data);
            $sql .= " WHERE";
            foreach ($data as $key => $value) {
                if ($value)
                    $sql .= " B.$key like '%$value%' and";
            }
            $sql = substr($sql, 0, -4);
        }
        
        $stmt = $this->db->dbh->query($sql);
        if (!$stmt) return false;
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Benutzer_Table');
        return $obj;
    }
    
    /**
     * Get one Dataset from the db
     */
    public function get() {
        if (empty($this->bid) || !is_numeric($this->bid))
            return false;

        $sql = "SELECT B.bid, B.nick, B.pass, B.name, B.mail, B.lastlogin, B.ueber, B.guthaben, B.herkunft, B.geschlecht, B.geburtstag, B.design, B.lang, B.fbid FROM Benutzer as B WHERE
        B.bid = $this->bid";
        
        $stmt = $this->db->dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $val) {
            $this->$key = $val;
        }
    }

    /**
     * Get one Dataset by fb user id from the db
     */
    public function getByFBID() {
        if (empty($this->fbid) || !is_numeric($this->fbid))
            return false;

        $sql = "SELECT B.bid, B.nick, B.pass, B.name, B.mail, B.lastlogin, B.ueber, B.guthaben, B.herkunft, B.geschlecht, B.geburtstag, B.design, B.lang, B.fbid FROM Benutzer as B WHERE
        B.fbid = $this->fbid";
        
        $stmt = $this->db->dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $val) {
            $this->$key = $val;
        }
    }
    
    /**
     * Get active users
     */
    public function getActive() {


        $sql = "select bid, nick, pass, name, mail, lastlogin, ueber, guthaben, herkunft, geschlecht, geburtstag, design, lang, fbid from Benutzer where DATE_SUB(now() , INTERVAL 5 MINUTE ) < lastlogin";
        
        $stmt = $this->db->dbh->query($sql);        
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Benutzer_Table');
        return $obj;
    }
    
    /**
     * Get highscore
     */
    public function getHighscore($pointer = false, $zeige = false) {
        if(!$pointer && !$zeige)
        {
            $sql = "SELECT count(bid) AS Benutzer FROM Benutzer WHERE DATE_SUB(now() , INTERVAL 30 DAY ) < lastlogin";
            $stmt = $this->db->dbh->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $key=>$val)
            {
                $this->$key=$val;
            }
            return true;
        }

        $sql = "SELECT bid, nick, pass, name, mail, lastlogin, ueber, guthaben, herkunft, geschlecht, geburtstag, design, lang, fbid FROM Benutzer WHERE DATE_SUB(now() , INTERVAL 30 DAY ) < lastlogin ORDER BY guthaben DESC limit $pointer, $zeige";
        
        $stmt = $this->db->dbh->query($sql);        
        $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Benutzer_Table');
        return $obj;
    }
    
    /**
     * The save method is responsability for
     * saving and updating a dataset
     */
    public function save() {
        if (empty($this->bid)) {
            $sql = 'INSERT INTO Benutzer 
            (bid, nick, pass, name, mail, lastlogin, ueber, guthaben, herkunft, geschlecht, geburtstag, design, lang, fbid) VALUES
            (:bid, :nick, :pass, :name, :mail, :lastlogin, :ueber, :guthaben, :herkunft, :geschlecht, :geburtstag, :design, :lang, :fbid)';
            $stmt = $this->db->dbh->prepare($sql);
            
        } else {
            
            $sql = 'UPDATE Benutzer set
                         nick = :nick, 
                         pass = :pass,
                         name = :name,
                         mail = :mail, 
                         lastlogin = :lastlogin, 
                         ueber = :ueber,
                         guthaben = :guthaben,
                         herkunft = :herkunft,
                         geschlecht = :geschlecht,
                         geburtstag = :geburtstag,
                         design = :design,
                         lang = :lang,
                         fbid = :fbid';
            $sql .= " WHERE bid = :bid";
            $stmt = $this->db->dbh->prepare($sql);
            
        }
        
        $stmt->bindValue(':bid', $this->bid, PDO::PARAM_INT);
        $stmt->bindValue(':nick', $this->nick, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $stmt->bindValue(':lastlogin', $this->lastlogin, PDO::PARAM_STR);
        $stmt->bindValue(':guthaben', $this->guthaben, PDO::PARAM_STR);
        $stmt->bindValue(':ueber', $this->ueber, PDO::PARAM_STR);
        $stmt->bindValue(':herkunft', $this->herkunft, PDO::PARAM_STR);
        $stmt->bindValue(':geschlecht', $this->geschlecht, PDO::PARAM_STR);
        $stmt->bindValue(':geburtstag', $this->geburtstag, PDO::PARAM_STR);
        $stmt->bindValue(':design', $this->design, PDO::PARAM_STR);
        $stmt->bindValue(':lang', $this->lang, PDO::PARAM_STR);
        $stmt->bindValue(':fbid', $this->fbid, PDO::PARAM_STR);        
        
        $stmt->execute();
        if (empty($this->bid)) {
         $this->bid = $this->db->dbh->lastInsertId();
        }
        
    }

}

?>