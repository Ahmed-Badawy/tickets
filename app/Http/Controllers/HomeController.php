<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ActivityRequest;
use App\Http\Requests\Admin\RoleRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
  * Validation Requests
*/
use App\Http\Requests\Admin\CommitteeMemberRequest;
use App\Http\Requests\Admin\CommitteeRequest;
use App\Http\Requests\Admin\CommitteeSupplierRequest;
use App\Http\Requests\Admin\MeetingRequest;
use App\Http\Requests\Admin\MeetingSupplierRequest;
use App\Http\Requests\Admin\ListRequest;
use App\Http\Requests\Admin\ListSupplierRequest;
use App\Http\Requests\Admin\AdminRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
/*
  * Repositories
*/
use App\Http\Services\CommonService;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Supplier\SupplierRequest;
use Illuminate\Support\Facades\Hash;

use App\Mail\InvitationEmail;
use function PHPSTORM_META\map;


class HomeController extends Controller
{
    private $commonObj;
    private $user;
    private $roles;

    public function __construct(CommonService $commonObj)
    {
        $this->commonObj = $commonObj;
        $this->user = Auth::guard('admin_api')->user();
        // $this->user = null;
        if($this->user) {
            $this->roles = (object) array_merge(rolesModal(), (array) $this->user->role->roles);
        }
    }



