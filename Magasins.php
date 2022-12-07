<?php

// classe des magasins.

class Magasins extends Controller
{

    public function __construct()
    {
        $this->table = 'magasins';
        $this->getDb();
    }

    public function getCategorie(int $id)
    {
        $resM = $this->find(['id' => $id], 'categories_id');

        $this->table = 'categories';
        $resC = $this->find(['id' => $resM['categories_id']], 'nom, description');

        return array_merge($resM, $resC);
    }

    public function getDescription($id)
    {
        $res = $this->find(['id' => $id], 'description');
        return $res;
    }

    public function getLastUpdate(int $id)
    {
        $res = $this->find(['id' => $id], 'updated_at');
        return $res;
    }

    public function getLogo(int $id)
    {
        $res = $this->find(['id' => $id], 'logo');
        return $res;
    }

    public function getId(int $id)
    {
        $res = $this->find(['id' => $id], 'id');
        return $res;
    }

    public function getNom(int $id)
    {
        $res = $this->find(['id' => $id], 'nom');
        return $res;
    }

}