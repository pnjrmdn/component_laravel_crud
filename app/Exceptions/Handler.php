<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof QueryException) {
            if ($exception->getCode() === '23000') {
                // Duplicate entry exception handling
                if (strpos($exception->getMessage(), 'users_username_unique') !== false) {
                    return redirect()->back()->withInput()->withErrors(['name' => 'Username or Name is already taken.']);
                }
            }
        }

        return parent::render($request, $exception);
    }

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
