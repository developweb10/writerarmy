<?php
namespace Modules\Acl\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Pingpong\Modules\Routing\Controller;
use Modules\Acl\Entities\User;
use Modules\Acl\Entities\Role;

use Illuminate\Http\Request;
use App\Http\Requests;
class AclController extends Controller {

    public function index()
    {
        $data['users'] = User::with('roles')->get();
        return view('acl::index', $data);
    }

    public function assignRoles($userId)
    {
        $data['user'] = User::with('roles')->find($userId);
        $data['roles'] = Role::get(['id', 'name', 'slug']);
        return view('acl::roles.assign-user', $data);
    }

    public function store(Request $request, $userId)
    {
        $user = User::find($userId);

        if($request->has('roles')) {
          $roles = $request->roles;
          $user->roles()->sync($roles);
        }

        flash()->success('Successfully assigned role to the User : '. $user->name);

        return redirect('acl');
    }

    public function createUser() {

        $data['users'] = User::orderBy('id', 'asc')->get();

        return view('acl::user.create', $data);
    }

    public function storeUser(Request $request)
    {
        $users = New User();

        $users->name = $request->name;
        $users->email = $request->email;
        $users->company_name = empty(!$request->company_name) ? $request->company_name : null;
        $users->phone = empty(!$request->phone) ? $request->phone : null;
        $users->password = bcrypt($request->password);
        $users->confirmation_code = md5(uniqid(mt_rand(), true));
//        $users->confirmed = config('project_settings.users.confirm_email') ? 0 : 1;
        $users->confirmed = 1;

        $users->save();


        flash()->success('Profile Created Successfully.');

        return redirect('acl');
    }


    public function usersList() {

        $data['users'] = User::orderBy('id', 'asc')->get();

        return view('acl::user.users_list', $data);
    }

    public function editUser($id)
    {
        $data['users']= User::select('id','name','email','company_name','phone','password','confirmation_code','confirmed')
            ->get();

        $data['editUsers'] = User::find($id);

        if ('users-edit') {
            $data['editActions'] = User::select('id','name','email','company_name','phone','password','confirmation_code','confirmed')
                ->findOrFail($id);
        }


        return view('acl::user.edit', $data);
    }


    public function updateUser($id)
    {
        $data['users']= User::select('id','name','email','company_name','phone','password','confirmation_code','confirmed')
            ->get();

        $editUsers = User::findOrFail($id);

        $editUsers->name = Input::get('name');
        $editUsers->email = Input::get('email');
        $editUsers->company_name = empty(! Input::get('company_name')) ? Input::get('company_name') : null;
        $editUsers->phone = empty(! Input::get('phone')) ? Input::get('phone') : null;
        $editUsers->password = bcrypt(Input::get('password'));
        $editUsers->confirmation_code = md5(uniqid(mt_rand(), true));
        $editUsers->confirmed = 1;

        $editUsers->save();


        flash()->success('User profile has been updated.');

        return redirect('acl/user/list');
    }


    public function deleteUser($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return;
    }
}
