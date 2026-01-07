<?php

namespace App\Services;

use App\Http\Resources\WorkerResource;
use App\Models\Worker;

class WorkerService
{
    public function create($data)
    {
        $model = Worker::create($data);

        return WorkerResource::make($model);

    }

    public function update(Worker $worker, $data)
    {
        $model = Worker::find($worker->id);

        if (count($data)) {
            $model->update($data);
        }

        return WorkerResource::make($model);
    }

    public function delete(Worker $worker)
    {
        return $worker->delete();
    }

    public function findById($id)
    {
        $worker = Worker::find($id);

        return WorkerResource::make($worker);
    }

    public function getAll()
    {
        // $workers = Worker::all();
        $workers = QueryBuilder::for(Worker::class)
        ->allowedFilters([
            'id',
            'name',
            'lastname',
            'contact',
            'email'
        ])
        ->allowedSorts(
            'name',
            'lastname'
        )
        ->paginate()
        ->appends(request()->query());

        return WorkerResource::collection($workers);
    }
}
