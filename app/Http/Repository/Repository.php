<?php


namespace App\Http\Repository;


interface Repository
{
    public function getAll();
    public function create($data);
    public function update($data, $object);
    public function delete($object);
    public function findById($id);
}
