<?php

namespace App\Providers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Relations\Relation;

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

        Blade::directive('vite', function ($expression) {
            $devServerIsRunning = false;

            if (app()->environment('local')) {
                try {
                    Http::get("http://localhost:3000");
                    $devServerIsRunning = true;
                } catch (Exception) {
                }
            }

            if ($devServerIsRunning) {
                return new HtmlString(<<<HTML
                    <script type="module" src="http://localhost:3000/@vite/client"></script>
                    <script type="module" src="http://localhost:3000/resources/js/main.ts"></script>
                HTML);
            }

            $manifest = json_decode(file_get_contents(
                public_path('build/manifest.json')
            ), true);

            return new HtmlString(<<<HTML
                <script type="module" src="/build/{$manifest['resources/js/main.ts']['file']}"></script>
                <link rel="stylesheet" href="/build/{$manifest['resources/js/main.ts']['css'][0]}">
            HTML);
        });
    }
}
