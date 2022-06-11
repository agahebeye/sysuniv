<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->mapAllRoutes();

        $this->bindRouteKey('student', \App\Models\Student::class);
        $this->bindRouteKey('employee', \App\Models\User::class);
        $this->bindRouteKey('university', \App\Models\User::class);
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function mapAllRoutes()
    {
        $this->routes(function () {
            foreach (File::allFiles(base_path('routes')) as $file) {

                if (str_contains($file, 'channels') || str_contains($file, 'console'))
                    continue;

                if (str_contains($file, 'api'))
                    Route::middleware('api')->prefix('api')->group($file);

                if (str_contains($file, 'web'))
                    Route::middleware('web')->group($file);
            }
        });
    }

    protected function bindRouteKey($name, $model)
    {
        Route::model($name, $model);

        Route::bind($name, function ($value, $route) use ($model) {
            $id = \Hashids::connection($model)->decode($value)[0] ?? null;
            $modelInstance = resolve($model);
            return  $modelInstance->findOrFail($id);
        });
    }
}
