<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get all users.
     *
     * @param array $columns
     * @return Collection
     */

     public function all(array $columns = ['*']): Collection
    {
        return $this->model->all($columns);
    }

    public function latestPaginated($perPage = 5)
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function find(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function create(array $attributes): User
    {
        return $this->model->create($attributes);
    }

    public function update(User $user, array $attributes): bool
    {
        return $user->update($attributes);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
