<?php

class BarangController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Barang'
        ];
        $this->view('template/header', $data);
        $this->view('barang/index');
        $this->view('template/footer');
    }
    public function edit($id1 = 0, $id2 = "")
    {
        echo "edit barang " . $id1 . " " . $id2;
    }
}
