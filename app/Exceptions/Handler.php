<?php

namespace App\Exceptions;

use ErrorException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if ($e instanceof ErrorException || $e instanceof ClientException) {
                return redirect()->back()->withErrors(['_errors' => 'Stock not found']);
            }
        });
    }
}
