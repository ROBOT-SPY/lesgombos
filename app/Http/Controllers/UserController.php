<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Services\UserService;
use App\Services\SettingsService;

class WorkerController extends Controller
{
    public function __construct(
        protected UserService $service,
        private SettingsService $settingsService
        ) {}
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

    /**
     * SETTINGS
     */

    public function createPermissions()
    {
        return $this->settingsService->createPermissions();
    }

    public function createRole($data)
    {
        return $this->settingsService->createRole($data);
    }

    public function assignRoleToUser($userId, $roleIds)
    {
        return $this->settingsService->assignRoleToUser($userId, $roleIds);
    }

    public function revokeRoleFromUser($userId, $roleIds)
    {
        return $this->settingsService->revokeRoleFromUser($userId, $roleIds);
    }

    public function syncRoleToUser($roleIds)
    {
        return $this->settingsService->syncRoleToUser($roleIds);
    }

}
