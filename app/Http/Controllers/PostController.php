<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    private $post;
    private $category;
    

    public function __construct(Post $post, Category $category)
    {
        $this->post     = $post;
        $this->category = $category;
    }

    public function create()
    {
        $all_categories = Category::all();

        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        //this saves posts and generates the primary key
        $this->post->user_id        = Auth::user()->id;
        $this->post->description    = $request->description;
        $this->post->image          = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();

        //re writes your index array into associative array
        foreach($request->category as $category_id){
            $category_post[] = ["category_id" => $category_id];
        }

        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');
    }

    public function show(Post $post, $id)
    {
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')->with('post', $post);
    }

    public function edit($id)
    {
        $all_categories = Category::all();
        $post = $this->post->findOrFail($id);

        $selected_categories = [];
        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
                ->with('post', $post)
                ->with('all_categories', $all_categories)
                ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id)
    {
        $post = $this->post->findOrFail($id);

        if($post->user_id != Auth::id()){
            return redirect()->back();
        }

        $post->user_id        = Auth::user()->id;
        $post->description    = $request->description;
        if($request->image){
            $post->image      = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }
        $post->save();

        //re writes your index array into associative array
        foreach($request->category as $category_id){
            $category_post[] = ["category_id" => $category_id];
        }
        $post->categoryPost()->delete();

        $post->categoryPost()->createMany($category_post);

        return redirect()->route('post.show', $id);
    }

    public function destroy($id)
    {
        $this->post->findOrFail($id)->delete();

        return redirect()->back();
    }
}
