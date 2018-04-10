<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/19/2017
 * Time: 9:01 AM
 */

namespace Data\Repositories;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

abstract  class Repository
{
    protected  $model;

    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    public function getAll($page){
        return $this->model->paginate($page);
    }

    public function getDetail($value,$attribute='id',$columns=array('*')){
        return $this->model->where($attribute,'=',$value)->first($columns);
    }

    public  function getByNameWithPaginate($value,$attribute,$pages){
        return $this->model->where($attribute,'LIKE',$value.'%')->paginate($pages);
    }

    public  function getByName($value,$attribute){
        return $this->model->where($attribute,'LIKE',$value.'%')->get();
    }

    public function create(array $data=[]) {
        return $this->model->create($data);
    }

    public function update(array $data=[], $id, $attribute='id')
    {
        $_data = $this->model->where($attribute,$id);

        if ($_data) {
            return ($_data->update($data)) ? $_data : false;
        }

        return false;
    }

    public function delete($value,$attribute='id'){
        return $this->model->where($attribute,'=',$value)->delete();
    }

    public function getLimitColumn($count){
        return $this->model()->take($count)->get();
    }

    public function getImage($path,$name){
        $image = $path  . $name;
        if(file_exists($image)){
            return Response::download($image);
        }
        return false;
    }

    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    abstract function model();
}