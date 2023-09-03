<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AttendanceModel;
use CodeIgniter\HTTP\Request;

class Attendance extends BaseController
{
    protected $AttendanceModel;
    public function __construct()
    {
        $this->AttendanceModel = new AttendanceModel();
    }
    // public function fn_rfidtag(Request $request)
    // {
    //     $idtag = $request->getPost('idtag');
    //     $this->AttendanceModel->fn_check($idtag);
    // }

    public function getidtag()
    {
        $idtag = $this->request->getGet('idtag');

        if (!empty($idtag)) {
            $this->AttendanceModel->fn_check($idtag);
            echo "IDTAG yang diterima: " . $idtag;
        } else {
            echo "IDTAG kosong atau tidak valid.";
        }
    }


}