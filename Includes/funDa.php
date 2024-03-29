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

function navHeader($page)
{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST")
    {
        switch (filter_input(INPUT_POST, 'cmd'))
        {
            case 'new':
                popSess('new', $page);
                header('Location: new.php');
                exit;
            case 'delete':
                popSess('delete', $page);
                header('Location: delete.php');
                exit;
            case 'update':
                popSess('update', $page);
                header('Location: update.php');
                exit;
            case 'account':
                popSess('account', $page);
                header('Location: account.php');
                exit; 
            case 'logout':
                session_unset();
                setcookie('','',1);
                session_destroy();
                header('Location: login.php');
                exit;
            default :
                header('Location: locations.php');
                exit;
        }
    }
    else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET")
    {    
        if(filter_input(INPUT_GET, 'cmd') == 'selectedImage')
        {
            $_SESSION['cmd'] = '';
            $_SESSION['page'] = $page;
            $_SESSION['file'] = filter_input(INPUT_GET, 'file');
            $_SESSION['owner'] = filter_input(INPUT_GET, 'id');
            $_SESSION[$page] = filter_input(INPUT_GET, 'id');
            header('Location: '.$_SESSION['next']);
            exit;
        }
        else if($_SESSION['page'] != $page)
        {
            //UserDB::getInstance()->get_owner_of_id($_SESSION['owner'], $page);
            //$_SESSION['page']   = $page;
        }
           
    }
        
}

function popSess($cmd, $page)
{
    $_SESSION['cmd']   = $cmd;
    $_SESSION['page']   = $page;
    $_SESSION['id']    = filter_input(INPUT_POST, 'id');
    $_SESSION['owner']    = filter_input(INPUT_POST, 'owner');
    $_SESSION['file']    = filter_input(INPUT_POST, 'file');
    $_SESSION['titleArea'] = filter_input(INPUT_POST, 'titleArea');
    $_SESSION['textArea']  = filter_input(INPUT_POST, 'textArea');
}

function navBuild($currPage)
{
    if($currPage !== 'locations.php')
    {
        echo ("<li onclick=\"javascript:post('$currPage', 'home')\">Home</li>");
    }
echo <<<_END
    <li onclick="javascript:post('$currPage', 'account')">Account</li>
    <li onclick="javascript:post('$currPage', 'new')">New</li>
    <li onclick="javascript:post('$currPage', 'update')">Update</li>
    <li onclick="javascript:post('$currPage', 'delete')">Delete</li>
    <li onclick="javascript:post('$currPage', 'logout')">Logout</li>
_END;

}

//Encodes image for movement between server and client
function base64_encode_image($file) 
{
    $filetype = filetype(basename($file));
    if ($file) 
    {
        return 'data:image/' 
                . $filetype 
                . ';base64,' 
                . base64_encode(fread(fopen($file, "r"), filesize($file)));
    }
}

