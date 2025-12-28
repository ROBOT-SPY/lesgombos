<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected ActivityService $service)
    {
        //throw new \Exception('Not implemented');
    }
    public function index()
    {
        //
        return $this->service->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        //
        return $this->service->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $this->service->findById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /*public function edit(string $id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityRequest $request, string $id)
    {
        //
        return $this->service->update($id,$request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $this->service->delete($id);
    }
}
