<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogsController extends Controller
{
    private $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function index()
    {
        $data['blogs'] = $this->blog->orderBy('created_at', 'DESC')->get();
        return view('frontend.pages.blog', $data);
    }

    public function show($id)
    {
        $data['blog'] = $this->blog->find($id);
        return view('frontend.pages.single-blog', $data);
    }
}
