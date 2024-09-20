<?php

namespace App\Services;

use App\Contracts\Repositories\PermissionRepository;
use Illuminate\Database\Eloquent\Model;

class PermissionService
{
    /**
     * @var \App\Contracts\Repositories\PermissionRepository
     */
    protected PermissionRepository $permissionRepo;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }


    public function all(string $orderAscByField): \Illuminate\Database\Eloquent\Collection
    {
        return $this->permissionRepo->all($orderAscByField);
    }

    public function findById($id): \Illuminate\Database\Eloquent\Model|null
    {
        return $this->permissionRepo->findById($id);
    }

    public function findByField(array $input): Model|null
    {
        return $this->permissionRepo->findByField($input);
    }

    public function update($id, array $input): void
    {
        $this->permissionRepo->update($id, $input);
    }
}
