<?php

namespace App\Services;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Notifications\Action;

class ActivityService{
  public function create($data){
    $model=Activity::create($data);
    return ActivityResource::make($model);
  }


  public function update(Activity $activity,$data){
    $model=Activity::find($activity->id);
    if(count($data)){

        $model->update($data);

    }

    return ActivityResource::make($model);
  }

  public function delete($activity){
    //$activity=Activity::find($id);

    return $activity->delete();
  }


  public function findById($id){
    $activity=Activity::find($id);

    return ActivityResource::make($activity);
  }


  public function getAll(){
  $activities=Activity::all();

  return ActivityResource::make($activities);
  }
}
?>
