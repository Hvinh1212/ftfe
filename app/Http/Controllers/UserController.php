<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function index(Request $request)
    {
        if ($request->boolean('export')) {
            return $this->userRepository->exportCsvResponse($request);
        }

        $records = $this->userRepository->paginateFiltered($request, 10);

        return view('users', compact('records'));
    }

    public function add()
    {
        return view('user-add');
    }

    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function softDelete(Request $request, User $user)
    {
        $this->userRepository->softDelete($user, [
            'del_flg' => 1,
            'deleted_at' => now(),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()
                ->route('users.index')
                ->with('error', 'User not found');
        }
        return view('user-edit', compact('user'));
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $result = $this->userRepository->importCsv($request->file('file'));

        return redirect()
            ->route('users.index')
            ->with('success', "Imported: {$result['imported']}, Skipped: {$result['skipped']}")
            ->with('import_errors', $result['errors']);
    }
}
