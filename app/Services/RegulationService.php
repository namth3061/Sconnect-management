<?php

namespace App\Services;

use App\Contracts\Repositories\RegulationRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class RegulationService
{
    /**
     * @var \App\Contracts\Repositories\RegulationRepository
     */
    protected RegulationRepository $regulationRepo;

    public function __construct(RegulationRepository $regulationRepo)
    {
        $this->regulationRepo = $regulationRepo;
    }

    public function getRegulationByIds(array $RegulationIds): Collection
    {
        return $this->regulationRepo->getDataByIds($RegulationIds);
    }

    public function queryRegulation(): Builder
    {
        return $this->regulationRepo->queryModel();
    }

    public function all(string $orderAscByField): Collection
    {
        return $this->regulationRepo->all($orderAscByField);
    }

    public function findById(int $id): Model|null
    {
        return $this->regulationRepo->findById($id);
    }

    public function store(array $inputs): Model|null
    {
        return $this->regulationRepo->store($inputs);
    }

    public function update(int $id, array $inputs): void
    {
        $this->regulationRepo->update($id, $inputs);
    }

    public function delete(int $id): void
    {
        $this->regulationRepo->delete($id);
    }
}
