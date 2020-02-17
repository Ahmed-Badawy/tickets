<?php

namespace App\Http\Services;

/**
 *  Tarek Mahfouz
 */

use App\Mail\ApprovalEmail;
use App\Mail\RejectionEmail;

class CommonService
{
    private $model;
    private static $namespace = 'App\Models\\';
    /**
     * @param mixed $model
     */

    public function getAll($model ,$conditions = [], $with = [], $per_page = 0, $whereIn = [], $reverse = true, $orderBy = 'id', $take = 0, $whereDate = null)
    {
        $class = self::$namespace.$model;
        $this->model = new $class();

        $items = count($with) ? $this->model->with($with) : $this->model;
        $items = (count($whereIn) && isset($whereIn['key']) && isset($whereIn['values'])) ? $items->whereIn($whereIn['key'], $whereIn['values']) : $items;
        $items = $items->where($conditions);
        $items = $whereDate ? $items->whereDate($whereDate['0'],$whereDate['1'],$whereDate['2']) : $items;
        $items = $reverse ?
            (
                $per_page ?
                    $items->orderBy($orderBy,'DESC')->paginate($per_page) :
                    $items->orderBy($orderBy,'DESC')->get()
                    //$items->orderBy('id','DESC')->toSql()
            )
            :
            (
                $per_page ?
                    $items->paginate($per_page) :
                    $items->get()
            );
        $items = $take ? $items->take($take) : $items;
        return $items;
    }
    

    public function search($model , $keys, $value, $per_page = 0, $with = [], $reverse = true, $orderBy = 'id', $take = 0, $whereDate = null, $searchIn = [], $whereIn = [], $whereDateBetween = [],$relations =[])
    {
        $class = self::$namespace.$model;
        $this->model = new $class();
        
        $items = count($with) ? $this->model->with($with) : $this->model;
        if(count($relations)){
            foreach($relations['key'] as $relkey => $relation){
                $actvalue = $relations['values'][$relkey];
                $table = $relations['table'][$relkey];
                $items = $items->whereHas($relation, function ($query) use($actvalue, $table){
                    $query->where($table.'.id', $actvalue);
                });
            }
        }
        $items = (count($whereIn) && isset($whereIn['key']) && isset($whereIn['values'])) ? $items->whereIn($whereIn['key'], $whereIn['values']) : $items;
        if(count($searchIn)) {
            //return $searchIn;
            foreach($searchIn as $searchInItem) {
                if(isset($searchInItem['key']) && isset($searchInItem['values']) && count($searchInItem['values'])) {
                    $items = $items->where(function($sql) use($searchInItem){
                        $len = count($searchInItem['values']);
                        $sql->where($searchInItem['key'], 'LIKE', '%'.$searchInItem['values'][0].'%');
                        if($len >= 1) {
                            for($i = 1; $i < $len; $i++) {
                                $sql->orWhere($searchInItem['key'], 'LIKE', '%'.$searchInItem['values'][$i].'%');
                            }
                        }
                    });
                }
            }
        }
        
       if($keys && $value) {
            $items = $items->where(function($sql) use($keys, $value){
                $len = count($keys);
                $sql->where($keys[0], 'LIKE', $value.'%');
                if($len > 1) {
                    for($i = 1; $i < $len - 1; $i++) {
                        $sql->orWhere($keys[$i], 'LIKE', $value.'%');
                    }
                }
            });
        }
        if(count($whereDateBetween)){
            foreach($whereDateBetween['key'] as $key=>$value){
                $items = $items->whereBetween($value, $whereDateBetween['value'][$key]);
            }
        }
        //  : $items;
        //return $whereDateBetween;
        $items = $whereDate ? $items->whereDate($whereDate['0'],$whereDate['1'],$whereDate['2']) : $items;
        $items = $items->orderBy($orderBy,'DESC');
        $items = $per_page ? $items->paginate($per_page) : $items->get();

        $items = $take ? $items->take($take) : $items;
        return $items;
    }

    public function find($model ,$conditions = [], $with = [], $whereIn = [])
    {
        $class = self::$namespace.$model;
        $this->model = new $class();

        $item = count($with) ? $this->model->with($with) : $this->model;
        $item = (count($whereIn) && isset($whereIn['key']) && isset($whereIn['values'])) ? $item->whereIn($whereIn['key'], $whereIn['values'])->where($conditions) : $item->where($conditions);
        $item = $item->first();

        return $item;
    }

    public function getById($model ,$conditions)
    {
        $class = self::$namespace.$model;
        $this->model = new $class();

        $item = $this->model->where($conditions)->first();
        return $item;
    }

    public function create($model ,array $data)
    {
        $class = self::$namespace.$model;
        $this->model = new $class();

        $item = $this->model->create($data);
        return $item;
    }

    public function bulkInsert($model ,array $data)
    {
        $class = self::$namespace.$model;
        $this->model = new $class();

        $item = $this->model->insert($data);
        return $item;
    }

