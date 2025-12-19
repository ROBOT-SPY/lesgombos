<?php

namespace App\Services;

use App\Models\Worker;
use App\Http\Resources\WorkerResource;

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
        $workers = Worker::all();
        return WorkerResource::collection($workers);
    }
}