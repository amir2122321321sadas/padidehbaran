<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Coderflex\LaravelTicket\Concerns\HasTickets;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Models\Ban;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements BannableInterface
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, Bannable, softDeletes , Notifiable, HasTickets;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public const ACTIVE_OPTIONS = [
        0 => 'غیرفعال',
        1 => 'فعال',
        2 => 'بیمه نامه پرداخت نشده دارد'
    ];

    protected $fillable = [
        'email',
        'password',
        'identification_code',
        'level_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the user's information
     */
    public function userInformation()
    {
        return $this->hasOne(UserInformation::class);
    }

    public function userNationalityData()
    {
        return $this->hasOne(\App\Models\UserNationalityData::class);
    }

    public function insurancePolicies()
    {
        return $this->hasMany(InsurancePolicy::class)->orderBy('created_at', 'DESC');
    }


    /**
     * Get all subordinates (direct and indirect) of this user based on the referral/identification_code system.
     * This method returns a collection of all users who are in the downline of this user (multi-level).
     * Optimized to avoid maximum execution time exceeded by using a queue (BFS) instead of recursion.
     */
    // public function allSubordinates()
    // {
    //     $allSubordinates = collect();
    //     $visited = collect();
    //     $queue = collect([$this->id]);

    //     while ($queue->isNotEmpty()) {
    //         $currentIds = $queue->splice(0, 100); // Process in batches of 100 for efficiency

    //         // Get direct subordinates for all current IDs in batch
    //         $directs = self::query()
    //             ->whereIn('id', function ($query) use ($currentIds) {
    //                 $query->select('user_id')
    //                     ->from('user_information')
    //                     ->whereIn('identification_code', $currentIds);
    //             })
    //             ->get();

    //         // Filter out already visited users
    //         $newDirects = $directs->filter(function ($user) use ($visited) {
    //             return !$visited->contains($user->id);
    //         });

    //         // Add to result and mark as visited
    //         $allSubordinates = $allSubordinates->merge($newDirects);
    //         $visited = $visited->merge($newDirects->pluck('id'));

    //         // Add new direct subordinate IDs to the queue for next level
    //         $queue = $queue->merge($newDirects->pluck('id'));
    //     }

    //     return $allSubordinates->unique('id');
    // }




public function allSubordinates()
{
    $allSubordinates = collect();
    $visited = collect();
    $queue = collect([$this->id]);

    while ($queue->isNotEmpty()) {
        $currentIds = $queue->splice(0, 100); // پردازش دسته‌ای ۱۰۰تایی

        // گرفتن زیرمجموعه‌های مستقیم (کاربرانی که banned_at ندارند)
        $directs = self::query()
            ->whereIn('id', function ($query) use ($currentIds) {
                $query->select('user_id')
                    ->from('user_information')
                    ->whereIn('identification_code', $currentIds)
                    ->whereIn('user_id', function ($q) {
                        $q->select('id')
                          ->from('users')
                          ->whereNull('banned_at'); // فقط کاربران غیرمسدود
                    });
            })
            ->get();

        // حذف کاربرانی که قبلاً بازدید شده‌اند
        $newDirects = $directs->filter(fn($user) => !$visited->contains($user->id));

        // افزودن به نتایج
        $allSubordinates = $allSubordinates->merge($newDirects);
        $visited = $visited->merge($newDirects->pluck('id'));

        // اضافه کردن IDهای جدید به صف
        $queue = $queue->merge($newDirects->pluck('id'));
    }

    return $allSubordinates->unique('id');
}



    /**
     * Get direct subordinates (users whose user_information.identification_code == this user's id)
     */
public function directSubordinates()
{
    return $this->hasManyThrough(
        self::class,
        UserInformation::class,
        'identification_code', // کلید خارجی روی جدول user_information
        'id',                  // کلید خارجی روی جدول users
        'id',                  // کلید محلی روی users (کاربر فعلی)
        'user_id'              // کلید محلی روی user_information
    )->whereNull('users.banned_at');
}


    /**
     * Get the count of all subordinates (direct and indirect) for this user.
     * Optimized to avoid maximum execution time exceeded.
     */
    public function allSubordinatesCount()
    {
        return $this->allSubordinates()->count();
    }

    /**
     * روش استفاده:
     * $user->activeCoursesFromLevel();
     * این متد، دوره‌های فعال مرتبط با سطح کاربر را برمی‌گرداند.
     */
    public function activeCoursesFromLevel()
    {
        // سطح کاربر را بر اساس level_id پیدا می‌کند
        $level = \App\Models\Level::where('order_level', $this->level_id)->first();

        if (!$level) {
            // اگر سطحی پیدا نشد، کالکشن خالی برمی‌گرداند
            return collect();
        }

        // توجه: فیلد باید course_id باشد نه cource_id
        // اگر در دیتابیس یا مدل نام فیلد اشتباه است، اصلاح شود
        // همچنین اگر مقدار رشته است، باید به آرایه تبدیل شود
        $courseIds = null;

        // بررسی نام صحیح فیلد
        if (isset($level->course_id)) {
            $courseIds = $level->course_id;
        } elseif (isset($level->cource_id)) {
            $courseIds = $level->cource_id;
        }


        // اگر مقدار رشته باشد (مثلاً '["1"]' یا '[1]')
        if (is_string($courseIds)) {
            $courseIds = json_decode($courseIds, true);
        }

        // اگر مقدار عدد یا رشته عددی باشد
        if (is_numeric($courseIds)) {
            $courseIds = [(int)$courseIds];
        }

        // اگر مقدار آرایه نباشد یا خالی باشد
        if (!is_array($courseIds) || empty($courseIds)) {
            return collect();
        }

        // اطمینان از اینکه همه مقادیر عددی هستند
        $courseIds = array_map('intval', $courseIds);

        // دوره‌های فعال (status = 1) را بر اساس شناسه‌های استخراج‌شده برمی‌گرداند
        return \App\Models\Course::whereIn('id', $courseIds)
            ->where('status', 1)
            ->get();
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function incomes(){
        return $this->hasMany(Income::class);
    }

}
