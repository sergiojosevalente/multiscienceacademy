<?php

namespace App\Models;

use CodeIgniter\Model;
class AuthModel extends Model
{
    protected $table = 'tbl_msa_user';
    protected $primaryKey = 'id';
    protected $db;

    public function fn_checklogin($username, $password, $token)
    {
        $this->db->query("SELECT * FROM tbl_msa_user");
        $user = $this->where('username', $username)->first();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $this->fn_saveToken($username, $token);
                    $sessionData = [
                        'id' => $user['id'],
                        'telegramid' => $user['telegramid'],
                    ];
                    $session = session();
                    $session->set($sessionData);
                    echo 'success|Req Token success';
                } else {
                    echo 'error|Password does not match.';
                }
            } else {
                echo 'error|User is not activated.';
            }
        } else {
            echo 'error|User does not exist.';
        }
    }

    private function fn_saveToken($username, $token)
    {
        return $this->db->query("UPDATE tbl_msa_user SET access_token='$token',lastreq=NOW() WHERE username='$username'");
    }

    public function fn_checktoken($access_token, $id, $telegramid)
    {
        $this->db->query("SELECT * FROM tbl_msa_user");
        $user = $this->where('id', $id)->first();

        if ($access_token == $user['access_token']) {
            $sessionData = [
                'id' => $user['id'],
                'username' => $user['username'],
                'fullname' => $user['fullname'],
                'telegramid' => $user['telegramid'],
                'is_active' => $user['is_active'],
            ];
            $session = session();
            $session->set($sessionData);
            echo 'success|Login success';
        } else {
            echo 'error|Token does not match.';
        }
    }
}