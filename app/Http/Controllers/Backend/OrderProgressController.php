<?php

namespace App\Http\Controllers\Backend;

use App\Models\Message;
use App\Models\OrderStatus;
use App\Models\UserProfile;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class OrderProgressController extends Controller
{
    public function __construct()
    {       
        $this->middleware('auth');
    }
    public function screening_view() {

        $data['job_details'] = OrderStatus::where('client_id', Auth::id())
                                            ->where('status_type', '=', 'screening')
                                            ->get();

        return view('dashboard.order_progress.screening_view', $data);
    }


    public function writing_view() {

        $data['job_details'] = OrderStatus::where('client_id', Auth::id())
            ->where('status_type', '=', 'writing')
            ->get();

        return view('dashboard.order_progress.writing_view', $data);
    }


    public function draft_ready_view() {

        $data['job_details'] = OrderStatus::where('client_id', Auth::id())
            ->where('status_type', '=', 'draft_ready')
            ->get();

        return view('dashboard.order_progress.draft_ready_view', $data);
    }


    public function revision_view() {

        $data['job_details'] = OrderStatus::where('client_id', Auth::id())
            ->where('status_type', '=', 'revision')
            ->get();

        return view('dashboard.order_progress.revision_view', $data);
    }


    public function final_ready_view() {

        $data['job_details'] = OrderStatus::where('client_id', Auth::id())
            ->where('status_type', '=', 'order_accepted')
            ->get();

        return view('dashboard.order_progress.final_ready_view', $data);
    }


    public function order_accepted_view() {

        $data['job_details'] = OrderStatus::where('client_id', Auth::id())
            ->where('status_type', '=', 'order_accepted')
            ->get();

        return view('dashboard.order_progress.order_accepted_view', $data);
    }

}
