<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class PlansController extends Controller
{
    private $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function index()
    {
        $data['plans'] = $this->plan->orderBy('created_at', 'DESC')->get();
        return view('frontend.pages.plan', $data);
    }
}
