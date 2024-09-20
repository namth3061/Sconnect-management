<?php

namespace App\Services;

use App\Contracts\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RoleService
{
    /**
     * @var \App\Contracts\Repositories\RoleRepository
     */
    protected RoleRepository $roleRepo;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function all(string $orderAscByField): \Illuminate\Database\Eloquent\Collection
    {
        return $this->roleRepo->all($orderAscByField);
    }

    public function store(array $inputs): void
    {
        $this->roleRepo->store($inputs);
    }

    public function findById($id): \Illuminate\Database\Eloquent\Model|null
    {
        return $this->roleRepo->findById($id);
    }


    public function findByField(array $input): Model|null
    {
        return $this->roleRepo->findByField($input);
    }

    public function update($id, array $input): void
    {
        $this->roleRepo->update($id, $input);
    }

    public function pluck(string $key, string $value): array
    {
        return $this->roleRepo->pluck($key, $value);
    }

    public function getRoleByName($name): array
    {
        $role = $this->roleRepo->findByField(['name' => $name]);
        
        if ($role) {
            return [
                'id' => $role->name,
                'name' => $role->name,
            ];
        }

        return [];
    }

    public function getRoleForSelect(int $perPage, int $page, ?string $searchTerm = ''): array
    {
        $roles = $this->roleRepo->getDataForSelect($perPage, $page, $searchTerm);

        $roles = $roles->map(function ($item) {
            return (object) [
                'id' => $item->name,
                'name' => $item->name,
            ];
        });

        return [
            'items' => $roles,
            'total_count' => $roles->count(),
        ];
    }
}