//USERDB CLASS
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
    
    //GET USER INFO BY NAME
    public function get_user_info_by_name($name) 
    {
        return $this->query("SELECT id, email FROM users WHERE name = '". $name ."'")
                ->fetch_array(MYSQLI_NUM);
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

    //UPDATE USER
    public function update_user($id, $email)
    {
        $uid = $this->real_escape_string($id);
        $eml = $this->real_escape_string($email);
        return $this->query("UPDATE users SET email = '"
                . $eml . "' WHERE id = '". $uid . "'");        
    }
    
    //VERIFY USER
    public function verify_user_credentials($name, $password) 
    {
        $nam = $this->real_escape_string($name);
        $pword = $this->real_escape_string($password);

        $result = $this->query("SELECT password, id FROM users
 	           WHERE name = '" . $nam . "'")->fetch_array(MYSQLI_NUM);
        $_SESSION['userId'] = $result[1];
        //$_SESSION['cmd'] = 'login';
        
        return (password_verify($pword, $result[0]));
    }

    //CREATE ITEM
    public function create_item($page, $pageId, $titleArea, $textArea)
    {
        //echo"IN CREATE ITEM</br>";
        $tiA = $this->real_escape_string($titleArea);
        $teA = $this->real_escape_string($textArea);
        $result = false;
        //echo"IN CREATE, ABOUT TO CHECK IF IT HAS A FILE</br>";
        if (count($_FILES) > 0)
        {
            //echo"IS A FILE</br>";
            if (is_uploaded_file($_FILES['item']['tmp_name']))
            {
                //echo"THE FILE IS UPLOADED</br>";
                $targetDir = "/home/gangsta/Pictures/uploads/";
                //$targetDir = "/media/gangsta/CEA43582A4356E59/Folder/uploads/";
                $fileName = basename($_FILES["item"]["name"]);
                $targetFilePath = $targetDir . date(DATE_ATOM,mktime()) . $fileName ;                        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowTypes = array('jpg','png','jpeg','gif','pdf', 'webp',
                    'JPG','PNG','JPEG','GIF','PDF', 'WEBP');
                //echo"BEFORE TYPE CHECK:</br>" . $targetFilePath . "</BR>";
                if(in_array($fileType, $allowTypes))
                {
                    //echo"CORRECT FILE TYPE</br>";
                    if(move_uploaded_file($_FILES["item"]["tmp_name"], $targetFilePath))
                    {
                        //echo"BEFORE QUERY</br>";
                        /*echo"INSERT INTO ".$page." VALUES "
                            . "(NULL, '" . $pageId . "', '" . $tiA . "', '" 
                            . $targetFilePath . "','" . $teA . "')";*/
                        $result = $this->query("INSERT INTO ".$page." VALUES "
                            . "(NULL, '" . $pageId . "', '" . $tiA . "', '" 
                            . $targetFilePath . "','" . $teA . "')");
                        //echo"MOVE IMAGE SUCCESS</br>" . $result;
                    }
                }                    
            }                
        }            
        echo "ERROR: ". $_FILES['item']['error'];        
        return $result;        
    }

    //UPDATE ITEM
    public function update_item($page, $pageId, $titleArea, $textArea)
    {
        echo"IN CREATE ITEM</br>";
        $tiA = $this->real_escape_string($titleArea);
        $teA = $this->real_escape_string($textArea);
        $result = false;
        
        if (count($_FILES) > 0)
        {
            echo"IS A FILE</br>";
            if (is_uploaded_file($_FILES['item']['tmp_name']))
            {
                echo"THE FILE IS UPLOADED</br>";
                $targetDir = "/home/gangsta/Pictures/uploads/";
                //$targetDir = "/media/gangsta/CEA43582A4356E59/Folder/uploads/";
                $fileName = basename($_FILES["item"]["name"]);
                $targetFilePath = $targetDir . date(DATE_ATOM,mktime()) . $fileName ;                        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowTypes = array('jpg','png','jpeg','gif','pdf', 'webp',
                    'JPG','PNG','JPEG','GIF','PDF', 'WEBP');
                echo"BEFORE TYPE CHECK:</br>" . $targetFilePath . "</BR>";
                if(in_array($fileType, $allowTypes))
                {
                    echo"CORRECT FILE TYPE</br>";
                    if(move_uploaded_file($_FILES["item"]["tmp_name"], $targetFilePath))
                    {
                        echo"BEFORE QUERY</br>";
                        echo"UPDATE ".$page." SET title = '".$tiA.
                        "', description = '".$teA."', filePath = '".$targetFilePath.
                                "' WHERE id = '".$pageId."'";
                        $result = $this->query("UPDATE ".$page." SET title = '".$tiA.
                        "', description = '".$teA."', filePath = '".$targetFilePath.
                                "' WHERE id = '".$pageId."'");
                        unlink($_SESSION['file']);
                        echo"MOVE IMAGE SUCCESS</br>" . $result;
                    }
                }                    
            }
            else
            {
                echo "UPDATE " . $page . " SET title = '" . $tiA .
                "', description = '" . $teA . "' WHERE id = '" . $pageId . "'";
                $result = $this->query("UPDATE " . $page . " SET title = '" . $tiA .
                        "', description = '" . $teA . "' WHERE id = '" . $pageId . "'");
            }
        }
        echo "ERROR: ". $_FILES['item']['error'];        
        return $result;        
    }

    //DELETE ITEM
    public function delete_item($page)
    {
        //Delete the server stored file
        unlink($_SESSION['file']);
        return $this->query("DELETE FROM ".$page." WHERE id=".$this->real_escape_string($_SESSION['id']));
    }

    //GET ITEMS BY OWNER
    public function get_items_by_owner($ownerID, $page) 
    {
        $oid = $this->real_escape_string($ownerID);
        $pg = $this->real_escape_string($page);
        return $this->query("SELECT * FROM ".$pg." WHERE owner_id = " . $oid);
    }

    //GET OWNER OF ID
    public function get_owner_of_id($id, $page) 
    {
        $oid = $this->real_escape_string($id);
        $pg = $this->real_escape_string($page);
        $result = $this->query("SELECT owner_id FROM ".$pg." WHERE id = " . $oid)
                ->fetch_array(MYSQLI_NUM);
        $_SESSION['owner'] = $result[0];
    }      
}
?>