<?php

namespace App\Listeners;

use Mail;
use App\User;
use App\Events\UserSignup;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;

class SendConfirmationLink
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserSignup  $event
     * @return void
     */
    public function handle(UserSignup $event)
    {
        $this->sendConfirmationEmail($event->user);
        // $event->user;
    }

    public function sendConfirmationEmail($user) {
        //$user can be user instance or id
        if (! $user instanceof User)
            $user = User::findOrFail($user);
			
			$confirm =EmailTemplate::find(1);
			$subjectmessage = $confirm->subject;	
			$emailmessage = $confirm->text;
			$url = url('register/verify/' . $user->confirmation_code);
			$emailmessage = str_replace('{{token}}',$url, $emailmessage);
			
			$data = array('user'=>$user, 'subject'=>$subjectmessage);	
		

        return Mail::send('auth.emails.confirm', ['token' => $user->confirmation_code, 'emailmessage'=> $emailmessage], function($message) use ($data)
        {
            $message->to($data['user']->email, $data['user']->name)->subject($data['subject']); 
        });
		
    }

}
