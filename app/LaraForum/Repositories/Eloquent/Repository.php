<?php

namespace App\LaraForum\Repositories\Contracts\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\LaraForum\Repositories\Contracts\RepositoryInterface;
use App\LaraForum\Repositories\Exceptions\RepositoryException;

abstract class Repository implements RepositoryInterface
{

    /**
     * @var App
     */
    private $app;

    protected $model;

    /**
     * Repository constructor.
     *
     * @param App $app
     * @throws \App\LaraForum\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array  $data
     * @param        $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->delestroy($id);
    }

    /**
     * @param       $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param       $attribute
     * @param       $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param       $attribute
     * @param       $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    /**
     * @param int   $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 10, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @return Model|mixed
     * @throws \App\LaraForum\Repositories\Exceptions\RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (! $model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }
}
