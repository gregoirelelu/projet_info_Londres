





<?php
class database{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'londonproject_bdd';
    private $datab;

    public function __construct($host = null, $username = null, $password = null, $database = null){
        if ($host != null){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
        $this->datab = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
    }

    public function request($sql, $data = array()){
        $request = $this->datab->prepare($sql);
        $request->execute($data);
        return $request->fetchAll(PDO::FETCH_OBJ);
    }
}
