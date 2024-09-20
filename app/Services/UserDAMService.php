<?php

namespace App\Services;

use App\Contracts\Repositories\UserDAMRepository;
use App\Models\UserDAM;
use Illuminate\Database\Eloquent\Model;

class UserDAMService
{
    protected UserDAMRepository $userRepo;

    public function __construct(UserDAMRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function store(array $inputs): Model|null|UserDAM
    {
        return $this->userRepo->store($inputs);
    }
}
