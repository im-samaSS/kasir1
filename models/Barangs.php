<?php 
class Barangs {
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilBarangId($id)
    {
        $query = "SELECT * FROM tbarang WHERE id_barang = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->single();
    }
    public function semuaBarang()
    {
        $query = "SELECT * FROM tbarang";
        $this->db->query($query);
        
        return $this->db->resultSet();
    }
    public function tampilBarang(){
        $query = "SELECT tbarang.id_barang,
        tbarang.kode_barang,
        tbarang.nama_barang,
        tmerk.nama_merk,
        tkategori.nama_kategori,
        tsatuan.nama_satuan,
        tbarang.harga_beli,
        tbarang.harga_jual 
        FROM tbarang JOIN tmerk 
        ON tbarang.id_merk = tmerk.id_merk 
        JOIN tsatuan 
        ON tbarang.id_satuan = tsatuan.id_satuan 
        JOIN tkategori 
        ON tbarang.id_kategori = tkategori.id_kategori 
        ORDER BY tbarang.id_barang";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function tambahBarang($data)
    {   
        $harga_beli = $_POST['hargaJual'];
        $harga_jual = $harga_beli + ($harga_beli*0.05);
        $singkatan = "GTW";
       $query = "INSERT INTO tbarang 
       VALUES ('' , :kodeBarang , :namaBarang ,:singkatan, :idMerk
        , :idKategori , :idSatuan ,:hargaBeli, :hargaJual,'','' )";
        $this->db->query($query);
        $this->db->bind('kodeBarang',$data['kodeBarang']);
        $this->db->bind('namaBarang',$data['namaBarang']);
        $this->db->bind('singkatan',$singkatan);
        $this->db->bind('idMerk',$data['merkBarang']);
        $this->db->bind('idKategori',$data['kategoriBarang']);
        $this->db->bind('idSatuan',$data['satuanBarang']);
        $this->db->bind('hargaBeli',$harga_beli);
        $this->db->bind('hargaJual',$harga_jual);
         $this->db->execute();
         
        return $this->db->rowCount();
        
    }
    
    
    public function cariBarang()
    {   
        $keyword = $_POST['keyword'];
        $query = "SELECT  tbarang.id_barang,
        tbarang.kode_barang,
        tbarang.nama_barang,
        tmerk.nama_merk,
        tkategori.nama_kategori,
        tsatuan.nama_satuan,
        tbarang.harga_jual 
        FROM tbarang JOIN tmerk 
        ON tbarang.id_merk = tmerk.id_merk 
        JOIN tsatuan 
        ON tbarang.id_satuan = tsatuan.id_satuan 
        JOIN tkategori 
        ON tbarang.id_kategori = tkategori.id_kategori 
        WHERE `nama_barang` LIKE :keyword
        OR `nama_merk` LIKE :keyword 
        ORDER BY tbarang.id_barang";
        $this->db->query($query);
        $this->db->bind('keyword',"%$keyword%");
        return $this->db->resultSet();
    }
    public function hapusBarang($id)
    {
        $query = "DELETE FROM tbarang WHERE `id_barang` = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function ubahBarang($data)
    {
        $harga_beli = $_POST['hargaJual'];
        $harga_jual = $harga_beli + ($harga_beli*0.05);
       $query = "UPDATE tbarang SET  
        kode_barang =:kodeBarang , 
        nama_barang = :namaBarang ,
         
        id_merk = :idMerk , 
        id_kategori =:idKategori , 
        id_satuan = :idSatuan , 
        harga_beli = :hargaBeli, 
        harga_jual = :hargaJual 
        WHERE `id_barang` = :id";
        $this->db->query($query);
        
        $this->db->bind('kodeBarang',$data['kodeBarang']);
        $this->db->bind('namaBarang',$data['namaBarang']);
        
        $this->db->bind('idMerk',$data['merkBarang']);
        $this->db->bind('idKategori',$data['kategoriBarang']);
        $this->db->bind('idSatuan',$data['satuanBarang']);
        $this->db->bind('hargaBeli',$harga_beli);
        $this->db->bind('hargaJual',$harga_jual);
        $this->db->bind('id',$data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}