<?php 
class Belis {
    private $db;
    priVate $idPen = 2;
    private $ai = 15;
   
    public function __construct(){
        $this->db = new Database();
    }
    
    public function tampilBeli($id)
    {
        $query = "SELECT * FROM tbarang WHERE id_barang = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->single();
    }
    
    public function check($id)
    {
        $query = "SELECT id_penjualanitem FROM tpenjualanitem WHERE id_penjualanitem = $id";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function lihatKeranjang($data)
    {
        $query = "SELECT * FROM tbarang WHERE id_barang = :id";
        $this->db->query($query);
        $this->db->bind('id',$data['id']);
        return 0;
    }
    public function masukinKeranjang($data)
    {   
        
        $hargaBeli = 90;
        $idJualItem = $this->idPen.'0'.$data['kodeBarang1'];
        
        $tBeli = date('y,m,d');
        $query = "INSERT INTO tpenjualanitem
         VALUES (:idPen , :id , :idBarang , '' , :hargaBeli , :hargaJual ,:diskon ,:qty)";
         $this->db->query($query);
        $this->db->bind('idPen',$this->idPen);
        $this->db->bind('id',$idJualItem);
        $this->db->bind('idBarang',$data['id_barang']);
        
        $this->db->bind('hargaBeli',$idJualItem);
        $this->db->bind('hargaJual',$data['hargaJual']);
        $this->db->bind('diskon',$data['diskon']);
        $this->db->bind('qty',$data['qty']);
        $this->db->execute();
        
        return $this->db->rowCount();
       
        
         
        //untuk id penjualan harus pake session jadi tiap kali bayar, id nya nambah
        ///untuk id penjualanitem,tipe nya char, tpi tiap kali masuk kernajang harus ikut nambah.
        //
    }
    public function masukPenjualan($data)
    {   
        $idPen = "3";
        $diskon = 0;
        $kassa = 3;

        $query = "INSERT INTO tpenjualan VALUES
        (:idPen , '',:tanggal ,1,:diskon,:kassa,1, :jumlahBayar)";
        $this->db->query($query);
        $this->db->bind('idPen',$idPen);
        $this->db->bind('tanggal',$data['tanggal']);
        $this->db->bind('diskon',$diskon);
        $this->db->bind('kassa',$kassa);
        $this->db->bind('jumlahBayar',$data['jumlahBayar']);
        $this->db->execute();
    }
}