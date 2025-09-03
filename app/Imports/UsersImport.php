<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithChunkReading
{
    use SkipsFailures;

    /**
     * هر ردیف را به مدل تبدیل می‌کند.
     * ستون‌های فایل اکسل شما باید سرفصل (header) داشته باشند، مثل: name, email, password
     */
    public function model(array $row)
    {
        // اگر بعضی ستون‌ها اختیاری‌اند، null coalesce بگذار
        return new User([
            'name'     => $row['name'] ?? null,
            'email'    => $row['email'] ?? null,
            'password' => isset($row['password'])
                ? Hash::make($row['password'])
                : Hash::make('password'), // پیش‌فرض
            'identification_code' => rand(100000, 999999),
        ]);
    }

    /**
     * اعتبارسنجی هر ردیف
     */
    public function rules(): array
    {
        return [
            '*.name'  => ['required', 'string', 'max:255'],
            '*.email' => ['required', 'email', Rule::unique('users', 'email')],
            // اگر password اجباریه:
            '*.password' => ['nullable', 'string', 'min:6'],
        ];
    }

    /**
     * برای فایل‌های بزرگ بهتره chunk کنیم
     */
    public function chunkSize(): int
    {
        return 500; // متناسب با سرورت تغییر بده
    }
}
