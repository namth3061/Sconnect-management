<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * @var \App\Contracts\Repositories\UserRepository
     */
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function searchUsers($inputs = []): Builder
    {
        return $this->userRepo->searchUsers($inputs);
    }

    public function store(array $inputs): Model|null|User
    {
        return $this->userRepo->store($inputs);
    }

    public function update(int $id, array $inputs): void
    {
        $this->userRepo->update($id, $inputs);
    }

    public function findById(int $id): Model|null
    {
        return $this->userRepo->findById($id);
    }

    public function delete(int $id): bool
    {
        return $this->userRepo->delete($id);
    }

}
