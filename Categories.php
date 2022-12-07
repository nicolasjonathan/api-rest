<?php

// classe des categories de magasins.

class Categories extends Controller
{

    public function __construct()
    {
        $this->table = 'categories';
        $this->getDb();
    }

    public function getNom(int $id)
    {
        $res = $this->find(['id' => $id], 'nom');
        return $res;
    }

    public function getDescription(int $id)
    {
        $res = $this->find(['id' => $id], 'description');
        return $res;
    }

}