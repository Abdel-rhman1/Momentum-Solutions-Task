<?php
namespace App\Http\Reposatries\Interfaces;
interface GenericRepositoryInterface {

    public function get();
    public function find($id);
    public function create(array $data);
    public function update($id,array $data);
    public function delete($id);

    // public function paginate($perPage = 15, $pageName = "page");

    // public function createOrUpdate($id, array $data);
    // public function findOrFail($id);
    // public function updateOrFail($id, array $data);
}
