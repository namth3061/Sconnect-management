<?php

namespace App\Services;

use App\Contracts\Repositories\TenantRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TenantService
{
    /**
     * @var \App\Contracts\Repositories\TenantRepository
     */
    protected TenantRepository $tenantRepo;

    public function __construct(TenantRepository $tenantRepo)
    {
        $this->tenantRepo = $tenantRepo;
    }

    public function getTenants(array $tenantIds = []): Collection
    {
        return $this->tenantRepo->getDataByIds($tenantIds);
    }


    public function queryTenants(): Builder
    {
        return $this->tenantRepo->queryModel();
    }

    public function findTenantById(int $id): Model|null
    {
        return $this->tenantRepo->findById($id);
    }

    public function updateStatusTenant(array $tenantIds, string $status): void
    {
        $this->tenantRepo->updateStatusTenant($tenantIds, $status);
    }

    public function updateTenant(string $tenantIds, array $tenant): void
    {
        $this->tenantRepo->update($tenantIds, $tenant);
    }

    public function deleteTenant(int $tenantIds): void
    {
        $this->tenantRepo->delete($tenantIds);
    }

    public function store(array $inputs): void
    {
        $this->tenantRepo->store($inputs);
    }

    public function getTenantById(int $id): array
    {
        $tenant = $this->tenantRepo->findByField(['id' => $id]);

        if ($tenant) {
            return [
                'id' => $tenant->id,
                'name' => $tenant->name,
            ];
        }

        return [];
    }

    public function getTenantForSelect(int $perPage, int $page, ?string $searchTerm = ''): array
    {
        $tenant = $this->tenantRepo->getDataForSelect($perPage, $page, $searchTerm);

        $tenant = $tenant->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'name' => $item->name,
            ];
        });
        
        return [
            'items' => $tenant,
            'total_count' => $tenant->count(),
        ];
    }
}
