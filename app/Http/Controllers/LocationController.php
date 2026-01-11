<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use app\Services\LocationService;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected LocationService $service) {}

    public function index()
    {
        return $this->service->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        return $this->service->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->service->findById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, string $id)
    {
        return $this->service->update($id, $request->validated());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->service->delete($id);
    }
}
