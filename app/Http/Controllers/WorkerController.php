<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Services\WorkerService;

class WorkerController extends Controller
{
    public function __construct(protected WorkerService $service) {}

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(WorkerRequest $request)
    {
        return $this->service->create($request->validated());
    }

    public function show(string $id)
    {
        return $this->service->findById($id);
    }

    public function update(WorkerRequest $request, string $id)
    {
        return $this->service->update($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->service->delete($id);
    }
}
