<?php

namespace App\Services;

use App\Models\Route;

class RouteService extends BaseService
{
    /**
     * The model class associated with this service
     *
     * @var string
     */
    protected $modelClass = Route::class;

    public function index(): array
    {
        return parent::index();
    }

    public function show(string $id): array
    {
        return parent::show($id);
    }

    public function store(array $data): array
    {
        return parent::store($data);
    }

    public function update(string $id, array $data): array
    {
        return parent::update($id, $data);
    }

    public function destroy(string $id): array
    {
        return parent::destroy($id);
    }
}
