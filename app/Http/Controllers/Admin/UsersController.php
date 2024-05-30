<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user){

        $this->user = $user;
    }

    public function index(){

        $all_users = $this->user->withTrashed()->latest()->get();

        return view('admin.users.index')->with('all_users', $all_users);
    }

    public function deactivate($user_id){

        $user = $this->user->findOrFail($user_id);
        $user->delete();

        return redirect()->back();
    }

    public function activate($user_id){

        $user = $this->user->withTrashed()->findOrFail($user_id);
        $user->restore();

        return redirect()->back();

    }

}
