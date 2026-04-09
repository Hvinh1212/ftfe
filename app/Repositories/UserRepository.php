<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserRepository
{
    /**
     * CakePHP legacy password hash (similar to CakePHP 2 AuthComponent::password):
     * sha1(Security.salt + plainPassword)
     */
    private function cakePhpPasswordHash(string $plain): string
    {
        $salt = (string) env('CAKEPHP_SECURITY_SALT', '');

        return sha1($salt.$plain);
    }

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
        $newPasswordPlain = null;
        if (array_key_exists('password', $data)) {
            $newPasswordPlain = (string) ($data['password'] ?? '');
            unset($data['password']);
        }

        // Update non-password fields normally
        $user->update($data);

        // If password was provided, store CakePHP-hashed password *raw*
        // (bypass Laravel 'hashed' cast to avoid re-hashing).
        if ($newPasswordPlain !== null) {
            $raw = $this->cakePhpPasswordHash($newPasswordPlain);
            $user->setRawAttributes(array_merge($user->getAttributes(), [
                'password' => $raw,
            ]), true);
            $user->save();
        }

        return $user->fresh();
    }

    public function find($id): ?User
    {
        return User::find($id);
    }

    public function importCsv(UploadedFile $file): array
    {
        $imported = 0;
        $skipped = 0;
        $errors = [];

        $handle = fopen($file->getRealPath(), 'r');
        if ($handle === false) {
            return [
                'imported' => 0,
                'skipped' => 0,
                'errors' => ['Cannot read uploaded file.'],
            ];
        }

        $header = fgetcsv($handle);
        if (! is_array($header)) {
            fclose($handle);

            return [
                'imported' => 0,
                'skipped' => 0,
                'errors' => ['CSV header missing.'],
            ];
        }

        // Strip UTF-8 BOM on first column
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', (string) ($header[0] ?? '')) ?? '';

        $map = [];
        foreach ($header as $idx => $col) {
            $key = strtolower(trim((string) $col));
            $map[$key] = $idx;
        }

        $get = static function (array $row, array $map, array $keys): ?string {
            foreach ($keys as $k) {
                $k = strtolower($k);
                if (array_key_exists($k, $map) && array_key_exists($map[$k], $row)) {
                    return trim((string) $row[$map[$k]]);
                }
            }

            return null;
        };

        DB::beginTransaction();
        try {
            $rowNum = 1;
            while (($row = fgetcsv($handle)) !== false) {
                $rowNum++;

                $name = $get($row, $map, ['name', 'full name']);
                $email = $get($row, $map, ['email']);
                $userFlgRaw = $get($row, $map, ['user flag', 'user_flg', 'user flg']);
                $dobRaw = $get($row, $map, ['date of birth', 'date_of_birth', 'dob']);
                $phone = $get($row, $map, ['phone']);
                $password = $get($row, $map, ['password']);

                if ($email === null || $email === '') {
                    $skipped++;
                    $errors[] = "Row {$rowNum}: missing email.";
                    continue;
                }

                if (User::where('email', $email)->exists()) {
                    $skipped++;
                    continue;
                }

                $userFlg = is_numeric($userFlgRaw) ? (int) $userFlgRaw : 1;
                if (! in_array($userFlg, [0, 1, 2], true)) {
                    $userFlg = 1;
                }

                $dob = null;
                if ($dobRaw !== null && $dobRaw !== '') {
                    try {
                        $dob = str_contains($dobRaw, '/')
                            ? Carbon::createFromFormat('Y/m/d', $dobRaw)->format('Y-m-d')
                            : Carbon::parse($dobRaw)->format('Y-m-d');
                    } catch (\Throwable) {
                        $dob = null;
                    }
                }

                // If no password column provided, set a default.
                // (Required by current validation rules for add.)
                $plainPassword = ($password !== null && $password !== '') ? $password : 'password123';

                User::create([
                    'name' => $name ?: $email,
                    'email' => $email,
                    'password' => $plainPassword, // hashed by Laravel model cast
                    'user_flg' => $userFlg,
                    'date_of_birth' => $dob,
                    'phone' => $phone ?: null,
                ]);

                $imported++;
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $errors[] = $e->getMessage();
        } finally {
            fclose($handle);
        }

        return compact('imported', 'skipped', 'errors');
    }
}
