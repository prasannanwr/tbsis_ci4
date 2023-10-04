<?php

namespace App\Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use App\Modules\User\Models\UserModel;

class Dashboard extends BaseController
{
    private $model;

    public function __construct()
    {
        $model = new UserModel();
        $this->model = $model;
    }
    
    public function index()
    {
        //curl

// $url = 'https://api.instagram.com/oauth/access_token';

// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $data = "client_id=1666579013764664&client_secret=586807332b77f1972470e036069d8d52&grant_type=authorization_code&redirect_uri=https://apsoft.com.np/&code=AQAJIn9er0ZXvQqeyvMhrEtumVrZc3BTYhxklZeWhOniS-daCFoTJ5Pbr5QWdIy-_Xl5kU-6uOR_ao9oLNmZ0PpksVu_OnUOaQlaiBRZq7nSZKeQJzYY2X2CAqahfGbcvQ6brPnrD6zH1GILQ2Cnpu7b6PfjbMVGZtn6UJTJ5cGcKjANfYiNiWDBmhv30SmWpemumdLySP5vkxdqlaa1mmqyLJIK4b4pjVnmbh99R9AnHA";

// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// $result = curl_exec($curl);
// echo "<pre>";
// var_dump($result);
// curl_close($curl);
// exit;
        // echo "<pre>";
        // var_dump(session()->get('user_id'));exit;
        $data['title'] = 'Dashboard';
        return view('\Modules\Dashboard\Views\Index', $data);
    }

}
    