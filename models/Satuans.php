<?php 
class Satuans {
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilSatuan()
    {
        $query = "SELECT * FROM tsatuan";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}