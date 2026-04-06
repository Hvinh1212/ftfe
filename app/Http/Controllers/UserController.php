<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $users
    ) {}

    public function index(Request $request)
    {
        if ($request->boolean('export')) {
            return $this->users->exportCsvResponse($request);
        }

        $records = $this->users->paginateFiltered($request, 10);

        return view('users', compact('records'));
    }

    public function add()
    {
        return view('user-add');
    }

    public function store(StoreUserRequest $request)
    {
        $this->users->create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully');
    }
}
