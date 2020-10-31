<?php


class DB
{
    private $host = 'gasbank.creativityprojectcenter.ru';
    private $login = 'gasbank';
    private $password = '33jzivp15d8m8ksVdvjU';
    private $database = 'gasbank';
    private $db;

    protected static $_instance;

    public function __construct(){
        try {
            $this->db = new mysqli($this->host, $this->login, $this->password, $this->database);
            $this->db->set_charset("utf8");
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function query($sql){
        $this->db->query($sql) or die("Ошибка " . $this->db->error);

    }

    public function getOneData($sql){
        $result = $this->db->query($sql) or die("Ошибка " . $this->db->error);
        return $result->fetch_assoc();
    }

    public function getAllData($sql){
        $result = $this->db->query($sql) or die("Ошибка " . $this->db->error);
        $array = [];
        while($row = $result->fetch_assoc())
            array_push($array,$row);
        return $array;
    }

    public function getLastInserted(){
        $sql="SELECT LAST_INSERT_ID() id";
        return $this->getOneData($sql)['id'];
    }

}