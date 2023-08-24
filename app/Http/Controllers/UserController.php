<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->orderBy('name', 'ASC')->get();
        return response()->json($users);
    }
}
