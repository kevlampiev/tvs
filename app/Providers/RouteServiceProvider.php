<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
//    public function boot()
//    {
//        $this->configureRateLimiting();
//
//        $this->routes(function () {
//            Route::prefix('api')
//                ->middleware('api')
//                ->namespace($this->namespace)
//                ->group(base_path('routes/api.php'));
//
//            Route::middleware('web')
//                ->namespace($this->namespace)
//                ->group(base_path('routes/web.php'));
//        });
//    }

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->getRouteParameters()->each(function ($params) {
                $this->mapRoutes($params);
            });
        });
    }

    private function mapRoutes($params)
    {
        collect(File::files(base_path('routes/'.$params['dir'])))->each(function ($file) use ($params) {
            Route::prefix($params['prefix'])
                ->name($params['name'])
                ->middleware($params['middleware'])
                ->namespace($this->namespace)
                ->group($file);
        });
    }

    private function getRouteParameters(): Collection
    {
        return collect([
            'admin' => ['dir' => 'admin', 'prefix' => 'admin', 'name' => 'admin.', 'middleware' => ['web','is.manager', 'password_expired']],
//            'api' => ['dir' => 'api', 'prefix' => 'api', 'name' => 'api.', 'middleware' => 'api'],
            'web' => ['dir' => 'web', 'prefix' => '', 'name' => '', 'middleware' => 'web'],
        ]);
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
