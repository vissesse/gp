<?php
namespace App\repository\implemetions;

use App\repository\interfaces\Interfaces;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements Interfaces
{

    protected Model $model;
 
 
    function all()
    {
        return $this->model->all();
    }
    function find(int $id){
        return $this->model->find($id);
    }
    function create(array $data)
    {
        return $this->model->create($data);
    }
    function update(int $id, array $data)
    {
        return $this->model->find($id)->update($data);
    }
    function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }

    function listPerPage(int $number_page){
        return $this->model::paginate($number_page);
    }
 
}
