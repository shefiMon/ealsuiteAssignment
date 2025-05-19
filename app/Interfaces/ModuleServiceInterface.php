<?php

namespace App\Interfaces;

interface ModuleServiceInterface
{
    public function list($requst);
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
