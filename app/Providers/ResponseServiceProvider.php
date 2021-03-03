<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($code = 200, $message = 'success') {
            return Response::json([
                'code' => $code,
                'message' => $message
            ])->setStatusCode($code);
        });

        Response::macro('fail', function ($code = 400, $error = '') {
            return Response::json([
                'code' => $code,
                'error' => $error
            ]);
        });
    }
}
