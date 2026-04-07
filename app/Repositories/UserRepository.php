<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserRepository
{
    public function filterQuery(Request $request): Builder
    {
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
            $date = Carbon::createFromFormat('Y/m/d', $request->string('date_of_birth')->trim())
                ->format('Y-m-d');
            $query->whereDate('date_of_birth', $date);
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->string('phone')->trim() . '%');
        }

        return $query;
    }

    public function paginateFiltered(Request $request, int $perPage = 10)
    {
        return $this->filterQuery($request)
            ->latest()
            ->orderBy('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function exportCsvResponse(Request $request): StreamedResponse
    {
        $query = $this->filterQuery($request);
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

    public function create(array $attributes): User
    {
        return User::create($attributes);
    }

    public function softDelete(User $user, array $data): User
    {
        $user->update($data);
        return $user->fresh();
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user->fresh();
    }

    public function find($id): User
    {
        return User::find($id);
        if (!$user) {
            throw new \Exception('User not found');
        }
        return $user;
    }
}
