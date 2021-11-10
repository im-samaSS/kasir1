<?php 
class Users {
    
    public function __construct(){
        $this->db = new Database();
    }

    public function login($data)
    {
        $query = "SELECT tuser.id_pegawai,tuser.username, tuser.password,tuser.hak,tpegawai.nomor_pegawai,
        tpegawai.nama_pegawai
         FROM tuser INNER JOIN tpegawai
         ON tuser.id_pegawai = tpegawai.id_pegawai
        WHERE `username` = :user AND `password` = :pass";
        $this->db->query($query);
        $this->db->bind('user',$data['username']);
        $this->db->bind('pass',$data['password']);
        // $this->db->execute();
        return $this->db->single();
    }
}