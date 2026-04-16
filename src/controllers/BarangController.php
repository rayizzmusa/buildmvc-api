<?php

use MyApp\Core\BaseController;
use MyApp\Core\Messages;

class BarangController extends BaseController
{
    private $barangModel;

    public function __construct()
    {
        $this->barangModel = $this->model('Barang_model');
    }


    public function index($id = null)
    {
        if ($id == null) {
            try {
                $data = $this->barangModel->getAll();
            } catch (\Exception $e) {
                $data = [
                    'status' => '500',
                    'error' => '500 Internal Server Error',
                    'message' => 'Internal Server Error',
                    'data' => null
                ];

                $this->view('template/header');
                header('HTTP/1.0 500 Internal Error');
                echo json_encode($data);
                exit();
            }
        } else {
            try {
                $data = $this->barangModel->getById($id);
            } catch (\Exception $e) {
                $data = [
                    'status' => '500',
                    'error' => '500 Internal Server Error',
                    'message' => 'Internal Server Error',
                    'data' => null
                ];

                $this->view('template/header');
                header('HTTP/1.0 500 Internal Error');
                echo json_encode($data);
                exit();
            }
        }

        if ($data) {
            $data = [
                'status' => '200',
                'error' => null,
                'message' => 'Data ditemukan',
                'data' => $data
            ];

            $this->view('template/header');
            header('HTTP/1.0 200 OK');
            echo json_encode($data);
        } else {
            $data = [
                'status' => '404',
                'error' => '404 Not Found',
                'message' => 'Data tidak ditemukan',
                'data' => null,
            ];

            $this->view('template/header');
            header('HTTP/1.0 404 Not Found');
            echo json_encode($data);
        }
    }

    public function insert()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $fields = [
            'nama_barang' => 'string | required',
            'jumlah' => 'int | required',
            'harga_satuan' => 'float | required',
            'kadaluarsa' => 'string',
        ];

        $message = [
            'nama_barang' => [
                'required' => 'Nama Barang Harus diisi',
                'alphanumeric' => 'Masukan huruf dan angka',
                'between' => 'Nama Barang harus diantara 3 dan 25 karakter'
            ],

            'jumlah' => [
                'required' => 'Jumlah harus diisi'
            ],

            'harga_satuan' => [
                'required' => 'Harga Satuan harus diisi'
            ]
        ];


        [$inputs, $errors] = $this->filter($data, $fields, $message);

        if ($inputs['kadaluarsa'] == "") {
            $inputs['kadaluarsa'] = "0000-00-00";
        }

        if ($errors) {
            $data = [
                'status' => '400',
                'error' => '400 Bad Request',
                'message' => $errors,
                'data' => $inputs
            ];

            $this->view('template/header');
            header('HTTP/1.0 400 Bad Request');
            echo json_encode($data);
        } else {
            $proc = $this->barangModel->insert($inputs);
            if ($proc->rowCount() > 0) {
                $data = [
                    'status' => '201',
                    'error' => null,
                    'message' => 'Data berhasil ditambahkan',
                    'data' => $inputs
                ];
                $this->view('template/header');
                header('HTTP/1.0 201 OK');
                echo json_encode($data);
            } else {
                $data = [
                    'status' => '400',
                    'error' => '400 Bad Request',
                    'message' => 'Data gagal ditambahkan',
                    'data' => $inputs
                ];

                $this->view('template/header');
                header('HTTP/1.0 400 Bad Request');
                echo json_encode($data);
            }
        }
    }



    public function edit($id = null)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $fields = [
            'nama_barang' => 'string | required',
            'jumlah' => 'int | required',
            'harga_satuan' => 'float | required',
            'kadaluarsa' => 'string',
        ];

        $message = [
            'nama_barang' => [
                'required' => 'Nama Barang Harus diisi',
                'alphanumeric' => 'Masukan huruf dan angka',
                'between' => 'Nama Barang harus diantara 3 dan 25 karakter'
            ],

            'jumlah' => [
                'required' => 'Jumlah harus diisi'
            ],

            'harga_satuan' => [
                'required' => 'Harga Satuan harus diisi'
            ]
        ];


        [$inputs, $errors] = $this->filter($data, $fields, $message);

        if ($inputs['kadaluarsa'] == "") {
            $inputs['kadaluarsa'] = "0000-00-00";
        }

        $inputs['id'] = $id;

        if ($errors) {
            $data = [
                'status' => '400',
                'error' => '400 Bad Request',
                'message' => $errors,
                'data' => $inputs
            ];

            $this->view('template/header');
            header('HTTP/1.0 400 Bad Request');
            echo json_encode($data);
            exit();
        }else{
            $proc = $this->barangModel->update($inputs);
            if ($proc->rowCount() > 0) {
                $data = [
                    'status' => '201',
                    'error' => null,
                    'message' => 'Data berhasil diupdate',
                    'data' => $inputs
                ];
                $this->view('template/header');
                header('HTTP/1.0 201 OK');
                echo json_encode($data);
            } else {
                $data = [
                    'status' => '400',
                    'error' => '400 Bad Request',
                    'message' => 'Data gagal diupdate',
                    'data' => $inputs
                ];

                $this->view('template/header');
                header('HTTP/1.0 400 Bad Request');
                echo json_encode($data);
                exit();
            }
        }
    }
}
