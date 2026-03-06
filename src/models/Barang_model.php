<?php

class Barang_model extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $query = "select * from barang";
        return $this->query($query)->fetchAll();
    }
}
