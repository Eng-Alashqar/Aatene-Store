<?php

namespace App\Providers;

use App\Actions\Fortify\Authentication;
use Illuminate\Support\Facades\Config;
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


        if($request->is('administrator/*')){
              Config::set('fortify.guard', 'admin');
              Config::set('fortify.passwords', 'admins');
              Config::set('fortify.home', '/administrator');
              Config::set('fortify.prefix', '/administrator');
        }
        if($request->is('dashboard/*')){
            Config::set('fortify.guard', 'seller');
            Config::set('fortify.passwords', 'sellers');
            Config::set('fortify.home', '/dashboard');
            Config::set('fortify.prefix', '/dashboard');
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
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::viewPrefix('auth.');
    }
}
