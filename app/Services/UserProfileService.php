<?php

namespace App\Services;

use App\Contracts\Repositories\UserProfileRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserProfileService
{
    /**
     * @var \App\Contracts\Repositories\UserProfileRepository
     */
    protected UserProfileRepository $userProfileRepo;

    public function __construct(UserProfileRepository $userProfileRepo)
    {
        $this->userProfileRepo = $userProfileRepo;
    }

    public function store(array $inputs): Model|null
    {
       return $this->userProfileRepo->store($inputs);
    }

    public function findById(int $id): Model|null
    {
        return $this->userProfileRepo->findById($id);
    }

    public function update(int $id,array $inputs): void
    {
        $this->userProfileRepo->update($id, $inputs);
    }

    public function deleteByField(array $inputs): bool
    {
        return $this->userProfileRepo->deleteByField($inputs);
    }
}
