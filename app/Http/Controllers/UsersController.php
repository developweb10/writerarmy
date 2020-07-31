<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Skill;
use App\Models\UserProfile;
use App\Models\WriterDetail;
use Auth;
use Illuminate\Support\Facades\Input;
use Image;
use File;
use Validator;
use DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function __construct()
    {       
        $this->middleware('auth');
    }

    public function profile($id = null)
    {
        if(isset($id) && $id != null) {
            $data['user'] = User::find($id);
        } else {
            $data['user'] = Auth::user();
        }
        return view('dashboard.user.profile.view', $data);
    }

    public function edit($id=null)
    {
        if(isset($id) && $id != null) {
            $data['user'] = User::find($id);
        } else {
            $data['user'] = Auth::user();
        }
        $data['skills'] = Skill::lists('name', 'id')->toArray();

        $writer_id = $data['user']->id;
        $getWriter =  DB::table('writer_details')->where('writer_id', $writer_id)->get();

        $data['getWriter'] = $getWriter;       

        return view('dashboard.user.profile.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // validation comes first
        if($request->hasFile('photo')) {
            $validatePhoto = Validator::make(
                                        ['photo' => $request->file('photo')],
                                        ['photo' => 'image|max: 512']
                                    );
            if($validatePhoto->fails()) {
                return redirect()->back()->withInput()->withErrors($validatePhoto);
            }
        }

        // update user table
        $user = User::find($id);

        $user->name = $request->name;
        $user->company_name = $request->company_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        // if user profile exists, then update it
        $profile = UserProfile::where('user_id', $user->id)->first();

        if(!$profile) {
                // otherwise create user profile
                $profile               = new UserProfile;
                $profile->user_id      = $user->id;
        }

        $profile->alternate_email       = $request->alternate_email;
        $profile->date_of_birth         = date('Y-m-d', strtotime($request->date_of_birth));
        $profile->occupation            = $request->occupation;
        $profile->gender                = $request->gender;
        $profile->address               = $request->address;
        $profile->about                 = $request->about;
        $profile->website               = $request->website;

        if($request->hasFile('photo')) {
            $fileName                   = $this->photoUpload($request);

            if ($profile && $profile->photo != null) {
                $destinationPath    = public_path().user_photo_path();
                File::delete($destinationPath . $profile->photo);
            }
            $profile->photo = $fileName;
        }

        $profile->save();

        if($request->skills)
        {
            $user->skills()->sync(array_values($request->skills));
        }

        if(isset($request->paypal_email)){
             $getWriter =  DB::table('writer_details')->where('writer_id', $id)->get();
            if(empty($getWriter)){
               $writer = New WriterDetail();
               $writer->paypal_email = $request->paypal_email;
               $writer->writer_id = $id;                        
               $writer->save();
            }else{
                $writerid = $getWriter[0]->id;
               $writer = WriterDetail::find($writerid);
               $writer->paypal_email = $request->paypal_email;                                      
               $writer->save();
            }
        }
        flash()->success('Your profile has been updated.');

        return redirect()->to('profile');
    }

    protected function photoUpload($request)
    {
        $destinationPath    = public_path().user_photo_path(); // upload path
        $extension          = $request->file('photo')->getClientOriginalExtension(); // getting image extension
        $fileName           = sha1(time()).'-'.str_slug($request->name).'.'.$extension; // renameing image
        $image              = Image::make($request->file('photo'));
        // dd($image);

        File::exists($destinationPath) or File::makeDirectory($destinationPath);
        $image->resize(300, 200)->save($destinationPath . $fileName);

        return $fileName;
    }



    public function changeUserPassword($id)
    {
        $data['users']= User::select('id','password')
            ->get();

        $data['editUserPassword'] = User::find($id);

        if ('userPassword-edit') {
            $data['editUserPassword'] = User::select('id','password')
                ->findOrFail($id);
        }


        return view('dashboard.user.profile.change_password', $data);
    }


    public function updateUserPassword($id)
    {
        $data['users']= User::select('id','password')
            ->get();

        $editUsers = User::findOrFail($id);

        $editUsers->password = bcrypt(Input::get('password'));

        $editUsers->save();


        flash()->success('User profile has been updated.');

        return redirect()->to('profile');
    }
	
	public function allWriters(){
		$writers = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')   
			->where('role_user.role_id', '3')         
            ->select('users.*')
            ->paginate(12);
	    $data['writers'] = $writers;
		return view('dashboard.user.allwriters', $data);
			
	}
	public function allUsers(){
		$writers = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')   
			->where('role_user.role_id', '2')         
            ->select('users.*')
            ->paginate(12);
	    $data['writers'] = $writers;
		return view('dashboard.user.allusers', $data);
			
	}
	public function updateWriter(Request $request){
	    $user = User::find($request->id);
		$user->status = $request->status;
        if($user->save()){
		  flash()->success('Updated Successfully');	
		}
		else{
			 flash()->success('Try Again');	
		}		

        return Redirect::back();
	}
	
	public function editWriter($id){
	   $user = User::find($id);
	   $data['user'] = $user;
	   return view('dashboard.user.editwriter', $data);
	}
}

