<?php

namespace App\Providers;

use App\Actions\Fortify\Authentication;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();

        if ($request->is('api/v1/*')) {
            config()->set("auth.guards.seller.driver", 'jwt');
            config()->set("auth.guards.admin.driver", 'jwt');
        }

        if ($request->is('administrator/*')) {
            config()->set('fortify.guard', 'admin');
            config()->set('fortify.passwords', 'admins');
            config()->set('fortify.home', '/administrator');
            config()->set('fortify.prefix', '/administrator');
        }
        if ($request->is('dashboard/*')) {
            config()->set('fortify.guard', 'seller');
            config()->set('fortify.passwords', 'sellers');
            config()->set('fortify.home', '/dashboard');
            config()->set('fortify.prefix', '/dashboard');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        // Fortify::authenticateUsing([ new Authentication,'login']);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        if (request()->is('login') || request()->is('register')) {
            abort(404);
        }
        Fortify::viewPrefix('auth.');
    }
}
