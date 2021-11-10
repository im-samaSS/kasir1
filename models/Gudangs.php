<?php 
class Gudangs{
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilGudang($id){
        $query = "SELECT
        tpembelianitem.id_pembelian,
         tpembelianitem.id_pembelianitem,
        
        tbarang.kode_barang,
        tbarang.nama_barang,
        tpembelianitem.diskon,
        tpembelianitem.harga_beli,
        tpembelianitem.qty FROM tpembelianitem INNER JOIN 
        tbarang ON
        tpembelianitem.id_barang = tbarang.id_barang WHERE id_pembelian = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->resultSet();
    }
    public function masukinGudang($data)
    {   
        
        
        $query = "INSERT INTO tpembelianitem
         VALUES (:idPem , :idBarang  ,:hargaBeli ,:diskon ,:qty, :id,:tgl )";
         $this->db->query($query);
        $this->db->bind('idPem',$data['idPem']);
        $this->db->bind('id',$data['id']);
        $this->db->bind('idBarang',$data['idBarang']);
        $this->db->bind('hargaBeli',$data['hargaBeli']);
        
        $this->db->bind('tgl',$data['tanggal']);
        $this->db->bind('diskon',$data['diskon']);
        $this->db->bind('qty',$data['qty']);
        $this->db->execute();
        return $this->db->rowCount();
        
       
    }  
    public function pembayaran($data)
    {
        $query = "INSERT INTO tpembelian VALUES
        ('', 'B1' , :tgl , :idSup , :diskon , :bayar)";
        $this->db->query($query);
        $this->db->bind('tgl',$data['tanggal']);
        $this->db->bind('diskon',$data['diskon']);
        $this->db->bind('idSup',$data['idSup']);
        $this->db->bind('bayar',$data['jumlahBayar']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function Harian()
    {
       
        $query = "SELECT COUNT(id_pembelian), SUM(qty) 
        FROM tpembelianitem
        WHERE tanggal = :hari";
        $hari_ini = date('y,m,d');
        $this->db->query($query);
        $this->db->bind('hari',$hari_ini);
        return $this->db->single();
    }
    public function mingguan()
    {
        $minggu_ini = date('y,m,d',strtotime('-6day'));
        $query = "SELECT COUNT(id_pembelian), SUM(qty) 
        FROM tpembelianitem
        WHERE tanggal BETWEEN :minggu  AND :hari ";
        $hari_ini = date('y,m,d');
        $this->db->query($query);
        $this->db->bind('hari',$hari_ini);
        $this->db->bind('minggu',$minggu_ini);

        return $this->db->single();
    }
    public function bulanan()
    {
        $bulan_ini = date('y,m,d',strtotime('-1month'));
        $query = "SELECT COUNT(id_pembelian), SUM(qty) 
        FROM tpembelianitem
        WHERE tanggal BETWEEN :bulan  AND :hari ";
        $hari_ini = date('y,m,d');
        $this->db->query($query);
        $this->db->bind('hari',$hari_ini);
        $this->db->bind('bulan',$bulan_ini);

        return $this->db->single();
    }
}