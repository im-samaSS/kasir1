<?php 
class Pegawais{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function tampilPegawai()
    {
        $query ="SELECT * FROM tpegawai";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function getById($id)
    {
        $query ="SELECT * FROM tpegawai WHERE id_pegawai =  :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        return $this->db->single();
    }
    // public function tampilPegawai()
    // {
    //     $query ="SELECT tpegawais.nomor_pegawai,tpegawais.nama_pegawai,
    //     tpegawais.jabatan_pegawai,
    //     tpegawais.tempat_lahir,tpegawais.tanggal_lahir,
    //     tpegawai.gaji_pokok,tuser.hak,
    //     tpegawais.alamat_pegawai FROM tuser outer join tpegawai ";
    //     $this->db->query($query);
    //     return $this->db->resultSet();
    // }
}