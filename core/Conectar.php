<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset;
    private $con;
  
    public function __construct() {
        // $db_cfg = require_once 'config/database.php';
        // $this->driver=$db_cfg["driver"];
        // $this->host=$db_cfg["host"];
        // $this->user=$db_cfg["user"];
        // $this->pass=$db_cfg["pass"];
        // $this->database=$db_cfg["database"];
        // $this->charset=$db_cfg["charset"];
        // 
        $this->driver='mysql';
        $this->host='localhost';
        $this->user='root';
        $this->pass='';
        $this->database='ssegui';
        $this->charset='utf8';
        
//        $this->driver='mysql';
//        $this->host='mysql.hostinazo.com';
//        $this->user='u321943716_wil';
//        $this->pass='wil12345$';
//        $this->database='u321943716_sseg';
//        $this->charset='utf8';        
    }
    
    public function conexion(){
        if($this->driver=="mysql" || $this->driver==null){
            $this->con = new mysqli($this->host, $this->user, $this->pass, $this->database);
            $this->con->query("SET NAMES '".$this->charset."'");
        }

        if ($this->con->connect_errno) {
            printf("<br><br>Falla de conexion: <br>%s\n", $this->con->connect_error);
            exit();
        }
        
        return $this->con;
    }
    
    public function close(){
        $this->close();
    }

    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="mysql" || $this->driver==null){
            $pdo = new PDO($this->driver.":dbname=".$this->database, $this->user, $this->pass);
            $fpdo = new FluentPDO($pdo);
        }
        
        return $fpdo;
    }
}
?>
