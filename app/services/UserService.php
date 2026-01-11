<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create($data)
    {
        $model = User::create($data);

        /**
         * TODO: create permission
         * - assign initial permission to user/admin
         */
        return UserResource::make($model);

    }

    public function update(User $user, $data)
    {
        $model = User::find($user->id);

        if (count($data)) {
            $model->update($data);
        }

        return UserResource::make($model);
    }

    public function delete(User $User)
    {
        return $User->delete();
    }

    public function findById($id)
    {
        $User = User::find($id);

        return UserResource::make($User);
    }

    public function getAll()
    {
        // $Users = User::all();
        $Users = QueryBuilder::for(User::class)
            ->allowedFilters([
                'id',
                'name',
                'lastname',
                'contact',
                'email',
            ])
            ->allowedSorts(
                'name',
                'lastname'
            )
            ->paginate()
            ->appends(request()->query());

        return UserResource::collection($Users);
    }
}
