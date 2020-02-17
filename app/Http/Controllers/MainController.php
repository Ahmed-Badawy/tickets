<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Admin\RoleRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
  * Validation Requests
*/
// use App\Http\Requests\Admin\CommitteeMemberRequest;

use App\Http\Requests\Admin\AdminRequest;

/*
  * Repositories
*/
use App\Http\Services\CommonService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    private $commonObj;
    private $user;
    private $roles;

    public function __construct(CommonService $commonObj) {
        $this->commonObj = $commonObj;
        // $this->user = Auth::guard('admin_api')->user();
        // $this->user = null;
        // if($this->user) {
        //     $this->roles = (object) array_merge(rolesModal(), (array) $this->user->role->roles);
        // }
    }

    public function test(Request $request){
        return [1=>"one",2=>"two",3=>"three"];        
    }


    public function testEmail(Request $request) {
        $from = env('MAIL_USERNAME');
        $data = [];
        $data['email'] = 'couratks@gmail.com';

        Mail::send('Admin.mails.template', $data, function ($mail) use($data, $from) {
            $mail->from($from, 'Sumed');
            $mail->to($data['email'], 'Sumed')->subject('Sumed Invitiation');
        });
        return response()->json('OK');
    }

    public function uploadFile(Request $request) {
        $code = 201;
        $message = 'done.';
        try {
            $request->validate([ 'file' => 'required']);
            $file = $request->file('file');
            $destination = 'uploaded-files';
            $names = $request->names;
            $arr = [
                'name'=> $file->getClientOriginalName(), 
                'ext' => strtolower($file->getClientOriginalExtension()), 
                'size' => ($file->getClientSize() / 1024.0)
            ];
            $name = time().str_random(12).'.'.$arr["ext"];
                if(! move_uploaded_file($file->getPathName(), $destination."/".$name) ) {
                    throw new \Exception("failure");
                }
                $arr["saved_as"] = $name;
                $id = $this->commonObj->create('SystemDocument',$arr);
                $arr['id'] = $id->id;
                $arr['path'] = $id->path;
        } catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage(). '  '. $e->getFile();
        }
        return jsonResponse($message, $code, $arr);
    }


    public function createTicket(Request $request) {
        $code = 201;
        $message = 'done.';
        $data = $request->only(['title','description','image','audio','latitude','longitude','branch']);
        $data["image"] = join(",",$data["image"]);
        $data["audio"] = join(",",$data["audio"]);
        try {
            $ticket = $this->commonObj->create('Ticket', $data);
        } catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage(). '  '. $e->getFile();
        }
        return jsonResponse($message, $code, $data);
    }


    public function tickets(Request $request){
        $code = 201;
        $message = 'done.';
        $tickets = $this->commonObj->getAll('Ticket');
        foreach($tickets as $ticket){
            $imagesArray = explode(",",$ticket->image);
            $ticketImages = [];
            $audioArray = explode(",",$ticket->audio);
            $ticketAudio = [];
            foreach($imagesArray as $image){
                $image = $this->commonObj->find('SystemDocument', ['id' => $image]);
                if($image) $ticketImages[] = $image;
            }
            foreach($audioArray as $audio){
                $audio = $this->commonObj->find('SystemDocument', ['id' => $audio]);
                if($audio) $ticketAudio[] = $audio;
            }
            $ticket["image"] = $ticketImages;
            $ticket["audio"] = $ticketAudio;
            $ticket["branch"] = $this->commonObj->find('Branch', ['id' => $ticket->branch]);

        }
        return jsonResponse($message, $code, $tickets);
    }


    public function nearestBranches(Request $request) {
        $code = 201;
        $message = 'done.';
        $latitudeFrom = $request["latitude"];
        $longitudeFrom = $request["longitude"];
        $suggestions = [];
        try {
            $branches = $this->commonObj->getAll('Branch');
            foreach($branches as $branch){
                $distance = vincentyGreatCircleDistance( $latitudeFrom, $longitudeFrom, $branch->latitude, $branch->longitude);
                $branch->distance = $distance;
                if($distance<20) $suggestions[] = $branch;
            }
        } catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage(). '  '. $e->getFile();
        }
        return jsonResponse($message, $code, $suggestions);
    }


}
