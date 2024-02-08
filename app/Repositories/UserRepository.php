<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    /**
     * The User model instance.
     *
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
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

    /**
     * Get the latest paginated users.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function latestPaginated($perPage = 5)
    {
        return $this->model->latest()->paginate($perPage);
    }

    /**
     * Find a user by ID.
     *
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return $this->model->find($id);
    }

    /**
     * Create a new user.
     *
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User
    {
        return $this->model->create($attributes);
    }

    /**
     * Update a user's attributes.
     *
     * @param User $user
     * @param array $attributes
     * @return bool
     */
    public function update(User $user, array $attributes): bool
    {
        return $user->update($attributes);
    }

    /**
     * Delete a user.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
