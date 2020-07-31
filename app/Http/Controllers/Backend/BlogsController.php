<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Flash;
use Auth;
use Validator;
use Image;
use File;

class BlogsController extends Controller
{
    private $blog;
    private $loggedInUser;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
        $this->loggedInUser = Auth::user();

    }

    public function index()
    {
        $data['blogs'] = $this->blog->all();
        return view('frontend.pages.blog', $data);
    }

    public function create()
    {
        return view('dashboard.blog.create');
    }

    public function store(Request $request)
    {
        $inputs                   = $request->all();
        $this->blog->title        = $inputs['title'];
        $this->blog->slug         = str_slug($inputs['title']);
        $this->blog->content      = $inputs['content'];
        $this->blog->status       = $inputs['status'];
        if (isset($inputs['is_sticky'])) {
            $this->blog->is_sticky = $inputs['is_sticky'];
        } else {
            $this->blog->is_sticky = false;
        }

        if($request->hasFile('thumbnail_src')) {
            $validatePhoto = Validator::make(
                                        ['thumbnail_src' => $request->file('thumbnail_src')],
                                        ['thumbnail_src' => 'image|max: 512']
                                    );

            if($validatePhoto->fails()) {
                return redirect()->back()->withInput()->withErrors($validatePhoto);
            }

            $destinationPath    = public_path().blog_image_upload_path(); // upload path
            $extension          = $request->file('thumbnail_src')->getClientOriginalExtension(); // getting image extension
            $fileName           = sha1(time()).'-'.$this->loggedInUser->id.'.'.$extension; // renameing image
            $image              = Image::make($request->file('thumbnail_src'));

            File::exists($destinationPath) or File::makeDirectory($destinationPath);
            $image->resize(300, 200)->save($destinationPath . $fileName);

            if ($this->blog->thumbnail_src) {
                File::delete($destinationPath . $this->blog->thumbnail_src);
            }

            $this->blog->thumbnail_src = $fileName;
        }

        $this->blog->created_by    = $this->loggedInUser->id;
        $this->blog->save();

        flash()->success('Your new article has been created successfully!');
        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        $data['blog'] = $this->blog->find($id);
        return view('frontend.pages.single-blog', $data);
    }
}
