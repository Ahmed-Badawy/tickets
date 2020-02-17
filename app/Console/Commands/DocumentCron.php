<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DocumentCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d');
        $documents = \App\Models\SupplierDocument::whereDate('expire_date', '=' , $date)->get();
        foreach($documents as $key => $document){
            \App\Models\SupplierLogs::create([
                'supplier_id' =>$document->supplier_id,
                'status' => 'date',
                'content' => 'Your <b>'. $document->document->name.'</b></br> is going to get expired in two weeks, </br>please make sure to replace it with a valid one.'
            ]);
        }
        $groups = $documents->groupBy('supplier_id');
        $sent = [];
        foreach($groups as $key => $value){
            foreach($value as $doc){
                $supplier = \App\Models\Supplier::find($key);
                if(! isset($sent[$doc->document_id])){
                    $message = '<h3>'.$doc->document->name .'</h3> <p style="padding: 2rem;">This document will expire after two weeks please provide new documents to avoid freezing your account </p>.';
                    \Mail::to($supplier->email)->send(new \App\Mail\ExpirationEmail(\URL::to('/'), $message),function($m){
                        $m->from('Sumed@info.com','Sumed');
                    });
                    $sent[$doc->document_id] = "sent";
                }
            }
        }
        $documents = \App\Models\SupplierDocument::whereDate('expire_date', '=' , \Carbon\Carbon::now()->format('Y-m-d'))->get();
        $sent = [];
        foreach($groups as $key => $value){
            foreach($value as $doc){
                $supplier = \App\Models\Supplier::find($key);
                if(! isset($sent[$doc->document_id])){
                    $message = '<h3>'.$doc->document->name .'</h3> <p style="padding: 2rem;">This document expired ,your account will be freezed untill upload new documnet . </p>';
                    \Mail::to($supplier->email)->send(new \App\Mail\ExpirationEmail(\URL::to('/'), $message),function($m){
                        $m->from('Sumed@info.com','Sumed');
                    });
                    $sent[$doc->document_id] = "sent";
                }
            }
        }
        addLog('admin','test');
        $suppliersweek = \App\Models\Supplier::where('status' , 0)->where('created_at', '=', \Carbon\Carbon::now()->subDays(7)->format('Y-m-d'))->get();
        $supplierstwoweek = \App\Models\Supplier::where('status' , 0)->where('created_at', '=', \Carbon\Carbon::now()->subDays(14)->format('Y-m-d'))->get();
        $suppliersdeleted = \App\Models\Supplier::where('status' , 0)->where('created_at', '=', \Carbon\Carbon::now()->subDays(15)->format('Y-m-d'))->get();
        foreach($suppliersweek as $supplier){
            $message = \App\Models\EmailTemplate::find(6)->contect ?? 'Kindly, be informed that you still have 8 days to complete your registration.';
            \Mail::to($supplier->email)->send(new \App\Mail\ExpirationEmail(\URL::to('/'), $message),function($m){
                $m->from('Sumed@info.com','Sumed');
            });
        }
        foreach($supplierstwoweek as $supplier){
            $message = \App\Models\EmailTemplate::find(7)->contect ?? 'Kindly, be informed that you must complete your registration within a day from now so that your account won\'t be deleted.';
            \Mail::to($supplier->email)->send(new \App\Mail\ExpirationEmail(\URL::to('/'), $message),function($m){
                $m->from('Sumed@info.com','Sumed');
            });
        }
        foreach($suppliersdeleted as $supplier){
            $message = \App\Models\EmailTemplate::find(8)->contect ?? 'Kindly, be informed that your account had been deleted. You can start registration process again from the beginning. ';
            \Mail::to($supplier->email)->send(new \App\Mail\ExpirationEmail(\URL::to('/'), $message),function($m){
                $m->from('Sumed@info.com','Sumed');
            });
        }
        $supplier = \App\Models\Supplier::where('status' , 0)->where('created_at', '=', \Carbon\Carbon::now()->subDays(15)->format('Y-m-d'))->delete();

    }
}
