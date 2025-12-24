<?php

namespace app\Services;

use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationService
{
    public function create($data)
    {

        $model = Location::create($data);

        return LocationResource::make($model);

    }

    public function update(Location $location, $data)
    {
        $model = Location::find($location->id);

        if (count($data)) {
            $model->update($data);
        }

        return LocationResource::make($model);
    }

    public function delete(Location $location)
    {

        return $location->delete();
    }

    public function findById($id)
    {
        $location = Location::find($id);

        return LocationResource::make($location);
    }

    public function getAll()
    {
        $locations = Location::All();

        return LocationResource::collection($locations);
    }
}
