<?php

namespace App\Models;

use CodeIgniter\Model;
class AttendanceModel extends Model
{
    protected $table = 'tbl_msa_absensi';
    protected $primaryKey = 'id';
    protected $db;

    public function fn_check($idtag)
    {
        return $this->db->query("INSERT INTO tbl_msa_absensi SET idtag = '$idtag'");
    }

    // public function fn_check($idtag)
    // {
    //     // Membuat data yang akan disisipkan
    //     $data = [
    //         'idtag' => $idtag
    //     ];

    //     // Memasukkan data ke dalam tabel
    //     return $this->insert($data);
    // }

}