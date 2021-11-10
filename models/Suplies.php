<?php 
class Suplies{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilSuply()
    {
        $query = "SELECT * FROM tsupplier";
        $this->db->query($query);
         return $this->db->resultSet();
    }
    public function tampilSuplyId($id)
    {
        $query = "SELECT * FROM tsupplier WHERE id_supplier = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->single();
    }
    public function cariSuply()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM tsupplier WHERE nama_supplier LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword',"%$keyword%");
        return $this->db->resultSet();
    }
    public function ubahSuply($data)
    {   
    
       $query = "UPDATE tsupplier SET
                    kode_supplier = :kodeSuply ,
                    nama_supplier = :namaSuply , 
                    alamat_supplier = :alamatSuply WHERE id_supplier = :id";
        $this->db->query($query);
        $this->db->bind('kodeSuply',$data['kodeSuply']);
        $this->db->bind('namaSuply',"PT.".$data['namaSuply']);
        $this->db->bind('alamatSuply',$data['alamatSuply']);
        $this->db->bind('id',$data['id']);
        
        $this->db->execute();
        return $this->db->rowCount();
        
    }
    public function tambahSuply($data)
    {   
    
       $query = "INSERT INTO tsupplier
       VALUES ('' , :kodeSuply , :namaSuply , :alamatSuply , '' , '' )";
        $this->db->query($query);
        $this->db->bind('kodeSuply',$data['kodeSuply']);
        $this->db->bind('namaSuply',"PT.".$data['namaSuply']);
        $this->db->bind('alamatSuply',$data['alamatSuply']);
        
        $this->db->execute();
        return $this->db->rowCount();
        
    }
    public function hapusSuply($id)
    {
        $query = "DELETE FROM tsupplier WHERE `id_supplier` = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}