<?php

return [
    'action' => [
        'label' => 'اعمال کوپن',
        'form' => [
            'code' => [
                'label' => 'کد کوپن',
                'placeholder' => 'کد کوپن خود را وارد کنید',
            ],
        ],
        'notifications' => [
            'success' => [
                'title' => 'کوپن اعمال شد',
                'body' => 'کوپن شما با موفقیت اعمال شد!',
            ],
            'failure' => [
                'title' => 'کوپن نامعتبر',
                'body' => 'کد کوپن وارد شده نامعتبر است یا منقضی شده است.',
            ],
            'error' => [
                'title' => 'خطای کوپن',
                'body' => 'در اعمال کوپن خطایی رخ داد. لطفاً بعداً تلاش کنید.',
            ],
        ],
    ],

    'resource' => [
        'title' => 'کوپن',
        'plural_title' => 'کوپن‌ها',
        'usage' => 'استفاده',
        'usages' => 'استفاده‌ها',

        'form' => [
            'details' => 'جزئیات',
            'limits' => 'محدودیت‌ها',
            'multiple_creation' => [
                'heading' => 'ایجاد چندتایی',
                'description' => 'با تعیین تعداد، چند کوپن منحصر به فرد ایجاد کنید.',
            ],

            'fields' => [
                'code' => 'کد',
                'strategy' => 'استراتژی',
                'active' => 'فعال',
                'starts_at' => [
                    'label' => 'شروع از',
                    'help' => 'در صورت خالی بودن، بدون تاریخ شروع',
                ],
                'expires_at' => [
                    'label' => 'انقضا',
                    'help' => 'در صورت خالی بودن، بدون تاریخ انقضا',
                ],
                'usage_limit' => [
                    'label' => 'محدودیت استفاده',
                    'help' => 'در صورت خالی بودن، نامحدود',
                ],
                'number_of_coupons' => 'تعداد کوپن',
            ],
        ],

        'table' => [
            'columns' => [
                'code' => 'کد',
                'strategy' => 'استراتژی',
                'starts_at' => 'شروع از',
                'expires_at' => 'انقضا',
                'usage_limit' => 'محدودیت استفاده',
                'active' => 'فعال',
                'created_at' => 'تاریخ ایجاد',
                'updated_at' => 'تاریخ بروزرسانی',
                'used_by' => 'استفاده شده توسط',
                'used_at' => 'تاریخ استفاده',
            ],
            'filters' => [
                'active' => 'فعال',
                'inactive' => 'غیرفعال',
                'all' => 'همه',
                'strategy' => 'استراتژی',
            ],
        ],
    ],
]; 