<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }
    public function index()
    {
        return redirect()->to(base_url('/auth'));
    }

    public function fn_login()
    {
        echo view("auth/login");
    }

    public function fn_validation()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $token = $this->generateRandomToken();
        $this->authModel->fn_checklogin($username, $password, $token);
        $session = session();
        if($session->has('telegramid')){
            $telegramid = session('telegramid');
            $this->sendTokenToTelegram($telegramid, $token);
        }else {
            echo "error|Auth not Registered<br>Please Contact Admin !";
        }
    }

    protected function sendTokenToTelegram($telegram_id, $token)
    {
        $tokentelegram = "6469932289:AAGdCy57eBc3WPJfEt3A9ehXDEX5TJv6sw4";
        $telegram = shell_exec("curl -X POST 'https://api.telegram.org/bot$tokentelegram/sendMessage' -d 'chat_id=$telegram_id&text=Your Auth Token\n\n$token'");
        return $telegram;
    }

    public function fn_token()
    {
        $telegramid = session("telegramid");
        if ($telegramid != "") {
            $data = [
                'title' => "Token",
            ];
            echo view('auth/token', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function fn_verifytoken()
    {
        $access_token = $this->request->getPost('token');
        $id = session('id');
        $telegramid = session('telegramid');
        $this->authModel->fn_checktoken($access_token, $id, $telegramid);
    }

    public function fn_logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    
}
