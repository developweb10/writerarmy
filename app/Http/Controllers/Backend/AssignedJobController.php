<?php

namespace App\Http\Controllers\Backend;

use App\Models\Message;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\UserProfile;
use App\Models\Rating;
use App\User;
use App\Models\EmailTemplate;
use App\Models\Package;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use Mail;


class AssignedJobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {

        $data['job_details'] = OrderStatus::where('writer_id', Auth::id())->where('status_type', '!=', 'unassigned')->get();

        return view('dashboard.jobs.job_details', $data);
    }


    public function client_view() {

        $data['job_details'] = OrderStatus::where('client_id', Auth::id())->where('status_type', '!=', 'unassigned')->get();

        $data['jobs'] = Order::where('order_placed_by', Auth::id())
            ->where('confirmation_status', 0)
            ->get();

        return view('dashboard.jobs.for_client.job_details', $data);
    }

    public function edit($id) {

        $data['job_details'] = OrderStatus::find($id);
	   	$order_id =  $data['job_details']->order_id;		 
        $data['message_info'] = Message::where('order_id', $order_id)->where('status', '1')->orderBy('id', 'asc')->get();		
		
		$data['order_details'] = Order::find($order_id);      
   // print_r($data); 
		
        return view('dashboard.jobs.job_details_show', $data);
    }



    public function updateReview(Request $request){
        $client_id = $request->clientId;
        $writterId = $request->writterId;
        $orderId = $request->orderId;
        $rating = $request->rating;  
        $getReview =  DB::table('writer_rating')->where('client_id', $client_id)->where('writer_id', $writterId)->where('order_id', $orderId)->get();
      
        if(empty($getReview)){
             $reviews = New Rating();
             $reviews->client_id = $client_id;
             $reviews->writer_id = $writterId;
             $reviews->order_id = $orderId;
             $reviews->rating = $rating;             
             $reviews->save();
             flash()->success('Your rating submitted');
       }
      else{
          $id = $getReview[0]->id; 
          $reviews = Rating::find($id);
          $reviews->rating = $rating;             
          $reviews->save();
           flash()->success('Updated Successfully');    
       }
         return Redirect::back();
    }



   public function updateChat(Request $request){      
       // print_r($_POST);
       //die('in');
        $order = Order::find($request->order_id);
       // print_r($order);


        $Package =Package::find($order->package_id); 
        $fromuser = User::find($request->from_user);                 
       $touser = User::find($request->to_user);

         if($request->body != ''){
            $messages = New Message();

            $messages->order_id = $request->order_id;
            $messages->status_type = $request->status_type;
            $messages->from_user = $request->from_user;
            $messages->to_user = $request->to_user;
            $messages->body = $request->body;
            $messages->status = 1;
            if($request->attachment)
            {
                $file = Input::file('attachment');
                $filename = $file->getClientOriginalName();
                $destinationPath = 'uploads/jobs/attachment/';
                $messages->attachment = Input::file('attachment')->move($destinationPath, $filename);
        
        // for send email
           }              
          
        /*            
           // from user
          $confirm =EmailTemplate::find(7);
          $subjectmessage = $confirm->subject;  
          $emailmessage = $confirm->text;
          $emailmessage = str_replace('{{packagetitle}}',$Package->title, $emailmessage);   
          
          
          $data = array('user'=>$fromuser, 'subject'=>$subjectmessage); 
          
           Mail::send('auth.emails.notifications', ['emailmessage'=> $emailmessage], function($message) use ($data)
          {
             $message->to($data['user']->email, $data['user']->name)->subject($data['subject']); 
          });
          
          // to user    
          $confirm =EmailTemplate::find(6);
          $subjectmessage = $confirm->subject;  
          $emailmessage = $confirm->text.'<p>'.$fromuser->name.' sent message to '.$touser->name.'</p><p>Message:'.$request->body.'</p>';
          $emailmessage = str_replace('{{packagetitle}}',$Package->title, $emailmessage); 
          $data = array('user'=>$touser, 'subject'=>$subjectmessage);                 
           Mail::send('auth.emails.notifications', ['emailmessage'=> $emailmessage], function($message) use ($data)
          {       
            $message->to($data['user']->email, $data['user']->name)->subject($data['subject']); 
          });
        */
        
           
       // to admin                     
           
         $subjectmessage = 'Chat notitfications';    
         $emailmessage = '<p>'.$fromuser->name.' sent message to '.$touser->name.'</p><p>Message:'.$request->body.'</p>';
         
        $data = array('user'=>'admin@writerarmy.com', 'name' =>'admin', 'subject'=>$subjectmessage);           
         Mail::send('auth.emails.notifications', ['emailmessage'=> $emailmessage], function($message) use ($data)
        {
            $message->to($data['user'], $data['name'])->subject($data['subject']); 
        });
        
            $messages->save();
        }

        flash()->success('Message sent successfully');

        return Redirect::back();

   }


    public function update(Request $request, $id) {
        $job_details = OrderStatus::find($id);
        $job_details->description = $request->description;
        $job_details->status_type = $request->status_type;
        if($request->status_type == 'unassigned'){
            $job_details->writer_id = '';
        }
        $job_details->save();
        $order = Order::find($request->order_id);       
        if($request->status_type == 'unassigned'){           
            $order->confirmation_status = 0;
            $order->save();
        }

       
		    /*  $Package =Package::find($order->package_id); 
		    $fromuser = User::find($request->from_user);                 
         $touser = User::find($request->to_user);

        if($request->body != ''){
            $messages = New Message();

            $messages->order_id = $request->order_id;
            $messages->status_type = $request->status_type;
            $messages->from_user = $request->from_user;
            $messages->to_user = $request->to_user;
            $messages->body = $request->body;
		      	$messages->status = 1;
            if($request->attachment)
            {
                $file = Input::file('attachment');
                $filename = $file->getClientOriginalName();
                $destinationPath = 'uploads/jobs/attachment/';
                $messages->attachment = Input::file('attachment')->move($destinationPath, $filename);
				
				// for send email
			     }							
					
										
				   // from user
					$confirm =EmailTemplate::find(7);
					$subjectmessage = $confirm->subject;	
					$emailmessage = $confirm->text;
					$emailmessage = str_replace('{{packagetitle}}',$Package->title, $emailmessage);		
					
					
					$data = array('user'=>$fromuser, 'subject'=>$subjectmessage);	
					
					 Mail::send('auth.emails.order', ['emailmessage'=> $emailmessage], function($message) use ($data)
					{
					   $message->to($data['user']->email, $data['user']->name)->subject($data['subject']); 
					});
					
					// to user		
					$confirm =EmailTemplate::find(6);
					$subjectmessage = $confirm->subject;	
					$emailmessage = $confirm->text.'<p>'.$fromuser->name.' sent message to '.$touser->name.'</p><p>Message:'.$request->body.'</p>';
					$emailmessage = str_replace('{{packagetitle}}',$Package->title, $emailmessage);	
					$data = array('user'=>$touser, 'subject'=>$subjectmessage);	   							
					 Mail::send('auth.emails.order', ['emailmessage'=> $emailmessage], function($message) use ($data)
					{				
						$message->to($data['user']->email, $data['user']->name)->subject($data['subject']); 
					});
				
				
           
			 // to admin                     
           
           $subjectmessage = 'Chat notitfications';    
           $emailmessage = '<p>'.$fromuser->name.' sent message to '.$touser->name.'</p><p>Message:'.$request->body.'</p>';
         
        $data = array('user'=>'admin@writerarmy.com', 'name' =>'admin', 'subject'=>$subjectmessage);           
         Mail::send('auth.emails.notifications', ['emailmessage'=> $emailmessage], function($message) use ($data)
        {
            $message->to($data['user'], $data['name'])->subject($data['subject']); 
        });
        
            $messages->save();
        } */

        flash()->success('Updated Successfully');

        return Redirect::back();
    }


    public function assignedJobSearch()
    {
        $query = OrderStatus::with('order');

        if(Input::has('status')) {
            $query->where('status_type', Input::get('status'));
        }


        $data['job_details'] = $query->select('id','order_id','client_id','writer_id','status_type','submission_date')
            ->where('writer_id', Auth::id())->get();


        return view('dashboard.jobs.job_details', $data);
    }


    public function assignedOrderSearch()
    {
        $query = OrderStatus::with('order');

        if(Input::has('status')) {
            $query->where('status_type', Input::get('status'));
        }


        $data['job_details'] = $query->select('id','order_id','client_id','writer_id','status_type','submission_date')
                                     ->where('client_id', Auth::id())
                                     ->get();


        return view('dashboard.jobs.for_client.job_details', $data);
    }


    public function destroyAssignedJob($id) {
		//echo $id;
       //  die('here');
	   
		
        $order_status = OrderStatus::findOrFail($id);
        $order_status->delete();
        return redirect('allJobs');
       // return;
    }
	
	public function allmessages(){
		
		   $data['message_info'] = Message::orderBy('id', 'asc')->paginate(12);
		   return view('dashboard.jobs.allmessages', $data);
	}
	
	public function editMessage($id){
	    $getmessagedetails = Message::find($id);
		$data['message'] = $getmessagedetails;
		return view('dashboard.jobs.editmessage', $data);
	}
	
	public function updatemessage(Request $request){
	 	$id = $request->id; 	  
	    $Message = Message::find($id);
		$Message->status = $request->status; 
		if($Message->save()){
		  flash()->success('Updated Successfully');	
		}
		else{
			 flash()->success('Try Again');	
		}		

        return Redirect::back();
		
	}


}
