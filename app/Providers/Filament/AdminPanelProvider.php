<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Resources\ContactUsResource\Widgets\ContactUsStatsWidget;
use App\Filament\Resources\InsurancePolicyResource\Widgets\InsurancePolicyWidget;
use App\Filament\Resources\UserResource\Widgets\UserRegistersChart;
use App\Filament\Resources\UserResource\Widgets\UsersCountWidget;
use App\Filament\Resources\UserViewResource\Widgets\UserViewStatsWidget;
use App\Filament\Widgets\TicketStatsWidget;
use App\Filament\Widgets\LatestTicketsWidget;
use App\Http\Middleware\authCheck;
use App\Http\Middleware\isAdmin;
use App\Models\Setting;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Notifications\Notification;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Frontend\Livewire\Client\Pages\Profile\NotificationProfilePage;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->plugins([
                \Hasnayeen\Themes\ThemesPlugin::make(),
                FilamentSpatieRolesPermissionsPlugin::make(),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->brandName('پدیده باران')
            ->font('iransans',
                url: asset('assets/fonts/iransansX/style.css'))
            ->spa()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                UsersCountWidget::class,
                UserRegistersChart::class,
                InsurancePolicyWidget::class,
                ContactUsStatsWidget::class,
                UserViewStatsWidget::class,
                TicketStatsWidget::class,
                LatestTicketsWidget::class,
            ])
            ->middleware([
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->databaseNotifications()
            ->authMiddleware([
                Authenticate::class,
                isAdmin::class
            ]);
    }
}
