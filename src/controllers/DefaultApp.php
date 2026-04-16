<?php

use MyApp\Core\BaseController;

class DefaultApp extends BaseController
{
    public function index()
    {
        $data = [
            'status' => '404',
            'error' => '404 Not Found',
            'message' => 'Halaman tidak ditemukan',
            'data' => null
        ];

        $this->view('template/header', $data);
        header('HTTP/1.0 404 Not Found');
        echo json_encode($data);
    }
}
