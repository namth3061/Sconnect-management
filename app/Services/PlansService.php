<?php
namespace App\Services;

use App\Contracts\Repositories\PlansRepository;
use Illuminate\Database\Eloquent\Builder;

class PlansService {

    /**
     * @var \App\Contracts\Repositories\PlansRepository
     */
    private PlansRepository $plansRepo;

    public function __construct(PlansRepository $plansRepo)
    {
        $this->plansRepo = $plansRepo;
    }

    public function queryPlans(): Builder
    {
        return $this->plansRepo->queryModel();
    }

    public function store(array $inputs): void
    {
        $this->plansRepo->store($inputs);
    }

    public function findById(int $id): \Illuminate\Database\Eloquent\Model|null
    {
        return $this->plansRepo->findById($id);
    }

    public function update(int $id, array $input): void
    {
        $this->plansRepo->update($id, $input);
    }

    public function deleteById(int $id): void
    {
        $this->plansRepo->delete($id);
    }
}
