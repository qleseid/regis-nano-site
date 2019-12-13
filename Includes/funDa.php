<!--
 * FUN Copyright (C) 2019 Lucas Olson. All rights reserved.
 * This software was developed for a class
 * at Regis University. Regis has informed us
 * as students that they retain the rights to our
 * work. Regis University must explicitly authorize 
 * the use of any part of this software outside of their
 * academia. 
 */
-->
<?php //funDa.php
class UserDB extends mysqli 
{
    // single instance of self shared among all instances
    private static $instance = null;

    // db connection config vars
    private $user = "regis";
    private $pass = "userword";
    private $dbName = "nanousers";
    private $dbHost = "localhost";
    
    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() 
    {
        if (!self::$instance instanceof self) 
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // private constructor
    private function __construct() 
    {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) 
        {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // CLONE.
    public function __clone() 
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    //WAKEUP
    public function __wakeup() 
    {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }
    
    //GET USER ID BY NAME
    public function get_user_id_by_name($name) 
    {
        $nam = $this->real_escape_string($name);

        $user = $this->query("SELECT id FROM users WHERE name = '"
                . $nam . "'");
        if ($user->num_rows > 0) 
        {
            $row = $user->fetch_row();
            return $row[0];
        } 
        else
        {
            return null;
        }
    }
    
    //CHECK FOR USER NAME
    public function check_for_user($name) 
    {
        $nam = $this->real_escape_string($name);

        $user = $this->query("SELECT id FROM users WHERE name = '"
                . $nam . "'");
        if ($user->num_rows > 0) 
        {
            return false;
        } 
        else
        {
            return true;
        }
    }
    
    //*******TODO**********GET USER BY USER ID
    public function get_user_by_user_id($userID) 
    {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE user_id=" . $userID);
    }

    //CREATE USER
    public function create_user ($name, $password, $email)
    {
        $nam = $this->real_escape_string($name);
        $pword = $this->real_escape_string($password);
        $eml = $this->real_escape_string($email);
        $result = $this->query("INSERT INTO users (name, email, password) VALUES "
                . "('" . $nam . "', '" . $eml . "','" . $pword . "')");
        return $result;
    }

    //VERIFY USER
    public function verify_user_credentials($name, $password) 
    {
        $nam = $this->real_escape_string($name);
        $pword = $this->real_escape_string($password);

        $result = $this->query("SELECT password FROM users
 	           WHERE name = '" . $nam . "'")->fetch_array(MYSQLI_NUM);
        //$_SESSION['debug'] .= " Result: " . $result[0];
        
        return (password_verify($pword, $result[0]));
    }

    //*******TODO**********INSERT WISH
    function insert_wish($userID, $description, $duedate) 
    {
        $descript = $this->real_escape_string($description);
        $wID = $this->real_escape_string($userID);
        $dDate = $this->real_escape_string($duedate);
        
        if ($this->format_date_for_sql($dDate) == null) {
            $this->query("INSERT INTO wishes (user_id, description)" .
                    " VALUES (" . $wID . ", '" . $descript . "')");
        } 
        else 
        {
            $this->query("INSERT INTO wishes (user_id, description, due_date)" .
                    " VALUES (" . $wID . ", '" . $descript . "', "
                    . $this->format_date_for_sql($dDate) . ")");
        }
    }

    //*******TODO**********DATE FORMAT
    function format_date_for_sql($date) 
    {
        if ($date == "")
        {
            return null;
        }
        else
        {
            $dateParts = date_parse($date);
            return $dateParts["year"] * 10000 + $dateParts["month"] * 100 + $dateParts["day"];
        }
    }

    //*******TODO**********UPDATE ITEM
    public function update_wish($wishID, $description, $duedate)
    {
        $descript = $this->real_escape_string($description);
        $dDate = $this->real_escape_string($duedate);
        $wID = $wishID;
        
        if ($dDate == '') 
        {
            $this->query("UPDATE wishes SET description = '" . $descript . "',
             due_date = NULL WHERE id = " . $wID);
        } 
        else 
        {
            $this->query("UPDATE wishes SET description = '" . $descript .
                    "', due_date = '" . $this->format_date_for_sql($duedate)
                    . "' WHERE id = " . $wID);
        }
    }

    //*******TODO**********GET WISH BY ID
    public function get_wish_by_wish_id($wishID) 
    {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE id = " . $wishID);
    }

    //*******TODO**********DELET WISH
    function delete_wish($wishID) 
    {
        $this->query("DELETE FROM wishes WHERE id = " . $wishID);
    }

}
?>