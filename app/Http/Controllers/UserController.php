<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $isExport = $request->boolean('export');

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

        if ($isExport) {
            $filename = 'users_' . now()->format('Ymd_His') . '.csv';

            return response()->streamDownload(function () use ($query) {
                $out = fopen('php://output', 'w');
                fwrite($out, "\xEF\xBB\xBF");

                fputcsv($out, ['Name', 'Email', 'User flag', 'Date of Birth', 'Phone']);

                $query
                    ->orderBy('id')
                    ->cursor()
                    ->each(function (User $user) use ($out) {
                        fputcsv($out, [
                            $user->name,
                            $user->email,
                            $user->user_flg,
                            $user->date_of_birth?->format('Y-m-d') ?? '',
                            $user->phone ?? '',
                        ]);
                    });

                fclose($out);
            }, $filename, [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]);
        }

        $records = $query->latest()->orderBy('id')->paginate(10)->withQueryString();

        return view('users', compact('records'));
    }
    public function add()
    {
        return view('user-add');
    }
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
}
