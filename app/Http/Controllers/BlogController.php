<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {

            $user = Auth::user();
            $blogs = $user->blog()->orderBy('id','desc')->paginate(5);
            return view('blog.dashboard')->with('blogs',$blogs);
        }
        
        $blogs = Blogs::orderBy('id','desc')->paginate(5);
        return view('blog.home')->with('blogs',$blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => 'Create New','editor' => true];
        return view('blog.editor')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'title'     => 'required|max:100',
            'content'   => 'required',
            'featureImage'  => 'image|nullable|max:1500'
        ]);

        $featureImage = '';
        if($request->hasFile('featureImage')) {
            $extension = $request->file('featureImage')->extension();
            $featureImage = time() . Str::random(10) . '.' . $extension;

            Storage::putFileAs(
                'public/images', $request->file('featureImage'), $featureImage
            );
        }
        
        $blog = new Blogs;
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->feature_image = $featureImage;
        $blog->author_id = Auth::id();
        $blog->save();

        return redirect('/blog')->with('post-saved',"Blog {$blog->title} has been saved!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blog.view')->with('blog', Blogs::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blogs::where(['id' => $id, 'author_id' => Auth::id()])->get()->first();
        if(is_null($blog)) {
            return redirect('/blog')->with('post-failed',"Cannot Edit, Invalid Blog ID");
        }
        $data = ['title' => 'Edit Post','editor' => true, 'blog' => $blog];

        return view('blog.editor')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'title'     => 'required|max:100',
            'content'   => 'required',
            'featureImage'  => 'image|nullable|max:1500'
        ]);


        $blog = Blogs::where(['id' => $id, 'author_id' => Auth::id()])->get()->first();
        if(is_null($blog)) {
            return redirect('/blog')->with('post-failed',"Cannot Edit, Invalid Blog ID");
        }

        $featureImage = FALSE;
        if($request->hasFile('featureImage')) {
            $extension = $request->file('featureImage')->extension();
            $featureImage = time() . Str::random(10) . '.' . $extension;
            Storage::delete('public/images/' . $blog->feature_image);    
            Storage::putFileAs(
                'public/images', $request->file('featureImage'), $featureImage
            );
        }

        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        if(FALSE !== $featureImage) {
            $blog->feature_image = $featureImage;
        }
        $blog->save();
        return redirect('/blog')->with('post-saved', "BLog {$blog->title} has been updated!");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        
        $blog = Blogs::where(['id' => $id, 'author_id' => Auth::id()])->get()->first();
        if(is_null($blog)) {
            return redirect('/blog')->with('post-failed',"Cannot Edit, Invalid Blog ID");
        }

        if($blog->feature_image != '') {
            Storage::delete('public/images/' . $blog->feature_image);
        }
        $blog->delete();
        return redirect('/blog')->with('post-saved',"Blog {$blog->title} has beed deleted");
    }
}
