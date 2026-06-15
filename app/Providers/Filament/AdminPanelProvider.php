<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Pages\Dashboard;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('PPI 104 Al-Ittihad')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo.png'))
            ->colors([
                'primary'  => Color::Emerald,
                'gray'     => Color::Zinc,
                'info'     => Color::Sky,
                'success'  => Color::Teal,
                'warning'  => Color::Amber,
                'danger'   => Color::Rose,
            ])
            ->defaultThemeMode(\Filament\Enums\ThemeMode::Light)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Pengaturan Website')
                    ->collapsed(true),
                NavigationGroup::make()
                    ->label('Landing Page')
                    ->collapsed(true),
                NavigationGroup::make()
                    ->label('Website')
                    ->collapsed(true),
                NavigationGroup::make()
                    ->label('Profil Pesantren')
                    ->collapsed(true),
                NavigationGroup::make()
                    ->label('Program Pendidikan')
                    ->collapsed(true),
                NavigationGroup::make()
                    ->label('Dukungan Pendidikan')
                    ->collapsed(true),
                NavigationGroup::make()
                    ->label('Media')
                    ->collapsed(true),
                NavigationGroup::make()
                    ->label('Pengaturan')
                    ->collapsed(true),
            ])
            ->pages([
                Dashboard::class,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
