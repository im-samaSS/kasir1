<?php 
class Kategoris {
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilKategori()
    {
        $query = "SELECT * FROM tkategori";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}