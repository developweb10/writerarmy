<?php

namespace App\Http\Controllers\Backend;

use App\Models\Package;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;


class PackagesController extends Controller
{
    protected $package;

    public function __construct(Package $package)
    {
        $this->package = $package;
        $this->middleware('auth');
    }

    public function index() {
        $data['packages'] = $this->package->all();
        return view('dashboard.package.index', $data);
    }
	
	public function listPackage(){
		  $data['packages'] = $this->package->all();
		
        return view('dashboard.package.list', $data);
	}
	
	 public function deletePackage($id) {
	      $getpackage= Package::findOrFail($id);
		 // print_r($getpackage);
           $getpackage->delete();
		     flash()->success('Deleted Successfully');
           return Redirect::back();
	}
	
	public function addPackage(){	
	   
		  return view('dashboard.package.add');
	}
	
	public function editPackage($id){
		   $data['package'] = $this->package->find($id);
		 //  print_r($data);
		  return view('dashboard.package.editService', $data);
	    	
	}
	
	public function postAddPackage(Request $request){	 
	      
		  if(!empty($request->id)){		  	
			  $Package =Package::find($request->id);
			  $Package->title = $request->title;				 
			  $Package->price = $request->price;
			  $Package->description = $request->description;
			  $Package->content = $request->description;
			  $Package->type = $request->type;
			  $Package->icon = $request->icon;
			  $Package->word_selection =$request->word_selection;			 
			   if (Input::hasFile('attachment'))
                {
                    $file = Input::file('attachment');
                    $filename = $file->getClientOriginalName();
                    $destinationPath = 'uploads/orders/attachment/';

                  $Package->image_path  = Input::file('attachment')->move($destinationPath, $filename);
                }		  
	
			  $Package->save();
		      flash()->success('Updated Successfully');		
		
			  
		  }else{
			  $Package = New Package();
			  $title = $request->title;
			  $slug = strtolower($title);
			  $slug = str_replace(' ', '-', $slug);		
			   
			  $packagess = Package::where('slug', '==', $slug)->get();	
			  if(!empty($packagess)){
				   $slug = $slug.rand(1, 1000000);
			   }
			  
			  $Package->title = $title;
			  $Package->slug = $slug;
			  $Package->price = $request->price;
			  $Package->description = $request->description;
			  $Package->content = $request->description;
			  $Package->type = $request->type;
			  $Package->icon = $request->icon;
			  $Package->word_selection =$request->word_selection;
			   if (Input::hasFile('attachment'))
                {
                    $file = Input::file('attachment');
                    $filename = $file->getClientOriginalName();
                    $destinationPath = 'uploads/orders/attachment/';

                  $Package->image_path  = Input::file('attachment')->move($destinationPath, $filename);
                }		  
	
		   $Package->save();
		  
		  flash()->success('Added Successfully');
		  }

         return Redirect::back();
		 
              
	}

    public function edit($id) {
        $data['package'] = $this->package->find($id);
        return view('dashboard.package.edit', $data);
    }

    public function update(Request $request, $id) {

        $package =  $this->package->find($id);

        $package->word_selection = json_encode($request->word_selection);
        $package->additional_fields = json_encode($request->additional_fields);

        $package->save();


        flash()->success('Edited Successfully');

        return redirect('package');
    }
}