    public function test(Request $request)
    {

        $from = env('MAIL_USERNAME');
        $data = [];
        $data['email'] = 'timahfouz262@gmail.com';

        Mail::send('Admin.mails.template', $data, function ($mail) use($data, $from) {
            $mail->from($from, 'Sumed');
            $mail->to($data['email'], 'Sumed')->subject('Sumed Invitiation');
        });
        return response()->json('OK');
    }
    # ===================================== #
    # =========== Post Requests =========== #
    # ===================================== #
    public function search(Request $request)
    {
        $code = 200;
        $message = 'done.';
        $searchKey = $request->key;
        $data = [
           "committees" => [], 
           "suppliers" => [], 
           "lists" => [], 
           "admin_users" => [], 
        ];
        try {
            if($this->roles->committees->access) {
                $data['committees'] = $this->commonObj->search('Committee', ['name','description'],$searchKey,0,[],true);
                $data['committees']->map(function($item) {
                    $item->meetingsCount = count($item->meetings);
                    $item->membersCount = count($item->members);
                    $item->creationDate = date('M dS, Y',strtotime($item->created_at));
                    $item->makeHidden(['meetings','members','created_at','updated_at']);
                });
            }

            $data['suppliers'] = $this->commonObj->search('Supplier', ['company_name','commercial_name','username','fax_number','email','address','phone','website','ceiling_value'],$searchKey,0,[],true);
            $data['suppliers']->map(function($item) {
                $item['ActivityNames'] = $item->activities->pluck('name')->toArray();
                $item->joiningDate = date('M dS, Y',strtotime($item->created_at));
                $item->makeHidden(['activities','type','status','company_name','commercial_name','country_id','city_id','fax_number','address','website','blocked','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','created_at','updated_at','ceiling_value','pivot']);
                $item->makeHidden(['supplier_id']);
            });
            if($this->roles->lists->access) {
                $data['lists'] = $this->commonObj->search('SystemList', ['name','description'],$searchKey,0,[],true);
                $data['lists']->map(function($item) {
                    $item->suppliersCount = count($item->suppliers);
                    $item->creationDate = date('M dS, Y',strtotime($item->created_at));
                    $item->makeHidden(['suppliers','created_at','updated_at']);
                });
            }

            $data['admin_users'] = $this->commonObj->search('Admin', ['name'],$searchKey,0,[],true);
            $data['admin_users']->map(function($item) {
                if($item->role) {
                    $item->roleName = $item->role->name;
                    $item->roleFunctions = $item->role->roles;
                    $item->makeHidden(['role']);
                }
            });

        } catch (\Exception $e) {
            $message = $e->getMessage().' '.$e->getLine();
        }
        return jsonResponse($message, $code, $data);
    }
        # Email Templates
    public function uploadFile(Request $request) {
        return jsonResponse("this is the route", 200);
        
        $code = 201;
        $message = 'done.';
        $ids = [];
        $filesArr = [];

        try {
            // return $request->file("file");
            $request->validate([
                'names' => 'required',
                'file' => 'required',
                ]);
            $data = [];
            $files = $request->file('file');
            $destination = 'documents';
            $names = $request->names;
            if(is_array($files) && is_array($names)){
                foreach($files as $key=> $file){
                    $arr = ['org_name'=> $file->getClientOriginalName(), 'ext' => $file->getClientOriginalExtension(), 'size' => ($file->getClientSize() / 1024.0)];
                    if(! $fileName = uploadFile($file, $destination, $names[$key])) {
                        throw new \Exception("failure");
                    }
                    $data =$arr;
                    $data['name'] = $fileName;
                    $id = $this->commonObj->create('SystemDocument',$data);
                    $arr['id'] = $id->id;
                    $arr['path'] = $id->path;
                    array_push($filesArr,$arr);
                    $arr =[];
                }
            }
            else{
                $arr = ['ext' => $files->getClientOriginalExtension(), 'size' => ($files->getClientSize() / 1024.0)];

                if(! $fileName = uploadFile($files, $destination, $names)) {
                    throw new \Exception("failure");
                }
                $data['name'] = $fileName;
                $id = $this->commonObj->create('SystemDocument',$data);
                $arr['id'] = $id->id;
                $arr['path'] = $id->path;
                array_push($filesArr,$arr);
                $arr =[];

            }
        } catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage(). '  '. $e->getFile();
        }
        return jsonResponse($message, $code, $filesArr);
    }
    public function uploadBulk(Request $request) {
        $code = 201;
        $message = 'done.';
        $data = [];
        try {
            // return $request->file("file");
            $request->validate([
                'file' => 'required',
            ]);
            $file = $request->file('file');
            $name = 'Pluck Supplier';
            $destination = 'documents';
            
            if(! $fileName = uploadFile($file, $destination, $name)) {
                throw new \Exception("failure");
            }
            $exel = Excel::load('documents/'.$fileName, function ($reader) {
                foreach ($reader->toArray() as $row) {
                    foreach($row as $key => $supplier){
                    }
                ;
                }
            });
            $data = $exel = $exel->toArray();
            foreach($exel[0] as $supplierData){
                $check = $this->commonObj->find('Supplier',['id' => $supplierData['id']]);
                $supplierId = $supplierData['id'];
                $supplierData['password'] = Hash::make($supplierData['password']);
                $supplierData['status'] = 3;
                $supplierData['confirmed_at'] = Carbon::now();
                $check = $this->commonObj->checkunique('Supplier',['company_name', 'commercial_name', 'username', 'email', 'corporate_email'],$supplierData);
                if($check){

                    $inserted = $this->commonObj->create('Supplier',$supplierData);
                    //Contacts
                    foreach ($exel[1] as $key => $contact) {
                        if($supplierId == $contact['supplier_id']){
                            $contact['supplier_id'] = $inserted->id;
                            $insertedcontact = $this->commonObj->create('ContactPerson',[
                                "supplier_id"=> $contact['supplier_id'],
                                "name"=> $contact['name'],
                                "email"=> $contact['email'],
                                "role"=> $contact['role'],
                                "job"=> $contact['job'],
                                "fax"=> $contact['fax']
                            ]);
                            $phone = $this->commonObj->create('ContactsPhone',[
                                'contact_id'=>$insertedcontact->id,
                                'phone'=>$contact['phones'],
                                'code'=>$contact['phonescode']
                            ]);
                            unset($exel[1][$key]);
    
                        }
                        elseif(!$contact['supplier_id']){
                            $phone = $this->commonObj->create('ContactsPhone',[
                                'contact_id'=>$insertedcontact->id,
                                'phone'=>$contact['phones'],
                                'code'=>$contact['phonescode']
                            ]);
    
                        }
                    }
                    //Agents
                    foreach ($exel[2] as $key => $agent) {
                        if($supplierId == $agent['supplier_id']){
                            $agent['supplier_id'] = $inserted->id;
                            $insertedagent = $this->commonObj->create('Agent',[
                                "supplier_id"=> $agent['supplier_id'],
                                "name"=> $agent['name'],
                                "email"=> $agent['email']
                            ]);
                            $phone = $this->commonObj->create('AgentPhone',[
                                'agent_id'=>$insertedagent->id,
                                'phone'=>$agent['phones'],
                                'code'=>$agent['phonescode']
                            ]);
                            unset($exel[2][$key]);
                        }
                        elseif(!$agent['supplier_id']){
                            $phone = $this->commonObj->create('AgentPhone',[
                                'agent_id'=>$insertedagent->id,
                                'phone'=>$agent['phones'],
                                'code'=>$agent['phonescode']
                            ]);
    
                        }
    
                    }
                    //Banks
                    foreach ($exel[3] as $key => $bank) {
                        if($supplierId == $bank['supplier_id']){
                            $bank['supplier_id'] = $inserted->id;
                            $insertedbank = $this->commonObj->create('SupplierBank',[
                                "supplier_id"=> $bank['supplier_id'],
                                "bank_name"=> $bank['bank_name'],
                                "abbreviation"=> $bank['abbreviation'],
                                "swift_code"=> $bank['swift_code'],
                                "iban_code"=> $bank['iban_code'],
                                "currency"=> $bank['currency'],
                                "account_number"=> $bank['account_number']
                            ]);
                            
                            unset($exel[3][$key]);
                        }
    
                    }
                    //Branches
                    foreach ($exel[4] as $key => $branch) {
                        if($supplierId == $branch['supplier_id']){
                            $branch['supplier_id'] = $inserted->id;
                            $insertedbranch = $this->commonObj->create('SupplierBranch',[
                                "supplier_id"=> $branch['supplier_id'],
                                "name"=> $branch['name'],
                                "address"=> $branch['address'],
                                "fax"=> $branch['fax'],
                                "email"=> $branch['email']
                            ]);
                            
                            unset($exel[4][$key]);
                        }
                    }
                    //Activities
                    foreach ($exel[5] as $key => $activity) {
                        if($supplierId == $activity['supplier_id']){
                            $activity['supplier_id'] = $inserted->id;
                            $insertedactivity = $this->commonObj->create('SupplierActivity',[
                                "supplier_id"=> $activity['supplier_id'],
                                "activity_id"=> $activity['activity_id'],
                                "status"=> 3,
                                "is_category"=> $activity['is_category']
                            ]);
                            unset($exel[5][$key]);
                        }
                    }
                }

            }

        } catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $data);
    }
    public function uploadBulkActivities(Request $request) {
        $code = 201;
        $message = 'done.';
        $data = [];
        try {
            // return $request->file("file");
            $request->validate([
                'fileName' => 'required',
            ]);
            $name = 'Pluck Supplier';
            $destination = 'documents';
            
            $fileName = $request->fileName;
            $exel = Excel::load('documents/'.$fileName, function ($reader) {
                foreach ($reader->toArray() as $row) {
                    foreach($row as $key => $activity){
                    }
                ;
                }
            });
            $data = $exel = $exel->toArray();
            $codesId = [];
            $ParentTypes = [];
            foreach ($exel[0] as $key => $value) {
                $check = $this->commonObj->find('Activity',["code"=> $value['unique_code']]);
                if(!$check && !isset($codesId[$value['unique_code']])){
                    $added = $this->commonObj->create('Activity',[
                        "parent_id"=> 0,
                        "name"=> $value['name'],
                        "code"=> $value['unique_code'],
                        "product"=> TypeCode($value['type']),
                        "type"=> $value['type'],
                        "show"=> 1,
                    ]);
                    $codesId[$value['unique_code']] = $added->id;
                    $ParentTypes[$value['unique_code'].'_type'] = $value['type'];
                }
                elseif($check){
                    $codesId[$value['unique_code']] = $check->id;
                    $ParentTypes[$value['unique_code'].'_type'] = $check->type;


                }

            }
            unset($exel[0]);
            foreach ($exel as $key => $subs) {
                foreach ($subs as $subKey => $sub) {
                    $check = $this->commonObj->find('Activity',["code"=> $sub['unique_code']]);
                    if(!$check && !isset($codesId[$sub['unique_code']])){
                        $Subadded = $this->commonObj->create('Activity',[
                            "name"=> $sub['name'],
                            "code"=> $sub['unique_code'],
                            "parent_id"=> $codesId[$sub['parent_code']] ?? 0,
                            "product"=> TypeCode($ParentTypes[$sub['parent_code'].'_type'] ?? 'Service Provider'),
                            "type"=> $ParentTypes[$sub['parent_code'].'_type'] ?? 'Service Provider',
                            "show"=> 1,
                        ]);
                        $codesId[$sub['unique_code']] = $Subadded->id;
                        $ParentTypes[$Subadded['unique_code'].'_type'] = $Subadded->type;

                    }
                    elseif($check){
                        $codesId[$sub['unique_code']] = $check->id;
                        $ParentTypes[$sub['unique_code'].'_type'] = $check->type;
                    }
                }

            }
            

        } catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage() . '   '.$e->getLine();
        }
        return jsonResponse($message, $code, $data);
    }

    public function sendEmails(Request $request){
        $code = 200;
        $message = 'done.';
        $data = [];
        try {
            $pathes = [];
            $suppliers =collect();
            $emailmessage = $request->message ? $request->message : '----------'; 
            $template = '';
            if($request->filled('files')) {
                foreach($request['files'] as $file) {
                    $pathes[] = $file;
                }
            }
            if($request->filled('list_id')){
                $list = $this->commonObj->find('SystemList', ['id'=> $request->list_id]);
                if($list){
                    $suppliers = $suppliers->merge($list->suppliers);
                }
                else{
                    return jsonResponse('List not found!', 401, []);

                }
            }
            if($request->filled('suppliers')){
                $whereIn = ['key' => 'id','values'=> $request->suppliers];
                $suppliers = $this->commonObj->getAll('Supplier', [] ,[],0, $whereIn);
                $suppliers = $suppliers->merge($suppliers);
            }
            $suppliers = $suppliers->all();
            foreach ($suppliers as $key => $supplier) {
                \Mail::to($supplier->email)->send(new \App\Mail\AvailableOpportunitiesEmail(\URL::to('/'), $emailmessage, $template, $pathes),function($m){
                    $m->from('Sumed@info.com','Sumed');
                });
            }

        } catch (\Exception $e) {
            $message = $e->getMessage().' '.$e->getLine();
        }
        return jsonResponse($message, $code, $data);
    }

    public function AttachMeetingFile(Request $request){
        $code = 201;
        $message = 'done.';
        $data = [];

        try {
            $request->validate([
                'meeting_id' => 'required',
                'documents' => 'required',
            ]);
            $meeting = $this->commonObj->find('Meeting', ['id'=> $request->meeting_id]);
            if(! $meeting ) { throw new \Exception("failure"); }
            $files = $request->documents;
            foreach($files as $file){
                $check = $this->commonObj->find('MeetingDocument', ['meeting_id'=> $request->meeting_id, 'document'=>$file]);
                if($check){
                    $check = $this->commonObj->destroy('MeetingDocument', ['meeting_id'=> $request->meeting_id, 'document'=>$file]);
                }
                else{
                    $data[] = $this->commonObj->create('MeetingDocument', ['meeting_id'=> $request->meeting_id, 'committee_id'=>$meeting->committee_id, 'document'=>$file ]);
                }
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $data);
    }

    public function createEmailTemplate(Request $request)
    {
        $code = 200;
        $message = 'done.';
        $data = [];
        try {
            $request->validate([
                'name' => 'required',
                'content' => '',
                'deletable' => 'boolean',
                'category' => 'required',
                'lang' => 'required',
            ]);

            // dd($request->all());

            $data = $request->only(['name','content','deletable','category','lang']);
            $template = $this->commonObj->create('EmailTemplate', $data);

            if($request->hasFile('files')) {
                $filesData = [];
                foreach($request->file('files') as $file) {
                    $name = implode('.', array_slice(explode('.',$file->getClientOriginalName()), 0, -1));
                    $emailFilesData['name'] = $fileData[] = uploadFile($file, 'documents', $name);
                    $doc = $this->commonObj->create('SystemDocument', $emailFilesData);

                    $fileData = array('email_template_id' => $template->id, 'doc_id' => $doc->id);
                    $filesData[] = $fileData;
                }
                $this->commonObj->bulkInsert('EmailDoc', $filesData);
            }

        } catch (\Exception $e) {
            $message = $e->getMessage();
            $code = 400;
        }
        return jsonResponse($message, $code, $data);
    }
        # Admin Users And Roles
    public function createAdmin(AdminRequest $request)
    {
        $data = $request->except(['_token','image','password_confirmation','sendEmail']);
        $request->validate([
            'name' => 'required',
            'phone' => 'numeric',
            'email' => 'required|unique:admins',
            'password' => 'required',
            ]);
        $admin = $this->commonObj->create('Admin', $data);
        if($admin && $request->sendEmail) {
            $data['emailtemp'] =  \App\Models\EmailTemplate::find(1)->content;
            $from = env('MAIL_USERNAME');
            $data['url'] = \URL::to('/');
            $data['password'] = $request->password;
            Mail::send('mails.invitation', $data, function ($mail) use($data, $from) {
                $mail->from($from, 'Sumed');
                $mail->to($data['email'], 'Sumed')->subject('Sumed Invitiation');
            });
        }
        return jsonResponse('Created successfully', 201, $admin);
    }
    public function createOrUpdateRole(RoleRequest $request)
    {
        try {
            $result = [];
            $message = 'Created successfully';
            $code = 201;
            $data = $request->only(['name']);
            $data['roles'] = json_encode($request->roles);
            if($request->id) {
                
                $role = $this->commonObj->find('Role', ['id' => $request->id]);
                if(!$role) {
                    throw new \Exception('not found!',404);
                }
                if($role->id == 1){
                    return jsonResponse('Super Admins aren\'t subjective to permission changes.', 401, []);
                }
                $this->commonObj->update('Role', ['id' => $request->id],$data);
                $message = 'Updated successfully';
            } else {
                $result = $this->commonObj->create('Role', $data);
            }
        }   catch(\Exception $e) {
            $message = $e->getMessage();
            $code = 400;
        }   //finally {
        //     return jsonResponse($message, $code, $result);
        // }
    }
        # Committees And Meetings
    public function createCommittee(CommitteeRequest $request)
    {
        $code = 201;
        $message = 'Created successfully';
        $committee = [];
        try {
            $openMeetingExist = $this->commonObj->find('Meeting', [], [], ['key' => 'status', 'values' => ['pending','in-progress']]);
            if($openMeetingExist) {
                throw new \Exception('There are Open Meetings!');
            }
            $data = $request->only(['name', 'description']);
            $committee = $this->commonObj->create('Committee', $data);

            addLog('admin',$this->user->name.' create '.$request->name.' committee');

        } catch (\Exception $e) {
            $code = 500;
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $committee);
    }
    public function crudCommitteeMember(Request $request)
    {
        $committeeID = $request->committee_id;
        if(is_array($request->admin_ids) && count($request->admin_ids)) {
            $adminIDs = array_unique($request->admin_ids);
            if(!$request->delete) {
                $bulkData = [];
                $this->commonObj->destroy('CommitteeMember', ['committee_id' => $committeeID]);
                foreach($adminIDs as $adminID) {
                    $bulkDataItem = [];
                    $dataToCheck = ['committee_id' => $committeeID, 'admin_id' => $adminID];
                    //Validator::make($data, $rules, $messages);
                    $valid = Validator::make($dataToCheck,
                        [
                            'committee_id' => 'required|exists:committees,id',
                            'admin_id' => 'required|exists:admins,id',
                        ]
                    );
                    if(!$valid->fails()){
                        $bulkDataItem['committee_id'] = $committeeID;
                        $bulkDataItem['admin_id'] = $adminID;
                        $bulkDataItem['created_at'] = Carbon::now();
                        $bulkDataItem['updated_at'] = Carbon::now();
                        $bulkData[] = $bulkDataItem;
                    }
                }
                $this->commonObj->bulkInsert('CommitteeMember', $bulkData);

                addLog('admin',$this->user->name.' added members to '.$request->name.' committee');


                return jsonResponse('Created successfully', 201);
            } else {
                # Delete Condition
                $this->commonObj->destroy('CommitteeMember', ['committee_id' => $committeeID],['key' => 'admin_id', 'values' => $request->admin_ids]);
                return jsonResponse('done', 201, []);
            }
        } else {
            return jsonResponse('no members supported', 400);
        }
        /*$data = $request->only(['admin_id', 'committee_id']);
        $committee = $this->commonObj->create('CommitteeMember', $data);
        return jsonResponse('Created successfully', 201, $committee);*/
    }
    public function crudCommitteeSupplier(Request $request)
    {
        $committeeID = $request->committee_id;
        if(is_array($request->supplier_ids)) {
            $supplierIDs = array_unique($request->supplier_ids);
            if(!$request->delete) {
                $bulkData = [];
                $this->commonObj->destroy('CommitteeSupplier', ['committee_id' => $committeeID]);
                foreach($supplierIDs as $supplierID) {
                    $bulkDataItem = [];
                    $dataToCheck = ['committee_id' => $committeeID, 'supplier_id' => $supplierID];
                    $valid = Validator::make($dataToCheck,
                        [
                            'committee_id' => 'required|exists:committees,id',
                            'supplier_id' => 'required|exists:suppliers,id',
                        ]
                    );
                    if(!$valid->fails()){
                        
                            $bulkDataItem['committee_id'] = $committeeID;
                            $bulkDataItem['supplier_id'] = $supplierID;
                            $bulkDataItem['created_at'] = Carbon::now();
                            $bulkDataItem['updated_at'] = Carbon::now();
                            $bulkData[] = $bulkDataItem;
                        
                    }
                }
                $this->commonObj->bulkInsert('CommitteeSupplier', $bulkData);
                return jsonResponse('Created successfully', 201);
            } else {
                # Delete Condition
                $this->commonObj->destroy('MeetingSupplier' ,  ['committee_id' => $committeeID],['key' => 'supplier_id', 'values' => $request->supplier_ids]);
                $this->commonObj->destroy('CommitteeSupplier', ['committee_id' => $committeeID],['key' => 'supplier_id', 'values' => $request->supplier_ids]);
                return jsonResponse('done', 201, []);
            }
        }
    }
    public function crudCommitteeSupplierCheck(Request $request)
    {
        $code = 201;
        $message = 'Success';
        $data =[];
        try {
            $committeeID = $request->committee_id;
            if(is_array($request->supplier_ids)) {
                $supplierIDs = array_unique($request->supplier_ids);
                    foreach($supplierIDs as $supplierID) {
                            $supplier = $this->commonObj->find('Supplier', ['id' => $supplierID]);
                            if($supplier && count($supplier->committees->where('id','!=', $committeeID))){ 
                                $code = 400;
                                $message = 'Fail';
                                $data[] =$supplierID;

                            }
                    }
            }
        }
        catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $data);
    }
    public function addMeeting(MeetingRequest $request)
    {
        $data = $request->only(['topic', 'committee_id', 'start_time', 'end_time', 'date','description_header']);
        $meeting = $this->commonObj->create('Meeting', $data);

        addLog('admin',$this->user->name.' added '.$request->topic.' Meeting');

        return jsonResponse('Created successfully', 201, $meeting);
    }
    public function crudMeetingSupplier(Request $request)
    {
        $meetingID = $request->meeting_id;
        $meeting = $this->commonObj->find('Meeting', ['id' => $request->meeting_id]);
        $committeeID = $meeting->committee_id;

        if(is_array($request->supplier_ids)) {
            $supplierIDs = array_unique($request->supplier_ids);
            if(!$request->delete) {
                $bulkData = [];
                $this->commonObj->destroy('MeetingSupplier', ['meeting_id' => $meetingID]);
                foreach($supplierIDs as $supplierID) {
                    $bulkDataItem = [];
                    $dataToCheck = ['meeting_id' => $meetingID, 'supplier_id' => $supplierID];
                    //Validator::make($data, $rules, $messages);
                    $valid = Validator::make($dataToCheck,
                        [
                            'meeting_id' => 'required|exists:meetings,id',
                            'supplier_id' => 'required|exists:suppliers,id',
                        ]
                    );
                    if(!$valid->fails()){
                        $bulkDataItem['committee_id'] = $committeeID;
                        $bulkDataItem['meeting_id'] = $meetingID;
                        $bulkDataItem['supplier_id'] = $supplierID;
                        $bulkDataItem['created_at'] = Carbon::now();
                        $bulkDataItem['updated_at'] = Carbon::now();
                        $bulkData[] = $bulkDataItem;
                    }
                }
                $this->commonObj->bulkInsert('MeetingSupplier', $bulkData);
                return jsonResponse('Created successfully', 201);
            } else {
                # Delete Condition
                $this->commonObj->destroy('MeetingSupplier', ['meeting_id' => $meetingID],['key' => 'supplier_id', 'values' => $request->supplier_ids]);
                return jsonResponse('done', 201, []);
            }
        }
    }
        # Lists
    public function createList(ListRequest $request)
    {
        $data = $request->only(['name', 'description']);
        $list = $this->commonObj->create('SystemList', $data);

        addLog('admin',$this->user->name.' created '.$request->name.' List');

        return jsonResponse('Created successfully', 201, $list);
    }
    public function crudListSupplier(Request $request)
    {
        $listID = $request->list_id;
        $list = $this->commonObj->find('SystemList', ['id' => $listID]);

        if(is_array($request->supplier_ids) && count($request->supplier_ids)) {
            $supplierIDs = array_unique($request->supplier_ids);
            if(!$request->delete) {
                $bulkData = [];
                $this->commonObj->destroy('ListSupplier', ['list_id' => $listID]);
                //return "OK";
                foreach($supplierIDs as $supplierID) {
                    $supplier = $this->commonObj->find('Supplier', ['id' => $supplierID]);
                    if($request->list_id == 1 && $supplier->status == 1){
                        $supplier->status = 4;
                        $supplier->save();
                    }
                    $bulkDataItem = [];
                    $dataToCheck = ['list_id' => $listID, 'supplier_id' => $supplierID];
                    //Validator::make($data, $rules, $messages);
                    $valid = Validator::make($dataToCheck,
                        [
                            'list_id' => 'required|exists:lists,id',
                            'supplier_id' => 'required|exists:suppliers,id',
                        ]
                    );
                    if(!$valid->fails()){
                        if($listID == 1) {
                            $this->commonObj->update('Supplier', ['id' => $supplierID],['blocked' => 1]);
                            addLog('both',$this->user->name." Marked supplier ".$supplier->username." as BlackListed ", $supplier->id);
                        }else addLog('both',$this->user->name." put supplier ".$supplier->username." in list ".$list->name, $supplier->id);
                        
                        $bulkDataItem['list_id'] = $listID;
                        $bulkDataItem['supplier_id'] = $supplierID;
                        $bulkDataItem['created_at'] = Carbon::now();
                        $bulkDataItem['updated_at'] = Carbon::now();
                        $bulkData[] = $bulkDataItem;
                    }
                }
                $this->commonObj->bulkInsert('ListSupplier', $bulkData);
                return jsonResponse('Created successfully', 201);
            } else {
                # Delete Condition
                foreach($supplierIDs as $supplierID) {
                    $supplier = $this->commonObj->find('Supplier', ['id' => $supplierID]);
                    addLog('both',$this->user->name." removed supplier ".$supplier->username." from the list ".$list->name, $supplier->id);
                }
                if($listID == 1) {
                    $this->commonObj->update('Supplier', [],['blocked' => 0], ['key' => 'id', 'values' => $request->supplier_ids]);
                }
                $this->commonObj->destroy('ListSupplier', ['list_id' => $listID],['key' => 'supplier_id', 'values' => $request->supplier_ids]);
                return jsonResponse('done', 201, []);
            }
        } else {
            return jsonResponse('no suppliers supported', 400);
        }
        /*$data = $request->only(['supplier_id', 'list_id']);
        $listSupplier = $this->commonObj->create('ListSupplier', $data);
        return jsonResponse('Created successfully', 201, $listSupplier);*/
    }
        # Activities
    public function createActivity(ActivityRequest $request)
    {
        $data = $request->only(['name', 'code', 'parent_id']);
        $data['show'] = (int)$request->show;
        if($data['parent_id']){
            $activityP = $this->commonObj->find('Activity', ['id' => $data['parent_id']]);
            $data['product'] = $activityP->product;
        }
        else{
            $data['product'] = (int)$request->product;
        }
        $activity = $this->commonObj->create('Activity', $data);

        addLog('admin',$this->user->name.' created '.$request->name.' Activity');

        return jsonResponse('Created successfully', 201, $activity);
    }




    # ==================================== #
    # =========== Get Requests =========== #
    # ==================================== #
    public function dashboard(Request $request)
    {
        $code = 200;
        $message = 'done.';
        $data = [];
        try {
            $data['pending_requests'] = count($this->commonObj->getAll("Supplier", ['status' => 1]));
            $data['filtered_requests'] = count($this->commonObj->getAll("Supplier", ['status' => 2]));
            $data['total_suppliers'] = count($this->commonObj->getAll("Supplier"));

            $data['last_approved_suppliers'] = $this->commonObj->getAll("Supplier", ['status'=>3], [], 0, [], true, 'updated_at', 5);
            
            $data['last_approved_suppliers']->map(function($supplier) {
                $activities = $supplier->activities;
                foreach($activities as $act){
                    $supplier['ActivityNames'] = getActivityParents($act, ['id','parent_id','name','code','role_id','product','show','type'],true, true, true);
                }
                $names = [];
                foreach($activities as $activityID) {
                    if( !$activityID->pivot->is_category){
                        $activity = getActivityParents($activityID->id, ['id','parent_id','name','code','role_id','product','show','type'],true, true, true);                        
                        $names[] = $activity;
                    }
                    
                }
                $categoriesIDs = $supplier->categories;
                foreach($categoriesIDs as $categoriesID) {
                    if( $categoriesID->pivot->is_category){
                        $category = getActivityParents($categoriesID->activity->id, ['id','parent_id','name','code','role_id','product','show','type'],true, true, true);
                        array_push($category, $categoriesID->name);
                        $names[] = $category;
                    }
                    
                }
                $supplier['ActivityNames'] = $names;
                
                $supplier->makeHidden(['activities','type','status','company_name','commercial_name','country_id','city_id','fax_number','address','website','blocked','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','created_at','updated_at','ceiling_value','pivot']);
                $supplier->makeHidden(['supplier_id']);
                $supplier;
            });
            $data['upcoming_meetings'] = $this->commonObj->getAll("Meeting", [], [], 0, [], true, 'updated_at', null, ['date','=',Carbon::today()]);
            $data['upcoming_meetings']->map(function($meeting) {
                $meeting->date = date('Y-m-d',strtotime($meeting->date));
                $meeting->start_time = date('h:i',strtotime($meeting->start_time));
                $meeting->end_time = date('h:i',strtotime($meeting->end_time));

                $meeting->date_processed = date('M dS, Y',strtotime($meeting->date));
                $meeting->start_time_processed = date('h:i A',strtotime($meeting->start_time));
                $meeting->end_time_processed = date('h:i A',strtotime($meeting->end_time));
            });

            $meetingsIDs = $this->commonObj->getAll("Meeting",[],[],0,['key' => 'status', 'values' => ['pending', 'in-progress']])->pluck('id')->toArray();
            $suppliersInMeetings = 0;
            $meetings = [];
            foreach($meetingsIDs as $meetingsID) {
                $meeting = $this->commonObj->find("Meeting", ['id' => $meetingsID]);
                $meeting->date_processed = date('M dS, Y',strtotime($meeting->date));
                $meeting->start_time_processed = date('h:i A',strtotime($meeting->start_time));
                $meeting->end_time_processed = date('h:i A',strtotime($meeting->end_time));
                if($meeting) {
                    $meeting['suppliers_count'] = count($meeting->suppliers);
                    $suppliersInMeetings += count($meeting->suppliers);
                    $meetings[] = $meeting;
                }
            }
            $data['suppliers_count_in_meetings'] = $suppliersInMeetings;
            $data['meetings'] = $meetings;
        } catch (\Exception $e) {
            //$code = 500;
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $data);
    }
    public function getLogs(Request $request){
        $code = 200;
        $message = 'done.';
        $data = [];
        try {
            $conditions = ['type' => 'admin'];
            $data = $this->commonObj->getAll("Logs", $conditions);
            $data->map(function($item) {
                $item->creationDate = date('F d, h:ia',strtotime($item->created_at));
                $item->makeHidden(['supplier_id','type','col','olddata','newdata','file','path','created_at','updated_at']);
            });
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $code = 400;
        }
        return jsonResponse($message, $code, $data);
    }
        # Email Templates
    public function getEmailTemplates(Request $request)
    {
        $code = 200;
        $message = 'done.';
        $data = [];
        try {
            $conditions = [];
            if($request->filled('category'))
                $conditions['category'] = $request->category;
            if($request->filled('lang'))
                $conditions['lang'] = $request->lang;

            $data = $this->commonObj->getAll("EmailTemplate", $conditions, ['documents']);
            foreach ($data as $template) {
                $template->documents->makeHidden(['pivot']);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $code = 400;
        }
        return jsonResponse($message, $code, $data);
    }
    public function getEmailTemplateInfo(Request $request)
    {
        $code = 200;
        $message = 'done.';
        $template = [];
        try {
            $conditions = ['id' => $request->template_id];
            $template = $this->commonObj->find("EmailTemplate", $conditions, ['documents']);
            if(!$template) {
                $code = 404;
                throw new \Exception('not found!');
            }
            $template->documents->makeHidden(['pivot']);
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $template);
    }
    public function getEmailDocs(Request $request)
    {
        $code = 200;
        $message = 'done.';
        $data = [];
        try {
            $data = $roles = $this->commonObj->getAll('SystemDocument');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $data);
    }
        # Admin Users And Roles
    public function getAdminRoles(Request $request)
    {
        $roles = $this->commonObj->getAll("Role");
        $allRoles = [];
        foreach($roles as $role){
            $newRole["id"] = $role->id; 
            $newRole["name"] = $role->name; 
            $newRole["roles"] = (object) array_merge(rolesModal(), (array) $role->roles); 
            $allRoles[] = $newRole;
        }
        return jsonResponse('done', 200, $allRoles);
    }

        # Committees And Meetings
    public function getAdminMembers(Request $request)
    {
        $message = 'done';
        $code = 200;
        try {
            $items = $this->commonObj->getAll("Admin");
            $items->map(function($admin) {
                $admin->role_name = $admin->role->name ?? "";
                $admin->makeHidden(['role']);
            });
        } catch(\Exception $e) {
            $code = $e->getCode() ? $e->getCode() : 500;
            $message = $e->getMessage();
            $items = [];
        }
        return jsonResponse($message, $code, $items);
    }
    public function getCommittees(Request $request)
    {
        $committees = $this->commonObj->getAll("Committee");
        $committees->map(function($item) {
            //return $item->created_at;
            $item->meetingsCount = count($item->meetings);
            $item->membersCount = count($item->members);
            $item->suppliersCount = count($item->suppliers);
            $item->creationDate = date('M dS, Y',strtotime($item->created_at));
            $item->makeHidden(['meetings','members','created_at','updated_at', 'suppliers']);
        });
        return jsonResponse('done', 200, $committees);
    }
    public function getCommitteeInfo(Request $request)
    {
        $committee = $this->commonObj->find("Committee",['id' => $request->id],['meetings','members','suppliers']);
        if(!$committee) {
            return jsonResponse('not found', 404, []);
        }
        $committee->meetingsCount = count($committee->meetings);
        $committee->membersCount = count($committee->members);
        $committee->suppliersCount = count($committee->suppliers);

        $committee->meetings->map(function($item) {
            $item->suppliersCount = count($item->suppliers);
            $item->membersCount = count($item->members);
            // $item->date = date('M dS, Y',strtotime($item->date));
            $item->start_time = date('h:i A',strtotime($item->start_time));
            $item->end_time = date('h:i A',strtotime($item->end_time));
            $item->makeHidden(['members','suppliers']);
        });
        $committee->members->map(function($item) {
            $item->roleName = $item->role->name;
            $item->makeHidden(['pivot','role']);
        });
        $committee->suppliers->map(function($item) {
            $item->date = date('M dS, Y',strtotime($item->created_at));
            $item->status = supplierStatus($item->status);
            $item->makeHidden(['company_name','commercial_name','country_id','city_id','fax_number','email','address','phone','website','blocked','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','remember_token','created_at','updated_at','password','ceiling_value','pivot']);
        });

        $committee->creationDate = date('M dS, Y',strtotime($committee->created_at));
        $committee->makeHidden(['created_at','updated_at']);

        return jsonResponse('done', 200, $committee);
    }
    public function getCommitteeSummery(Request $request)
    {
        $committee = $this->commonObj->find("Committee",['id' => $request->id],['meetings','members','suppliers']);
        if(!$committee) {
            return jsonResponse('not found', 404, []);
        }
        $committee->meetingsCount = count($committee->meetings);
        $committee->membersCount = count($committee->members);
        $committee->suppliersCount = count($committee->suppliers);
        $commiteeSIds = $committee->suppliers->pluck('id')->toArray();
        $committee->rejectedSuppliersCount = count($committee->suppliers->where('status', 4));
        $committee->acceptedSuppliersCount = count($committee->suppliers->where('status', 3));
        $committee->deletedSuppliersCount = count($this->commonObj->getDeleted("Supplier", $committee->id));
        $committee->documentsCount = count($committee->documents);
        $committee->meetings->map(function($item) {
            $item->suppliersCount = count($item->suppliers);
            $item->membersCount = count($item->members);
            // $item->date = date('M dS, Y',strtotime($item->date));
            $item->start_time = date('h:i A',strtotime($item->start_time));
            $item->end_time = date('h:i A',strtotime($item->end_time));
            $item->rejectedSuppliersCount = count($item->suppliers->where('status', 4));
            $item->acceptedSuppliersCount = count($item->suppliers->where('status', 3));
            $item->documents->map(function($doc) {
                $doc->makeHidden(['pivot','id']);

            });
            $item->makeHidden(['members','suppliers']);
        });
        $committee->creationDate = date('M dS, Y',strtotime($committee->created_at));
        $committee->makeHidden(['created_at','updated_at', 'members', 'suppliers', 'documents']);

        return jsonResponse('done', 200, $committee);

        
    }
    public function getCommitteeMeetings(Request $request)
    {
        $meetings = $this->commonObj->getAll('Meeting', ['committee_id' => $request->committee_id]);
        $meetings->map(function($item) {
            $item->suppliersCount = count($item->suppliers);
            $item->membersCount = count($item->members);

            $item->date = date('Y-m-d',strtotime($item->date));
            
            $item->date_processed = date('M dS, Y',strtotime($item->date));
            $item->start_time_processed = date('h:i a',strtotime($item->start_time));
            $item->end_time_processed = date('h:i a',strtotime($item->end_time));
            $item->makeHidden(['members','suppliers']);
        });
        return jsonResponse('done', 200, $meetings);
    }
    public function getCommitteeMembers(Request $request)
    {
        $committee = $this->commonObj->find('Committee', ['id' => $request->committee_id]);
        $members = $committee->members ?? [];

        if(count($members)) {
            $members->map(function($item) {
                $item->roleName = $item->role->name;
                $item->makeHidden(['pivot','role']);
            });
        }

        return jsonResponse('done', 200, $members);
    }
    public function getCommitteeSuppliers(Request $request)
    {
        $committee = $this->commonObj->find('Committee', ['id' => $request->committee_id]);
        $suppliers = $committee->suppliers ?? [];
        if(count($suppliers)) {
            $suppliers->map(function($item) {
                $item->date = date('M dS, Y',strtotime($item->created_at));
                $item->status = supplierStatus($item->status);
                $item->makeHidden(['company_name','commercial_name','country_id','city_id','fax_number','email','address','phone','website','blocked','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','remember_token','created_at','updated_at','password','ceiling_value','pivot']);
            });
        }
        return jsonResponse('done', 200, $suppliers);
    }
    public function getMeetingInfo(Request $request) {
        $meeting = $this->commonObj->find("Meeting", ['id' => $request->id], ['suppliers']);        
        if(!$meeting) {
            return jsonResponse('not found', 404, []);
        }
        $meeting->date = date('Y-m-d',strtotime($meeting->date));
        $meeting->start_time = date('h:i',strtotime($meeting->start_time));
        $meeting->end_time = date('h:i',strtotime($meeting->end_time));

        $meeting->date_processed = date('M dS, Y',strtotime($meeting->date));
        $meeting->start_time_processed = date('h:i A',strtotime($meeting->start_time));
        $meeting->end_time_processed = date('h:i A',strtotime($meeting->end_time));
        $members = [];
        if(count($meeting->committee->members)) {
            foreach($meeting->committee->members as $member) {
                $member->role_name = $member->role->name;
                $member->makeHidden(['pivot','role','role_id']);
                $members[] = $member;
            }
        }
        $meeting->members = $members;
        $meeting->documents = $meeting->documents;

        $meeting->suppliers->map(function($supplier) {
            $supplier->date = date('M dS, Y',strtotime($supplier->created_at));
            $supplier->activities->map(function($activity){
                $activity->status = supplierStatus($activity->pivot->status);
                $activity->reason = $activity->pivot->reason;
                $activity->makeHidden(['parent_id','code','show','pivot']);
            });
            $supplier->status = supplierStatus($supplier->status);
            $supplier->makeHidden(['company_name','commercial_name','country_id','city_id','fax_number','email','address','phone','website','blocked','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','created_at','updated_at','ceiling_value','pivot']);
        });
        $meeting->makeHidden(['committee']);
        return jsonResponse('done', 200, $meeting);
    }
        # Lists
    public function getLists(Request $request)
    {
        $lists = $this->commonObj->getAll("SystemList",[],['suppliers']);
        $lists->map(function($item) {
            $item->suppliersCount = count($item->suppliers);
            $item->creationDate = date('M dS, Y',strtotime($item->created_at));
            $item->makeHidden(['suppliers','created_at','updated_at']);
        });
        return jsonResponse('done', 200, $lists);
    }
    public function getListInfo(Request $request)
    {
        $list = $this->commonObj->find("SystemList", ['id' => $request->id], ['suppliers']);
        if(!$list) {
            return jsonResponse('not found', 404, []);
        }
        $list->creationDate = date('M dS, Y',strtotime($list->created_at));
        $list->suppliersCount = count($list->suppliers);
        $list->suppliers->map(function($supplier) {
            $supplier->date = date('M dS, Y',strtotime($supplier->created_at));
            $supplier->status = supplierStatus($supplier->status);
            $supplier['ActivityNames'] = $supplier->activities->pluck('name')->toArray();
            $supplier->makeHidden(['activities','company_name','commercial_name','country_id','city_id','fax_number','email','address','phone','website','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','created_at','updated_at','ceiling_value','pivot']);
        });
        return jsonResponse('done', 200, $list);
    }
        # Suppliers And Requests
    public function getRequests(Request $request)
    {
        $code = 200;
        $message = 'done.';

        try {
            $result = $this->commonObj->getAll("Supplier", ['status' => 1]);
            $result->map(function($changeRequest) {
                $changeRequest->creationDate = date('M dS, Y',strtotime($changeRequest->created_at));
                $changeRequest->ActivityNames = $changeRequest->activities->pluck('name')->toArray();
                $changeRequest->status = supplierStatus($changeRequest->status);
                $changeRequest->makeHidden(['activities','type','company_name','commercial_name','country_id','city_id','fax_number','address','website','blocked','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','created_at','updated_at','ceiling_value','pivot']);
            });
        } catch (\Exception $e) {
            $code = 500;
            $message = $e->getMessage();
            $result = [];
        }
        return jsonResponse($message, $code, $result);
    }
    public function getRequestInfo(Request $request)
    {
        $changeRequest = $this->commonObj->find("Supplier", ['id' => $request->id], []);
        if(!$changeRequest) {
            return jsonResponse('not found', 404, []);
        }
        $changeRequest->creationDate = date('M dS, Y',strtotime($changeRequest->created_at));
        if($changeRequest) {
            $changeRequest->national = $changeRequest->national ? 'foreign' : 'local';
            $changeRequest->status = supplierStatus($changeRequest->status);
            $changeRequest->banks->map(function($bank){
                $bank->countryName = $bank->country->name ?? '';
                $bank->makeHidden(['country_id','country','abbreviation','supplier_id']);
            });
            $changeRequest->branches->map(function($branch){
                $branch->cityName = $branch->city->name ?? '';
                $branch->countryName = $branch->country->name ?? '';
                $branch->makeHidden(['city','country_id','city_id','country','supplier_id']);
            });
            $changeRequest->documents->map(function($document){
                $fileExt = $document->file ? explode('.',$document->file) : [];
                $document->ext = count($fileExt) ? strtoupper($fileExt[1]) : "";
                $document->cityName = $document->city->name ?? '';
                $document->countryName = $document->country->name ?? '';
                $document->makeHidden(['city','country_id','city_id','country','supplier_id']);
            });
            $names = [];
            foreach($changeRequest->activities as $activity) {
                $names[] = getActivityParents($activity->id, ['id','parent_id','name','code','role_id','product','show','type'],true, true, true);
            }
            $changeRequest->activityNames = $names;
            /*$changeRequest->supplier->activities->map(function($activity){
                $activity->activityNames = getActivityParents($activity->id, ['id','parent_id','name','code','role_id','product','show','type'],true, true);
                $activity->makeHidden(['id','parent_id','name','code','role_id','product','show','type','pivot']);
            });*/
            $changeRequest->makeHidden(['activities','status','commercial_name','country_id','city_id','capital_of_enterprise','corporate_email','email_confirmation','confirmed_at','created_at','updated_at','pivot']);
        }
        return jsonResponse('done', 200, $changeRequest);
    }
    public function getSuppliers(Request $request)
    {
        $whereDateBetween = $conditions = $suppliers = $searchIn = $whereIn = [];
        $search_value = '';
        $keys = [];
        $relations =[];
        $orderBy = $request->sortBy ? $request->sortBy : 'id';
        $according = $request->according == 'ASC' ? false : true;
        $pageLimit = $request->pageLimit ? $request->pageLimit : 0;
        if($request->filled('search')){
            $search_value = $request->search;
            $keys =['company_name','commercial_name','username','fax_number','email','address','phone','website','ceiling_value'];
        }
        if($request->status && count($request->status)) {
            $whereIn['key'] = 'status';
            $whereIn['values'] = collect($request->status)->map(function ($name) {
                return statusCode($name);
            });
        }
        // else{
        //     $whereIn['key'] = 'status';
        //     $whereIn['values'] = [0];
        // }
        $suppliers = $this->commonObj->search('Supplier', $keys , $search_value,$pageLimit,[],$according,$orderBy,0,null,$searchIn,$whereIn,$whereDateBetween, $relations);

        foreach($suppliers as $supplier) {
            $supplier->creationDate = date('M dS, Y',strtotime($supplier->created_at));
            $supplier['ActivityNames'] = $supplier->activitiesAc->pluck('name')->toArray();
            $supplier['ActivityNames'] = array_merge($supplier['ActivityNames'], $supplier->categoriesAc->pluck('name')->toArray());
            $supplier->makeHidden(['activities_ac', 'categories_ac','activities','type','status','company_name','commercial_name','country_id','city_id','fax_number','address','website','blocked','capital_of_enterprise','national','corporate_email','business_type','email_confirmation','confirmed_at','created_at','updated_at','ceiling_value','pivot']);
            $supplier->makeHidden(['supplier_id']);
        }
        return jsonResponse('done', 200, $suppliers);
    }

    public function supllierSearch(Request $request)
    {
        $message = 'done';
        $code = 200;
        try {
            $whereDateBetween = $conditions = $suppliers = $searchIn = $whereIn = [];
            $search_value = '';
            $keys = [];
            $relations =[];
            if($request->company_type && count($request->company_type)) {
                $searchIn[0]['key'] = 'type';
                $searchIn[0]['values'] = $request->company_type;
            }
            if($request->national && count($request->national)) {
                $searchIn[1]['key'] = 'national';
                $searchIn[1]['values'] = $request->national;
            }
            if($request->business_type && count($request->business_type)) {
                $searchIn[2]['key'] = 'business_type';
                $searchIn[2]['values'] = $request->business_type;
                if(array_intersect(['agent','company'], $request->business_type))
                    $searchIn[2]['values'][] = 'both';
            }
            if($request->status && count($request->status)) {
                $whereIn['key'] = 'status';
                $whereIn['values'] = collect($request->status)->map(function ($name) {
                    return statusCode($name);
                });
            }
            if($request->filled('activity_id') ) {
                if($request->is_category){
                    $relations['key'][] = 'categoriesAc';
                    $relations['table'][] = 'categories';
                }
                else{
                    $relations['key'][] = 'activitiesAc';
                    $relations['table'][] = 'activities';
                }
                $relations['values'][] = $request->activity_id;
            }
            if($request->filled('joined_to') && $request->filled('joined_from')){
                $whereDateBetween['key'][] = 'created_at';
                $whereDateBetween['value'][] = [$request->joined_from,$request->joined_to];
            }
            if($request->filled('from') && $request->filled('to')){
                $whereDateBetween['key'][] = 'status_at';
                $whereDateBetween['value'][] = [$request->from,$request->to];
            }
            if($request->filled('search_value')){
                $search_value = $request->search_value;
                $keys = ['company_name','commercial_name','username','fax_number','email','address','phone','website','ceiling_value'];
            }
            $orderBy = $request->sortBy ? $request->sortBy : 'id';
            $according = $request->according == 'ASC' ? false : true;
            $pageLimit = $request->pageLimit ? $request->pageLimit : 0;
            
            $suppliers = $this->commonObj->search('Supplier', $keys , $search_value,$pageLimit,[],$according,$orderBy,0,null,$searchIn,$whereIn,$whereDateBetween, $relations);
            
            foreach($suppliers as $supplier) {
                $supplier->creationDate = date('M dS, Y',strtotime($supplier->created_at));
                $supplier['ActivityNames'] = $supplier->activitiesAc->pluck('name')->toArray();
                $supplier['ActivityNames'] = array_merge($supplier['ActivityNames'], $supplier->categoriesAc->pluck('name')->toArray());
                $supplier->status = supplierStatus($supplier->status);
                $supplier->makeHidden(['activities_ac', 'categories_ac','activities','type','company_name','commercial_name','country_id','city_id','fax_number','address','website','blocked','capital_of_enterprise','corporate_email','email_confirmation','confirmed_at','created_at','updated_at','ceiling_value','pivot']);
                $supplier->makeHidden(['supplier_id']);
            }
            $res = $suppliers;
        } catch (\Exception $e){
            $code = in_array($e->getCode(), [200,400,404]) ? $e->getCode() : 400;
            $message = $e->getMessage().' '.$e->getFile().' '.$e->getLine();
            $res = [];
        }
        return jsonResponse($message, $code, $res);
    }

    public function getOpenMeeting(Request $request) {
        $conditions = [['status', '!=' , 'completed']];
        $meetings = $this->commonObj->getAll("Meeting",$conditions);
        return jsonResponse('done', 200, $meetings);
    }

    public function getSupplierInfo(Request $request)
    {
        $supplier = $this->commonObj->find("Supplier", ['id' => $request->id]);
        if(!$supplier) {
            return jsonResponse('not found', 404, []);
        }
        $supplier->creationDate = date('M dS, Y',strtotime($supplier->created_at));

        if($supplier) {
            $supplier->national = $supplier->national ? 'foreign' : 'local';
            $supplier->status = supplierStatus($supplier->status);
            $supplier->countryName = $supplier->country->name??'';
            $supplier->cityName = $supplier->city->name??'';
            $supplier->banks->map(function($bank){
                $bank->countryName = $bank->country->name ?? '';
                $bank->makeHidden(['country_id','country','supplier_id']);
            });
            $supplier->branches->map(function($branch){
                $branch->cityName = $branch->city->name ?? '';
                $branch->countryName = $branch->country->name ?? '';
                $branch->makeHidden(['city','country_id','city_id','country','supplier_id']);
            });
            $supplier->documents->map(function($document){
                $fileExt = $document->file ? explode('.',$document->file) : [];
                $document->ext = count($fileExt) ? strtoupper($fileExt[1]) : "";
                $document->cityName = $document->city->name ?? '';
                $document->countryName = $document->country->name ?? '';
                $document->start_time_processed = date('M jS, Y',strtotime($document->start_date));
                $document->end_time_processed = date('M jS, Y',strtotime($document->expire_date));
                if($document->document) {
                    $document->name = $document->document->name;
                    $document->name_ar = $document->document->name_ar;
                }
                $document->makeHidden(['document','city','country_id','city_id','country','supplier_id']);
            });
            $supplier->documentsGrouped = $supplier->documents->groupBy('document_id');

            $supplier->lists->map(function($list){
                $list->creationDate = date('M dS, Y',strtotime($list->created_at));
                // $list->suppliersCount = count($list->suppliers);
                $list->makeHidden(['created_at','updated_at','suppliers','pivot']);
            });

            $supplier->contactPersons->map(function($contact){
                $contact->makeHidden(['created_at','updated_at','supplier_id']);
            });
            $supplier->agents->map(function($agent){
                $agent->countryName = $agent->country->name ?? '';
                $agent->makeHidden(['created_at','updated_at','supplier_id']);
            });
            $supplier->logs->map(function($log){
                $log->content = $log->col ? 'changed '.$log->col .' from '.$log->olddata.' to '. $log->newdata: $log->content ;
                $log->creationDate = date('M dS, Y',strtotime($log->created_at));
                $log->file = $log->file ? $log->file : '';
                $log->makeHidden(['id', 'col', 'olddata', 'newdata','created_at','updated_at','supplier_id']);
            });

            $activityIDs = $supplier->activities;
            $names = [];
            foreach($activityIDs as $activityID) {
                if( !$activityID->pivot->is_category){
                    $activity = getActivityParents($activityID->id, ['id','parent_id','name','code','role_id','product','show','type'],true, true, true);
                    
                    if($activityID->code == 'other'){
                        array_unshift($activity, $activityID->pivot->other);

                    }
                    array_unshift($activity,supplierStatus($activityID->pivot->status));
                    $activity['projects'] = $activityID->supplierProjectsApi($supplier->id);
                    if($activityID->code == 'other'){
                        $temp = $activity['1'];
                        $activity['1'] = $activity['2'];
                        $activity['2'] = $temp;

                    }
                    $names[] = $activity;
                }
            }
            $categoriesIDs = $supplier->categories;
            foreach($categoriesIDs as $categoriesID) {
                if( $categoriesID->pivot->is_category){
                    $category = getActivityParents($categoriesID->activity->id, ['id','parent_id','name','code','role_id','product','show','type'],true, true, true);
                    array_unshift($category,supplierStatus($categoriesID->pivot->status));
                    array_push($category, $categoriesID->name);
                    $category['projects'] = $categoriesID->supplierProjectsApi($supplier->id);
                    $names[] = $category;
                }
                
            }
            $supplier['ActivityNames'] = $names;
            $supplier->makeHidden(['activities','country_id','city_id','capital_of_enterprise','email_confirmation','confirmed_at','created_at','updated_at','pivot']);
        }

        $supplier->banks = collect([]);
        $supplier->branches = collect([]);
        $supplier->documents = collect([]);
        $supplier->agents = collect([]);
        $supplier->logs = collect([]);
        $supplier->activities = collect([]);
        $supplier->lists = collect([]);
        return jsonResponse('done', 200, $supplier);
    }

    public function getSupplierlogs(Request $request){
        $supplier = $this->commonObj->find("Supplier", ['id' => $request->id]);
        if(!$supplier) {
            return jsonResponse('not found', 404, []);
        }

        if($supplier){
            $logs = $supplier->logs->map(function($log){
                $log->content = $log->col ? 'changed '.$log->col .' from '.$log->olddata.' to '. $log->newdata: $log->content ;
                $log->creationDate = date('M dS, Y',strtotime($log->created_at));
                $log->file = $log->file ? $log->file : '';
                $log->makeHidden(['id', 'col', 'olddata', 'newdata','created_at','updated_at','supplier_id']);
                return $log;
            });

        }

        return jsonResponse('done', 200, $logs);

    }
        # Activities
    public function getActivities(Request $request)
    {
        $activities = $this->commonObj->getAll("Activity",['parent_id' => 0],[],0,[],false);
        $activities->map( function($activity){
            $whereIn = ['key' => 'activity_id', 'values' => $activity->getChildrenIDs()];
            $activity->suppliersCount = count($activity->getChildrenIDs()) ? count($this->commonObj->getAll("SupplierActivity",[],[],0,$whereIn)) : 0;
            $activity->makeHidden(['children']);
        });
        return jsonResponse('done', 200, $activities);
    }
    public function getActivityInfo(Request $request)
    {
        $activity = $this->commonObj->find("Activity",['id' => $request->id]);
        if($activity && $activity->code == 'other'){
            $activity->suppliersCount = count($activity->suppliers);
            $children =  $this->commonObj->getAll("SupplierActivity",['activity_id' => $activity->id]);
            $activity->children = $children->map(function($child){
                $child->parent_id = $child->activity_id;
                $child->name = $child->other;
                $child->code = 'otherChild';
                $child->product = 5;
                $child->show = $child->true;
                $child->suppliersCount = 1;
                $child->children = [];
                $child->makeHidden(['is_category', 'created_at', 'updated_at', 'supplier_id','activity_id','active','reason', 'status', 'reason', 'other']);
                return $child;
            }); 
        }
        if(!$activity) {
            return jsonResponse('not found', 404, []);
        }
        if($activity && $activity->code == 'other'){
            return $activity;
        }
        return getActivityChildren($activity->id);
    }



    # ====================================== #
    # =========== Delete Requests ========== #
    # ====================================== #
    public function deleteEmailTemplate(Request $request) {
        $conditions = ['id' => $request->template_id];
        $template = $this->commonObj->find('EmailTemplate', $conditions);
        if(!$template) {
            return jsonResponse('not found', 201, []);
        }
        if($template->deletable==true) {
            return jsonResponse('can\'t delete this template', 400, []);
        }
        $this->commonObj->destroy('EmailTemplate', $conditions);
        return jsonResponse('done', 201, []);
    }
    
        # Admin Users And Roles
    public function deleteAdmin(Request $request)
    {
        $conditions = ['id' => $request->admin_id];
        $admin = $this->commonObj->find('Admin', $conditions);
        if(!$admin) {
            return jsonResponse('not found', 201, []);
        }
        $this->commonObj->destroy('CommitteeMember', ['admin_id' => $request->admin_id]);
        $this->commonObj->destroy('Admin', $conditions);

        addLog('admin',$this->user->name.' deleted Admin '.$admin->nam);

        return jsonResponse('done', 201, []);
    }
    public function deleteRole(Request $request)
    {
        $conditions = ['id' => $request->role_id];
        $role = $this->commonObj->find('Role', $conditions);
        if(!$role) {
            return jsonResponse('not found', 201, []);
        }
        if($role->id == 1){
            return jsonResponse('Can\'t delete this role', 401, []);
        }

        $adminIDs = $this->commonObj->find('Admin', ['role_id' => $request->role_id]);
        if($adminIDs){
            return jsonResponse('Can\'t delete this role', 401, []);
        }
        // $this->commonObj->destroy('Admin', ['role_id' => $request->role_id]);
        // $this->commonObj->destroy('CommitteeMember', [], ['key'=>'admin_id', 'values'=>$adminIDs]);
        $this->commonObj->destroy('Role', $conditions);
        return jsonResponse('done', 201, []);
    }
        # Suppliers And Requests
    public function deleteSupplier(Request $request)
    {
        $conditions = ['supplier_id' => $request->supplier_id];
        $supplier = $this->commonObj->find('Supplier', ['id' => $request->supplier_id]);
        if(!$supplier) {
            return jsonResponse('not found', 201, []);
        }
        if($request->hard =='true'){
            $this->commonObj->destroy('SupplierActivity', $conditions);
            $this->commonObj->destroy('SupplierBank', $conditions);
            $this->commonObj->destroy('SupplierBranch', $conditions);
            $this->commonObj->destroy('SupplierDocument', $conditions);
            $this->commonObj->destroy('SupplierPhone', $conditions);
            $this->commonObj->destroy('CommitteeSupplier', $conditions);
            $this->commonObj->destroy('MeetingSupplier', $conditions);
            $this->commonObj->destroy('ListSupplier', $conditions);
    
            $this->commonObj->destroy('Supplier', ['id' => $request->supplier_id]);
        }
        else{
            $this->commonObj->destroy('Supplier', ['id' => $request->supplier_id]);

        }

        addLog('admin',$this->user->name.' deleted Supplier '.$supplier->username);

        return jsonResponse('done', 201, []);
    }

        # Committees And Meetings
    public function deleteCommittee(Request $request)
    {
        $code = 200;
        $message = 'done';
        try {
            $conditions = ['committee_id' => $request->committee_id];
            $committee = $this->commonObj->find('Committee', ['id' => $request->committee_id]);
            if(!$committee) {
                throw new \Exception('not found!');
            }
            $hasMeetings = $this->commonObj->getAll('Meeting', $conditions);
            if(count($hasMeetings)) {
                throw new \Exception('This committee has meetings!');
            }

            $this->commonObj->destroy('CommitteeSupplier', $conditions);
            $this->commonObj->destroy('CommitteeMember', $conditions);

            # Get Meetings and delete their Suppliers and Members as well
            $meetingsIds = $this->commonObj->getAll('Meeting', $conditions)->pluck('id')->toarray();
            $this->commonObj->destroy('MeetingSupplier' ,[], ['key' => 'meeting_id', 'values' => $meetingsIds]);
            $this->commonObj->destroy('MeetingMember' ,[], ['key' => 'meeting_id', 'values' => $meetingsIds]);
            $this->commonObj->destroy('Meeting', $conditions);

            $this->commonObj->destroy('Committee', ['id' => $request->committee_id]);

            addLog('admin',$this->user->name.' deleted Committee '.$committee->nam);

        } catch(\Exception $e) {
            $code = 500;
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, []);
    }
    public function deleteCommitteeMember(Request $request)
    {
        $conditions = [
            'id' => $request->id,
            'committee_id' => $request->committee_id,
        ];
        $committeeMember = $this->commonObj->find('CommitteeMember', $conditions);
        if(!$committeeMember) {
            return jsonResponse('not found', 404, []);
        }
        $this->commonObj->destroy('MeetingMember' ,['member_id' => $request->id]);

        $this->commonObj->destroy('CommitteeMember', $conditions);
        return jsonResponse('done', 201, []);
    }
    public function deleteMeeting(Request $request)
    {
        $conditions = ['meeting_id' => $request->meeting_id];

        $meeting = $this->commonObj->find('Meeting', ['id' => $request->meeting_id]);
        if(!$meeting) {
            return jsonResponse('not found', 404, []);
        }

        $this->commonObj->destroy('MeetingSupplier' ,$conditions);
        $this->commonObj->destroy('MeetingMember' ,$conditions);
        $this->commonObj->destroy('Meeting', ['id' => $request->meeting_id]);

        addLog('admin',$this->user->name.' deleted Meeting '.$meeting->topic);

        return jsonResponse('done', 201, []);
    }
        # Lists
    public function deleteList(Request $request)
    {
        $conditions = ['list_id' => $request->list_id];

        $list = $this->commonObj->find('SystemList', ['id' => $request->list_id]);
        if(!$list) {
            return jsonResponse('not found', 404, []);
        }
        if($list->id == 1 || $list->name === 'Black List') {
            return jsonResponse('Can\'t delete Black List', 400, []);
        }

        $this->commonObj->destroy('ListSupplier' ,$conditions);
        $this->commonObj->destroy('SystemList', ['id' => $request->list_id]);

        addLog('admin',$this->user->name.' Edited List '.$list->name);

        return jsonResponse('done', 201, []);
    }
    public function deleteListSupplier(Request $request)
    {
        $conditions = [
            'id' => $request->id,
            'list_id' => $request->list_id,
        ];
        $listSupplier = $this->commonObj->find('ListSupplier', $conditions);
        if(!$listSupplier) {
            return jsonResponse('not found', 404, []);
        }
        $this->commonObj->destroy('ListSupplier' ,['supplier_id' => $request->id]);
        return jsonResponse('done', 201, []);
    }
        # Activities
    public function deleteActivity(ActivityRequest $request)
    {
        $conditions = [
            'id' => $request->activity_id,
            'activity_id' => $request->activity_id,
        ];
        if($request->activity_id == 1){
            return jsonResponse('This Activity is built-in System, Can\'t be deleted.', 401, []);
        }
        $activity = $this->commonObj->find('Activity', ['id' => $request->activity_id]);
        if(!$activity) {
            return jsonResponse('not found', 404, []);
        }
        if($activity->code=="other"){
            return jsonResponse('you can\'t delete this, because it\'s built-in System activity', 401, []);
        }
        if(count($activity->suppliers)){
            return jsonResponse('you can\'t delete the activity because there are suppliers that have been registered for this activity', 401, []);
        }

        $childrenIDs = $activity->getChildrenIDs();
        $whereInIDs = ['key' => 'id', 'values' => $childrenIDs];
        $whereIn = ['key' => 'activity_id', 'values' => $childrenIDs];

        $this->commonObj->destroy('SupplierActivity' ,[], $whereIn);
        $this->commonObj->destroy('Activity' ,[],$whereInIDs);

        addLog('admin',$this->user->name.' Edited Activity '.$activity->name);


        return jsonResponse('done', 201, []);
    }




    # ====================================== #
    # =========== PUT Requests ============= #
    # ====================================== #
    public function editEmailTemplate(Request $request)
    {
        $message = 'done';
        $code = 201;
        $conditions = ['id' => $request->id];
        $data = $request->except(['id', 'documents']);
        try {
            $template = $this->commonObj->find('EmailTemplate', $conditions);
            if(!$template) {
                $code = 404;
                throw new \Exception('not found');
            }
            if($request->documents){
                $template->documents()->sync($request->documents);
            }
            $this->commonObj->update('EmailTemplate', $conditions, $data);
        } catch (\Exception $e) {
            $message = $e->getMessage() ;
        }
        return jsonResponse($message, $code, []);
    }
        # Admin Users And Roles
    public function editAdmin(AdminRequest $request) {
        $credentials = ['id' => $request->id];
        $data = $request->except(['_token','image','password_confirmation','sendEmail']);
        $admin = $this->commonObj->find('Admin', $credentials);
        if(!$admin) {
            return jsonResponse('not found', 404, []);
        }
        if(!empty($data['password'])){
            $data['password']= Hash::make($data['password']);
        }else unset($data["password"]);
        $this->commonObj->update('Admin', $credentials, $data);
        if($admin && $request->sendEmail) {
            $data['emailtemp'] =  \App\Models\EmailTemplate::find(2)->content;
            $from = env('MAIL_USERNAME');
            $data['password'] = $request->password;
            $data['url'] = \URL::to('/');
            Mail::send('mails.invitation', $data, function ($mail) use($data, $from) {
                $mail->from($from, 'Sumed');
                $mail->to($data['email'], 'Sumed')->subject('Sumed Invitiation');
            });
        }

        addLog('admin',$this->user->name.' Edited Admin '.$admin->name);

        $admin = $this->commonObj->find('Admin', $credentials);
        return jsonResponse('Created successfully', 201, $admin);
    }
        # Suppliers And Requests
   
        # Committees And Meetings
    public function editCommittee(CommitteeRequest $request)
    {
        $data = $request->only(['name', 'description']);
        $committee = $this->commonObj->find('Committee', ['id' => $request->id]);
        if(!$committee) {
            return jsonResponse('not found', 404, []);
        }
        $committee = $this->commonObj->update('Committee', ['id' => $request->id], $data);

        addLog('admin',$this->user->name.' Edited Committee '.$committee->name);

        return jsonResponse('Updated successfully', 201, $committee);
    }

    public function editMeeting(MeetingRequest $request) {
        $data = $request->only(['topic','start_time','end_time','date','editMeeting','description', 'status','description_header']);
        $meeting = $this->commonObj->find('Meeting', ['id' => $request->id]);
        $message= 'Updated Successfully';
        $dateNow = \Carbon\Carbon::today();
        $timeNow =\Carbon\Carbon::now('Africa/Cairo')->format('Hi').'00';
        if(!$meeting) {
            return jsonResponse('not found', 404, []);
        }
        if($dateNow->lessThanOrEqualTo($meeting->date) && (strcmp(str_replace(':', '', $meeting->end_time), $timeNow) > 0)){
            if($request->status){
                $message ='Can\'nt change meeting Status except after the meeting time passed';
                unset($data['status']);
                return jsonResponse($message, 400, $meeting);
            }
        }

        $meeting = $this->commonObj->update('Meeting', ['id' => $request->id], $data);
        addLog('admin',$this->user->name.' Edited Meeting '.$meeting->topic);
        return jsonResponse('Updated successfully', 201, $meeting);
    }
    
        # Lists
    public function editList(ListRequest $request)
    {
        $data = $request->only(['name', 'description']);
        $list = $this->commonObj->find('SystemList', ['id' => $request->id]);
        if(!$list) {
            return jsonResponse('not found', 404, []);
        }
        if($list->id == 1 || $list->name === 'Black List') {
            return jsonResponse('Can\'t edit Black List', 400, []);
        }
        $list = $this->commonObj->update('SystemList', ['id' => $request->id], $data);
        addLog('admin',$this->user->name.' Edited List '.$list->name);
        return jsonResponse('Updated successfully', 201, $list);
    }
        # Suppliers And Requests
    public function editSupplier(Request $request)
    {
        $code = 201;
        $message = 'Updated successfully.';
        try {
            $data['status'] = statusCode($request->status);
            $data['status_at'] = \Carbon\Carbon::now();
            $supplier = $changeRequest = $this->commonObj->find('Supplier', ['id' => $request->id]);
            if(!$changeRequest) {
                return jsonResponse('not found', 404, []);
            }
            if($request->id <= 0 || !in_array($request->status, ['filtered', 'approved', 'rejected','not submited', 'pending approval'])) {
                return jsonResponse('wrong data!', 400, []);
            }
            if($data["status"]==2 && $supplier->status==1){
                addLog('supplier',$this->user->name." Marked supplier ".$supplier->username." as revised", $supplier->id);
            }else if($data["status"]==0 && $supplier->status==1){
                $data['rejections'] = $supplier->rejections + 1;
                addLog('supplier',$this->user->name." Refused supplier ".$supplier->username." request & returned to registration with the message: ".$request->emailMsg, $supplier->id);
            }
            $changeRequest = $this->commonObj->update('Supplier', ['id' => $request->id], $data);
            addLog('admin',$this->user->name.' Edited Supplier '.$supplier->username);

            \App\Models\SupplierLogs::create([
                'supplier_id' =>$request->id,
                'status' => $request->status,
                'content' => 'Your account has been '.$request->status.' by <b>Arab Petroleum Pipelines Co. SUMED</b> information system'
            ]);
            if($request->emailMsg){
                \Mail::to($supplier->email)->send(new \App\Mail\RejectEmail(\URL::to('/'),$request->emailMsg),function($m){
                    $m->from('Sumed@info.com','Sumed');
                });
            }
        } catch (\Exception $e) {
            $code = 400;
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $changeRequest);
    }
        # Activities
    public function editActivity(ActivityRequest $request)
    {
        $data = $request->only(['name', 'code', 'parent_id']);
        $data['show'] = (int)$request->show;
        $data['product'] = (int)$request->product;
        $activity = $this->commonObj->find('Activity', ['id' => $request->id]);
        $childrenIDs = $activity->getChildrenIDs();

        if(!$activity) {
            return jsonResponse('not found', 404, []);
        }
        $activity = $this->commonObj->update('Activity', ['id' => $request->id], $data);
        addLog('admin',$this->user->name.' Edited Activity '.$activity->name);

        $this->commonObj->update('Activity', [], ['show' => (int)$request->show], ['key' => 'parent_id', 'values' => $childrenIDs]);
        return jsonResponse('Updated successfully', 201, $activity);
    }
    public function editOtherActivity(Request $request) {
        $data = $request->only(['other']);
        $activity = $this->commonObj->find('SupplierActivity', ['id' => $request->id]);
        if(!$activity) { return jsonResponse('not found', 404, []); }
        $activity = $this->commonObj->update('SupplierActivity', ['id' => $request->id], $data);
        addLog('admin',$this->user->name.' Edited Activity '.$activity->other);
        return jsonResponse('Updated successfully', 201, $activity);
    }

    public function changeActivityStatus(Request $request){
        $code = 201;
        $message = 'Updated successfully';
        try {
            $data = $request->activities;
            $data = $request->only(['activities', 'reasons', 'emailMsg', 'files']);
            $activity = $this->commonObj->updatestatus('SupplierActivity', ['supplier_id' => $request->supplier_id], $data);
            if(!$activity) {
                throw new \Exception('not found!');
            }
            
        } catch(\Exception $e) {
            $code = 500;
            $message = $e->getMessage() ;
            $activity = [];
        }
        return jsonResponse($message, $code, $activity);
    }

        # Authenticated Methods
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if(!$token = Auth::guard('admin_api')->attempt($credentials)) {
            return jsonResponse('Credentials error!', 401, []);
        }
        $user = Auth::guard('admin_api')->user();

        addLog('admin',$user->name.' Logged in Admin Panel');

        $user['access_token'] = $token;
        return jsonResponse('done.', 200, $user);
    }

    // NEED TO EDIT EMAIL CONTENTS AND LOGO IMAGE
    public function editSupplierActivity(Request $request)
    {
        $code = 201;
        $message = 'done!';
        $supplierID = $request->supplier_id;
        try {
            if(! $supplier = $this->commonObj->find('Supplier',['id' => $supplierID])) {
                $code = 404;
                throw new \Exception('supplier not found');
            }
            $request->validate([
                'description' => '',
                'activities' => 'required|array',
                'files_ids' => 'required|array',
            ]);
            foreach($request->activities as $activity) {
                $this->commonObj->update('SupplierActivity',['supplier_id' => $supplierID, 'activity_id' => $activity['activity_id']],['active' => (int)$activity['active']]);
            }

            $files = $this->commonObj->getAll('SystemDocument',[],[],0,['key' => 'id', 'values'=>$request->files_ids])->pluck('name')->toArray();

            $data['username'] = $supplier->username;
            $data['content'] = $request->description;
            $data['email'] = 'tarek@pencil-designs.com';
            //$data['email'] = $supplier->email;
            $data['url'] = \URL::to('/');
            
            $from = env('MAIL_USERNAME');
            Mail::send('Admin.mails.template', $data, function ($mail) use($data, $from, $files) {
                $mail->from($from, 'Sumed');
                $mail->to($data['email'], 'Sumed')->subject('Sumed Invitiation');
                foreach($files as $file) {
                    $path = $data['url'].'/documents/'.$file;
                    //if(file_exists($path))
                        $mail->attach($path);
                }
            });


        } catch(\Exception $e) {
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, []);
    }

    public function InviteSupplier(SupplierRequest $request){
        $data = $request->only(['username', 'company_name', 'email', 'password', 'business_type','for_company', 'national', 'type', 'phone']);
        $data['invited'] = 1;
        $data['status'] = 3;
        $data['confirmed_at'] = \Carbon\Carbon::now();
        $data['password'] = Hash::make($data['password']);
        $code = 201;
        $message = 'done!';
        try{
            $data = $this->commonObj->create('Supplier' , $data);
            \Mail::to($data->email)->send(new InvitationEmail($data->username,\URL::to('/'), $request->password),function($m){
                $m->from('Sumed@info.com','Sumed');
            });
        }
        catch(\Exception $e) {
            $message = $e->getMessage();
            $data = [];
        }
        return jsonResponse($message, $code, $data);

    }

    public function getExpiration(){
        $code = 201;
        $message = 'done!';
        try{
            $date = \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d');
            $documents = \App\Models\SupplierDocument::whereDate('expire_date', '=' , $date)->get();
            $data = $documents->map(function($document){
                $document->supplierName = $document->supplier->company_name;
                $document->documentName = $document->document->name;
                $document->documentNamear = $document->document->name_ar;
                $document->makeHidden(['supplier','country_id','created_at','updated_at', 'supplier_id', 'document_id', 'document']);
                return $document;
            });
        }
        catch(\Exception $e) {
            $message = $e->getMessage();
            $data = [];
        }
        return jsonResponse($message, $code, $data);
    }
    

    public function me(Request $request)
    {
        $user = Auth::guard('admin_api')->user();
        if($user->role) {
            $user->roleName = $user->role->name;
            $user->roleFunctions = $this->roles;
            $user->requestsCount = count($this->commonObj->getAll("Supplier" ,['status'=>1]));
        }
        // dd($user->roleFunctions);
        $user->makeHidden(['role']);
        return jsonResponse('done.', 200, $user);
    }
    public function logout(Request $request)
    {
        addLog('admin',$this->user->name.' Logged out from Admin Panel');
        Auth::guard('admin_api')->logout();
        return jsonResponse('successfully logged out.', 200);
    }

    public function editSupplierData(Request $request){
        $code = 201;
        $message = 'done!';
        $supplierID = $request->supplier_id;
        try {
            if(! $supplier = $this->commonObj->find('Supplier',['id' => $supplierID])) {
                $code = 404;
                throw new \Exception('supplier not found');
            }
            Auth::guard('supplier')->loginUsingId($supplierID->id);

        } catch(\Exception $e) {
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, []);
    }
    public function AdminLogs(Request $request){
        $code = 201;
        $message = 'done!';
        $data =[];
        try {
            $logs = $this->commonObj->getAll('Logs',['type' => 'admin']);
            $data = $logs->map(function($log){
                $log->creationDate = date('M dS, Y',strtotime($log->created_at));
                $log->makeHidden(['id','file','path' ,'type', 'col', 'olddata', 'newdata','created_at','updated_at','supplier_id']);
                return $log;
            });
        } catch(\Exception $e) {
            $message = $e->getMessage();
        }
        return jsonResponse($message, $code, $data);
    }

    public function addNames(Request $request){
        $code = 201;
        $message = 'done!';
        $data =[];
        try {
            $data = $request->only(['name', 'value']);
            $manager = $this->commonObj->create('Manager',$data);
            $data = $manager;
        } catch(\Exception $e) {
            $message = $e->getMessage();
            $code = 400;
        }
        return jsonResponse($message, $code, $data);
    }



}
