<?php
class conn {
    private $dbconn;
 
    // koneksi ke database
    public function connect() {
        require_once 'conf.php';
         
        // connection to mysql db
        $this->dbconn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
         
        // return database handler
        return $this->dbconn;
    }
}
?>