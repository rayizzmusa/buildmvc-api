<?php

class KategoriController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        $this->view('template/header', $data);
        $this->view('kategori/index');
        $this->view('template/footer');
    }
}
