<?php
namespace Modules\Acl\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Acl\Entities\Permission;

use Illuminate\Http\Request;
use App\Http\Requests;

class PermissionsController extends Controller {

  protected $permission;

  public function __construct(Permission $permission)
  {
    $this->permission =  $permission;
  }

	public function index()
	{
			$data['permissions'] = $this->permission->paginate(10);
			return view('acl::permissions.index', $data);
	}

	public function create()
	{
			return view('acl::permissions.create');
	}

	public function store(Request $request)
	{
			$this->permission         =  new $this->permission;
			$this->permission->fill($request->except(['_method','_token']));
			$this->permission->save();

			flash()->success('New Permission '.$this->permission->name.' has been created successfully.');

			return redirect()->route('acl.permissions.index');
	}

	public function edit($id)
	{
		$data['permission'] = $this->permission->find($id);
		return view('acl::permissions.create', $data);
	}

	public function update(Request $request, $id)
	{
			$this->permission         =  $this->permission->find($id);
			$this->permission->fill($request->except(['_method','_token']));
			$this->permission->save();

			flash()->success('Permission '. $this->permission->name.' has been updated.');

			return redirect()->route('acl.permissions.index');
	}

	public function destroy($id)
	{
			$permission = $this->permission->find($id);
			$permissionName = $permission->name;
			$permission->delete();

			flash()->success('Permission '. $permissionName.' has been deleted successfully.');

			return redirect()->route('acl.permissions.index');
	}

}
