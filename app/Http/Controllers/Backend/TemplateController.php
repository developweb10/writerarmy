<?php

namespace App\Http\Controllers\Backend;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;


class TemplateController extends Controller
{
   
      protected $templates;

    public function __construct(EmailTemplate $templates)
    {
    	 $this->middleware('auth');
        $this->templates = $templates;
    }
    public function index() {
		 $data['templates'] = EmailTemplate::all();			     
         return view('dashboard.emailtemplates.index', $data);
    }
	public function edit($id){		
		 $data['template'] = EmailTemplate::find($id); 		
        return view('dashboard.emailtemplates.edit', $data);
	}
	public function update(Request $request){	  
		  if(!empty($request->id)){
			  $emailtempalte =EmailTemplate::find($request->id);			 			 
			  $emailtempalte->subject = $request->subject;
			  $emailtempalte->text = $request->text;				  
			  $emailtempalte->save();
		      flash()->success('Updated Successfully');		
		  }
		return Redirect::back();
	}
  
}