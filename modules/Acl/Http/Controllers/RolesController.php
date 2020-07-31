<?php
namespace Modules\Acl\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Acl\Entities\Role;
use Modules\Acl\Entities\Permission;

use Illuminate\Http\Request;
use App\Http\Requests;

class RolesController extends Controller {

    protected $role;

    public function __construct(Role $role)
    {
      $this->role =  $role;
    }

    public function index()
    {
        $data['roles'] = $this->role->all();
        return view('acl::roles.index', $data);
    }

    public function create()
    {
        $data['permissions'] = Permission::get(['name','id', 'slug']);
        return view('acl::roles.create', $data);
    }

    public function store(Request $request)
    {
        $this->role         =  new $this->role;
        $this->role->fill($request->except(['permissions', '_method','_token']));
        $this->role->save();

        if($request->has('permissions')) {
          $permissions = $request->permissions;
          $this->role->permissions()->sync($permissions);
        }

        flash()->success('New Role '.$this->role->name.' has been created successfully.');

        return redirect()->route('acl.roles.index');
    }

    public function edit($id)
    {
        $data['role'] = $this->role->find($id);
        $data['permissions'] = Permission::get(['name','id', 'slug']);
        return view('acl::roles.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->role         =  $this->role->find($id);
        $this->role->fill($request->except(['permissions', '_method','_token']));
        $this->role->save();

        if($request->has('permissions')) {
          $permissions = $request->permissions;
          $this->role->permissions()->sync($permissions);
        }

        flash()->success('Role '. $this->role->name.' has been updated with setting the Permissions.');

        return redirect()->route('acl.roles.index');
    }

    public function destroy($id)
    {
        $role = $this->role->find($id);
        $roleName = $role->name;
        $role->delete();

        flash()->success('Role '. $roleName.' has been deleted successfully.');

        return redirect()->route('acl.roles.index');
    }

}
