<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (! $request->boolean('search')) {
            $records = User::query()->whereRaw('0 = 1')->paginate(10)->withQueryString();

            return view('home', compact('records'));
        }

        $query = User::query();

        if ($request->filled('full_name')) {
            $query->where('name', 'like', '%' . $request->string('full_name')->trim() . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->string('email')->trim() . '%');
        }

        if ($request->filled('user_flg')) {
            $query->whereIn('user_flg', $request->input('user_flg'));
        }

        if ($request->filled('date_of_birth')) {
            $date = Carbon::createFromFormat('Y/m/d', $request->date_of_birth)
                ->format('Y-m-d');

            $query->whereDate('date_of_birth', $date);
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->string('phone')->trim() . '%');
        }

        $records = $query->latest()->orderBy('id')->paginate(10)->withQueryString();

        return view('home', compact('records'));
    }

    public function about()
    {
        return "About Us";
    }
}
