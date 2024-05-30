<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(){

        $all_posts = $this->post->withTrashed()->latest()->paginate(10);

        return view('admin.posts.index')->with('all_posts', $all_posts);
    }

    public function hide($post_id){

        $post = $this->post->findOrFail($post_id);
        $post->delete();

        return redirect()->back();
    }

    public function unhide($post_id){

        $post = $this->post->withTrashed()->findOrFail($post_id);
        $post->restore();

        return redirect()->back();
    }
}
