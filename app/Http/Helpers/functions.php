<?php

use App\Http\Services\CommonService;
use Illuminate\Database\Eloquent\Collection;


function uploadFile($file, $destination, $name = null, $edit = false, $oldPath = null) {
    $ext  = "jpg";
    $path = Config::get('app.APP_PATH')($destination);
    $name = $name ? $name.'-'.time().'.'.$ext : time().str_random(12).'.'.$ext;
    $file->move($path, $name);
    return $name;
}

function jsonResponse($message, $code = 200, $data = []) {
    return response()->json([
        'code' => $code,
        'message' => $message,
        'data' => $data
    ], $code);
}



// function addLog($type = 'admin', $content = null, $supplier_id = null) {
//     $commonObj = new CommonService;
//     if($type=="both"){
//         $commonObj->create("Logs", ['type' => "admin", 'content' => $content, "supplier_id"=> $supplier_id]);
//         $commonObj->create("Logs", ['type' => "supplier", 'content' => $content, "supplier_id"=> $supplier_id]);
//     }else $commonObj->create("Logs", ['type' => $type, 'content' => $content, "supplier_id"=> $supplier_id]);
// }


function human_filesize($size, $precision = 1) {
    $units = array(' B',' kB',' MB');
    $step = 1024;
    $i = 0;
    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    return round($size, $precision).$units[$i];
}


function vincentyGreatCircleDistance(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
  {
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);
  
    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
      pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
  
    $angle = atan2(sqrt($a), $b);
    return $angle * $earthRadius;
  }