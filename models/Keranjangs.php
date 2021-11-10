<?php 
class Keranjangs{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilKeranjang($id){
        $query = "SELECT
        tpenjualanitem.id_penjualan,
         tpenjualanitem.id_penjualanitem,
        
        tbarang.kode_barang,
        tbarang.nama_barang,
        
        tpenjualanitem.harga_jual,
        tpenjualanitem.qty FROM tpenjualanitem INNER JOIN 
        tbarang ON
        tpenjualanitem.id_barang = tbarang.id_barang WHERE id_penjualan = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->resultSet();
    }
    public function masukinKeranjang($data)
    {   
        
        
        $query = "INSERT INTO tpenjualanitem
         VALUES (:idPen , :id , :idBarang  ,:hargaBeli, :hargaJual ,:diskon ,:qty, :tgl)";
         $this->db->query($query);
        $this->db->bind('idPen',$data['idPen']);
        $this->db->bind('id',$data['id']);
        $this->db->bind('idBarang',$data['idBarang']);
        $this->db->bind('hargaBeli',$data['hargaBeli']);
        
        $this->db->bind('hargaJual',$data['hargaJual']);
        $this->db->bind('diskon',$data['diskon']);
        $this->db->bind('qty',$data['qty']);
        $this->db->bind('tgl',$data['tanggal']);
        $this->db->execute();
        return $this->db->rowCount();
        
       
    }  
    public function pembayaran($data)
    {
        $query = "INSERT INTO tpenjualan VALUES
        ('','A1',:tgl,1,:diskon,3,1,:jumlah)";
        $this->db->query($query);
        $this->db->bind('tgl',$data['tanggal']);
        $this->db->bind('diskon',$data['diskon']);
        $this->db->bind('jumlah',$data['jumlahBayar']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function updateStock($data)
    {
       
    }
    public function barangHarian()
    {
        $hari_ini = date('y,m,d');
        $query = "SELECT COUNT(id_penjualan), SUM(qty) 
        FROM tpenjualanitem
        WHERE tanggal = :hari";
        $hari_ini = date('y,m,d');
        $this->db->query($query);
        $this->db->bind('hari',$hari_ini);
        return $this->db->single();
    }
    public function mingguan()
    {
        $hari_ini = date('y,m,d');
        $minggu_ini = date('y,m,d',strtotime('-6day'));
        $query = "SELECT COUNT(id_penjualan), SUM(qty) 
        FROM tpenjualanitem
        WHERE tanggal BETWEEN :minggu  AND :hari ";
        $hari_ini = date('y,m,d');
        $this->db->query($query);
        $this->db->bind('hari',$hari_ini);
        $this->db->bind('minggu',$minggu_ini);

        return $this->db->single();
    }
    public function bulanan()
    {
        $hari_ini = date('y,m,d');
        $bulan_ini = date('y,m,d',strtotime('-1month'));
        $query = "SELECT COUNT(id_penjualan), SUM(qty) 
        FROM tpenjualanitem
        WHERE tanggal BETWEEN :bulan  AND :hari ";
        $hari_ini = date('y,m,d');
        $this->db->query($query);
        $this->db->bind('hari',$hari_ini);
        $this->db->bind('bulan',$bulan_ini);

        return $this->db->single();
    }
}