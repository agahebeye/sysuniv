<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::enforceMorphMap([
            'Faculty' => \App\Models\Faculty::class,
            'Student' => \App\Models\Student::class,
            'Employee' => \App\Models\User::class,
            'University' => \App\Models\User::class,
        ]);

        JsonResource::withoutWrapping();
    }
}
