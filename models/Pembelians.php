<?php 
class Pembelians{
    public function __construct(){
        $this->db = new Database();
    }
    public function cekIdPembelian()
    {
        $query = "SELECT max(id_pembelian) FROM tpembelian";
        $this->db->query($query);
        return $this->db->single();
    }
    public function pembelianHarian()
    {
        $hari_ini = date('y,m,d');
       
        $query = "SELECT SUM(bayar_barang)
        FROM `tpembelian` 
         WHERE `tanggal` = :hari";
         $this->db->query($query);
         $this->db->bind('hari',$hari_ini);
         return $this->db->single();
    }
    public function mingguan()
    {
        $hari_ini = date('y,m,d');
        $minggu_ini = date('y,m,d',strtotime('-6day'));
       
        $query = "SELECT SUM(bayar_barang)
        FROM `tpembelian` 
         WHERE `tanggal` BETWEEN :minggu  AND :hari ";
         $this->db->query($query);
         $this->db->bind('hari',$hari_ini);
         $this->db->bind('minggu',$minggu_ini);
         return $this->db->single();
    }
    public function bulanan()
    {
        $hari_ini = date('y,m,d');
        $bulan_ini = date('y,m,d',strtotime('-1month'));
       
        $query = "SELECT SUM(bayar_barang)
        FROM `tpembelian` 
         WHERE `tanggal` BETWEEN :bulan  AND :hari ";
         $this->db->query($query);
         $this->db->bind('hari',$hari_ini);
         $this->db->bind('bulan',$bulan_ini);
         return $this->db->single();
    }
}