    public function update($model ,$conditions, array $data, $whereIn = [])
    {
        $class = self::$namespace.$model;
        $this->model = new $class();

        $items = $this->model;
        $items = (count($whereIn) && isset($whereIn['key']) && isset($whereIn['values'])) ? $items->whereIn($whereIn['key'], $whereIn['values'])->where($conditions) : $items->where($conditions);
        $items = $items->update($data);

        $item = $this->model->where($conditions)->first();
        return $item;
    }

    public function destroy($model ,$condition = [], $whereIn = [])
    {
        $class = self::$namespace.$model;
        $this->model = new $class();

        if((count($whereIn) && isset($whereIn['key']) && isset($whereIn['values'])) && !count($condition))
            return $this->model->whereIn($whereIn['key'], $whereIn['values'])->delete();
        elseif(!count($whereIn) && count($condition))
            return $this->model->where($condition)->delete();
        elseif((count($whereIn) && isset($whereIn['key']) && isset($whereIn['values'])) && count($condition))
            return $this->model->where($condition)->whereIn($whereIn['key'], $whereIn['values'])->delete();

        return false;
    }
    
    public function updatestatus($model ,$condition = [], $data = [])
    {
        $class = self::$namespace.$model;
        $this->model = new $class();
        $supplierActivities = $this->model->where($condition)->get();
        if($supplierActivities)
        {
            $activities = $data['activities'];
            $reasons = $data['reasons'];
            $message = $data['emailMsg'];
            $files = $data['files'];
            $acNames =[];
            $approve =false;
            $supplier = \App\Models\Supplier::find($condition['supplier_id']);
            foreach($supplierActivities as $activity){
                if(isset($activities[$activity->activity_id])){
                    $status = statusCode($activities[$activity->activity_id]);
                    $activity->status = $status;
                    $activity->reason = $reasons[$activity->activity_id] ?? '';
                    $activity->save();
                    \App\Models\SupplierLogs::create([
                        'supplier_id' =>$condition['supplier_id'],
                        'status' => $activities[$activity->activity_id],
                        'content' => 'Your acitivity has been '.$activities[$activity->activity_id].'</br> by <b>Arab Petroleum Pipelines Co. SUMED</b> information system </br><p>'.$activity->reason.'</p>'
                    ]);
                    if($activity->is_category){
                        $Actname = \App\Models\Category::find($activity->activity_id);
                        $acNames[] =  ['name' => $Actname->name, 'reason' =>$activity->reason, 'status' =>  $activities[$activity->activity_id]];
                    }
                    else{
                        $Actname = \App\Models\Activity::find($activity->activity_id);
                        $acNames[] =  ['name' => $Actname->name, 'reason' =>$activity->reason, 'status' =>  $activities[$activity->activity_id]];
                    }
                    if($activities[$activity->activity_id] == 'approved'){
                        $approve = true;
                    }
                    
                }
            }
            if($approve){
                \Mail::to($supplier->email)->send(new ApprovalEmail(\URL::to('/'), $acNames, $message, $files),function($m){
                    $m->from('Sumed@info.com','Sumed');
                });
            }
            else{
                \Mail::to($supplier->email)->send(new RejectionEmail(\URL::to('/'), $acNames, $message, $files ),function($m){
                    $m->from('Sumed@info.com','Sumed');
                });
            }
        }
        $supplier = \App\Models\Supplier::find($condition['supplier_id']);
        $check = $supplier->approvedactivities;
        if(count($check)){
            $supplier->status = 3 ;
            $supplier->save();
        }
        else{
            $supplier->status = 4 ;
            $supplier->rejections += 1;
            $supplier->save();
        }
        return $supplierActivities;
    }

    public function checkunique($model , $keys, $data){
        $class = self::$namespace.$model;
        $this->model = new $class();
        foreach($keys as $key){
            $check = $this->find($model , [$key => $data[$key]]);
            if($check){
                return false;
            }
        }
        return true;
    }

    public function getDeleted($model,$committeeID , $whereIn=[]){
        $class = self::$namespace.$model;
        $this->model = new $class();
        if($committeeID){
            return $this->model->whereHas('committees', function ( $query) use ($committeeID)  {
                $query->where('committees.id', $committeeID);
            })->onlyTrashed()->get();
        }
        elseif(count($whereIn)){
            return $this->model->onlyTrashed()->whereIn('id', $whereIn)->get();
        }
        else{
            return $this->model->onlyTrashed()->get();
        }
    }

    public function insertArray($model ,array $data)
    {
        $class = self::$namespace.$model;
        $this->model = new $class();
        $supplier_id = \Auth::guard('supplier')->user()->id;
        $this->model->where(['supplier_id' => $supplier_id])->delete();
        $arr =[];
        foreach($data['name'] as $key => $value){
            if(isset($data['file'][$key]))
                $arr[] = $this->model->create([
                    'name' => $value, 
                    'file' => $data['file'][$key],
                    'supplier_id' => $supplier_id
                    ]);
        }
        return $arr;
    }


}
