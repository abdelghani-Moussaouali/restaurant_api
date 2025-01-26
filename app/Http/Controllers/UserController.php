<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResouece;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller 
{

public function index(){
    $users  = User::all();
    return response()->json([
        'users'=>UserResouece::collection($users)
    ]);
}



}
