<?php

namespace App\Services;

use App\Contracts\Repositories\ProcessRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProcessService
{

    /**
     * @var \App\Contracts\Repositories\ProcessRepository
     */
    protected ProcessRepository $processRepo;

    public function __construct(ProcessRepository $processRepo)
    {
        $this->processRepo = $processRepo;
    }

    public function all(string $orderAscByField): Collection
    {
        return $this->processRepo->all($orderAscByField);
    }

    public function queryProcess(): Builder
    {
        return $this->processRepo->queryModel();
    }

    public function getProcessByIds(array $processIds): Collection
    {
        return $this->processRepo->getDataByIds($processIds);
    }

    public function findById(int $processId): Model|null
    {
        return $this->processRepo->findById($processId);
    }

    public function store(array $inputs): void
    {
        $this->processRepo->store($inputs);
    }

    public function update(int $tenantId, array $inputs): void
    {
        $this->processRepo->update($tenantId, $inputs);
    }

    public function delete(int $tenantId): void
    {
        $this->processRepo->delete($tenantId);
    }
}
