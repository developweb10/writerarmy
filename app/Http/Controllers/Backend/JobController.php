<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\UserProfile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
     public function __construct()
    {       
        $this->middleware('auth');
    }

    public function index()
    {
		if ( ! Auth::check()) {
            return redirect('login');
        }
        $data['jobs'] = Order::where('confirmation_status', 0)->get();

        return view('dashboard.jobs.index', $data);
    }

    public function edit($id) {

        $data['job'] = Order::find($id);

        return view('dashboard.jobs.edit', $data);
    }

    public function update(Request $request, $id) {

        $job_status =  New OrderStatus;

        $job_status->order_id = $request->order_id;
        $job_status->writer_id = Auth::id();
        $job_status->client_id = $request->order_placed_by;
        $job_status->status_type = 'Assigned';
        $job_status->description = $request->description;
        $job_status->submission_date = date('Y-m-d');

        $job_status->save();


        $order = Order::find($id);
        $order->confirmation_status = 1;
        $order->save();


        flash()->success('Edited Successfully');

        return redirect('jobs');
    }


    public function allJobs()
    {
        $data['job_details'] = OrderStatus::all();

        return view('dashboard.jobs.all_jobs_view', $data);
    }
}
