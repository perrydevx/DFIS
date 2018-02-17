<?php

class Connection{

    // Setup Connection
    private $db;
    private $svr;
    private $server = "localhost";
    private $database = "dfis";
    private $userid = "root";
    private $password = ".";
    
    function __construct() {
        //$this->$server = $p_svr;
        //$this->$database = $p_db;
        //$this->$userid = $p_uid;
        //$this->$password = $p_pw;
    }

    function _destructor() {
        //$this->$server = $p_svr;
        mysql_close($this->db);
    }
    
    function connect(){

        // Connect to Server
/*
        echo $this->server."\n";
        echo $this->userid."\n";
        echo $this->password."\n";
        exit;
*/
        $this->srv = mysql_connect($this->server, $this->userid, $this->password);

        if (!$this->srv){
            echo ("Error: Cannot connect to the server. Please contact your administrator.");
            return 1;
            exit;
        }
        
        // Open Database
        $this->db = mysql_select_db ($this->database);

        if (!$this->db){
            echo ("Error: Cannot connect to the database. Please contact your administrator.");
            return 1;
            exit;
        }
        
        //echo "Checked in Connection";
        return 0;
    }
}

?>
