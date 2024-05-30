<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryPost;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(Category $category){

        $this->category = $category;
    }

    public function index(){

        $all_categories = $this->category->withTrashed()->latest()->get();

        return view('admin.categories.index')->with('all_categories', $all_categories);
    }

    public function create(Request $request){
        $category       = $this->category;
        $category->name = $request->category;
        $category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id){

        $category       = $this->category->findOrFail($id);
        $category->name = $request->category;
        $category->save();

        return view('admin.categories.index')->with('category', $category);
    }

    public function uncategorised($id){

        $category = $this->category->findOrFail($id);
        $category->delete();

        return redirect()->back();
    }
}
