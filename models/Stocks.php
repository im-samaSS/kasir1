<?php 
class Stocks{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilStock($id)
    {
        $query = "SELECT tbarang.id_barang,tbarang.nama_barang,tkategori.nama_kategori,
        tstock.stock 
        FROM tstock INNER JOIN tbarang ON tbarang.id_barang = tstock.id_barang 
        JOIN tkategori ON tkategori.id_kategori = tbarang.id_kategori 
        WHERE tbarang.id_kategori = :id ORDER BY tbarang.id_barang";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->resultSet();
    }
    public function tambahStock($data)
    {
        $query = "INSERT INTO tstock VALUES 
        (
            :idBar   , :qty
        )";
        $this->db->query($query);
        $this->db->bind('idBar',$data['idBarang']);
        $this->db->bind('qty',$data['qty']);
        $this->db->execute();
        
    }
}