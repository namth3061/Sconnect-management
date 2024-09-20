<?php

namespace App\Services;

use App\Contracts\Repositories\StrategyRepository;
use Illuminate\Database\Eloquent\Builder;

class StrategyService
{

    /**
     * @var \App\Contracts\Repositories\StrategyRepository
     */
    private StrategyRepository $strategyRepo;

    public function __construct(StrategyRepository $strategyRepo)
    {
        $this->strategyRepo = $strategyRepo;
    }

    public function queryStrategy(): Builder
    {
        return $this->strategyRepo->queryModel();
    }

    public function store(array $inputs): void
    {
        $this->strategyRepo->store($inputs);
    }

    public function findById(int $id): \Illuminate\Database\Eloquent\Model|null
    {
        return $this->strategyRepo->findById($id);
    }

    public function update(int $id, array $input): void
    {
        $this->strategyRepo->update($id, $input);
    }

    public function deleteById(int $id): void
    {
        $this->strategyRepo->delete($id);
    }
}
