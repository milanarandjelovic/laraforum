<?php

namespace App\LaraForum\Repositories\Contracts;

interface RepositoryInterface
{

    /**
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param       $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param       $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, array $columns = ['*']);

    /**
     * @param       $filed
     * @param       $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($filed, $value, array $columns = ['*']);

    /**
     * @param       $field
     * @param       $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($field, $value, array $columns = ['*']);

    /**
     * @param int   $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 10, array $columns = ['*']);
}
