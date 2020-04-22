<?php

namespace App\Http\Controllers;

use App\Blogs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       # $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blogs::orderBy('id','desc')->paginate(5);
        return view('blog.home')->with('blogs',$blogs);
    }
}
