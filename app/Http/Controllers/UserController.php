<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAccessTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            CheckAccessTime::class,
        ];
    }
    public function index() {
        $users = User::all();
        $title = "User list";
       return view('users', [
        'users' => $users,
        'title' => $title
       ]);
    }
}
