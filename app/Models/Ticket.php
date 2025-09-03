<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Ticket extends \Coderflex\LaravelTicket\Models\Ticket implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'message',
        'priority',
        'status',
        'is_resolved',
        'is_locked',
        'assigned_to',
    ];

    protected $casts = [
        'is_resolved' => 'boolean',
        'is_locked' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * رابطه با کاربر ایجاد کننده تیکت
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * رابطه با کاربر اختصاص داده شده
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * رابطه با پیام‌های تیکت
     */
    public function messages(): HasMany
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    /**
     * اسکوپ برای تیکت‌های باز
     */
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }

    /**
     * اسکوپ برای تیکت‌های در حال بررسی
     */
    public function scopeInProgress(Builder $query): Builder
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * اسکوپ برای تیکت‌های حل شده
     */
    public function scopeResolved(Builder $query): Builder
    {
        return $query->where('status', 'resolved');
    }

    /**
     * اسکوپ برای تیکت‌های بسته
     */
    public function scopeClosed(Builder $query): Builder
    {
        return $query->where('status', 'closed');
    }

    /**
     * اسکوپ برای تیکت‌های با اولویت بالا
     */
    public function scopeHighPriority(Builder $query): Builder
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    /**
     * اسکوپ برای تیکت‌های اختصاص داده شده به کاربر خاص
     */
    public function scopeAssignedTo(Builder $query, int $userId): Builder
    {
        return $query->where('assigned_to', $userId);
    }

    /**
     * اسکوپ برای تیکت‌های بدون اختصاص
     */
    public function scopeUnassigned(Builder $query): Builder
    {
        return $query->whereNull('assigned_to');
    }

    /**
     * بررسی اینکه آیا تیکت باز است
     */
    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    /**
     * بررسی اینکه آیا تیکت در حال بررسی است
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * بررسی اینکه آیا تیکت حل شده است
     */
    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }

    /**
     * بررسی اینکه آیا تیکت بسته است
     */
    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    /**
     * بررسی اینکه آیا تیکت اختصاص داده شده است
     */
    public function isAssigned(): bool
    {
        return !is_null($this->assigned_to);
    }

    /**
     * دریافت آخرین پیام تیکت
     */
    public function getLastMessage()
    {
        return $this->messages()->latest()->first();
    }

    /**
     * دریافت تعداد پیام‌های تیکت
     */
    public function getMessagesCount(): int
    {
        return $this->messages()->count();
    }

    /**
     * دریافت رنگ مناسب برای وضعیت
     */
    public function getStatusColor(): string
    {
        return match ($this->status) {
            'open' => 'success',
            'in_progress' => 'warning',
            'resolved' => 'success',
            'closed' => 'danger',
            default => 'gray',
        };
    }

    /**
     * دریافت رنگ مناسب برای اولویت
     */
    public function getPriorityColor(): string
    {
        return match ($this->priority) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            'urgent' => 'danger',
            default => 'gray',
        };
    }

    /**
     * دریافت متن فارسی وضعیت
     */
    public function getStatusText(): string
    {
        return match ($this->status) {
            'open' => 'باز',
            'in_progress' => 'در حال بررسی',
            'resolved' => 'حل شده',
            'closed' => 'بسته',
            default => $this->status,
        };
    }

    /**
     * دریافت متن فارسی اولویت
     */
    public function getPriorityText(): string
    {
        return match ($this->priority) {
            'low' => 'کم',
            'medium' => 'متوسط',
            'high' => 'زیاد',
            'urgent' => 'فوری',
            default => $this->priority,
        };
    }
}
