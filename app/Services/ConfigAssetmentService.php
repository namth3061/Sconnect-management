<?php

namespace App\Services;

use App\Contracts\Repositories\ConfigAssetmentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class ConfigAssetmentService
{
    /**
     * @var \App\Contracts\Repositories\ConfigAssetmentRepository
     */
    protected ConfigAssetmentRepository $configAssetmentRepo;

    public function __construct(ConfigAssetmentRepository $configAssetmentRepo)
    {
        $this->configAssetmentRepo = $configAssetmentRepo;
    }

    public function getConfigAssetmentByIds(array $configAssetmentIds): Collection
    {
        return $this->configAssetmentRepo->getDataByIds($configAssetmentIds);
    }

    public function queryConfigAssetment(): Builder
    {
        return $this->configAssetmentRepo->queryModel();
    }

    public function all(string $orderAscByField): Collection
    {
        return $this->configAssetmentRepo->all($orderAscByField);
    }

    public function findById(int $id): Model|null
    {
        return $this->configAssetmentRepo->findById($id);
    }

    public function store(array $inputs): Model|null
    {
        return $this->configAssetmentRepo->store($inputs);
    }

    public function update(int $id, array $inputs): void
    {
        $this->configAssetmentRepo->update($id, $inputs);
    }

    public function delete(int $id): void
    {
        $this->configAssetmentRepo->delete($id);
    }
}
