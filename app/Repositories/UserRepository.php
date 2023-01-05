<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends CustomRepository
{
    protected $model = User::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function getListForIndex($params)
    {
        $sortField = !empty($params['sort']) ? $params['sort'] : 'id';
        $sortType = !empty($params['direction']) ? $params['direction'] : 'desc';

        $builder = $this->select('*');

        if (!empty(data_get($params, 'email'))) {
            $builder->where('email', 'LIKE', '%' . data_get($params, 'email', '') . '%');
        }

        return $builder->orderBy($sortField, $sortType)->paginate(getConfig('page_number'));
    }

    public function getListForExport($params)
    {
        $sortField = !empty($params['sort']) ? $params['sort'] : 'id';
        $sortType = !empty($params['direction']) ? $params['direction'] : 'desc';
        $builder = $this->select(['id', 'email', 'created_at', 'updated_at']);

        if (!empty(data_get($params, 'email'))) {
            $builder->where('email', 'LIKE', '%' . data_get($params, 'email', '') . '%');
        }

        return $builder->orderBy($sortField, $sortType)->get()->toArray();
    }
}
