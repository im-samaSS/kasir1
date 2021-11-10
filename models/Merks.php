<?php 
class Merks {
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilMerk()
    {
        $query = "SELECT * FROM tmerk";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function satuMerk($id)
    {
        $query = "SELECT * FROM tmerk WHERE id_merk = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->single();
    }
}