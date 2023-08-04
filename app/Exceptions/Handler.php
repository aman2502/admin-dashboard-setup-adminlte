<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use App\Constants\ResponseCode;
use App\Constants\ResponseMessage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException ) {
           /**
            * If API route does not have valid sanctum token
            */
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => ResponseMessage::UNAUTHORISED_MESSAGE
                ], 401);
            }
        }

        if ($exception instanceof AuthorizationException) {
            if ($request->is('api/*')) {
            return response()->json([
             'message' => 'You are not authorized to make changes.'
            ],401);
        }
        }
        if ($exception instanceof UnauthorizedException) {
            if(Auth::user() instanceof Admin){

                return redirect()->route('admin.login_page');
            }
            return redirect()->route('login');
        }

        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect('/');
        }

        return parent::render($request, $exception);
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (! $request->expectsJson()) {
            return abort(401);
        }

        $guard =Arr::get($exception->guards(),0);

        if($guard == 'admin') {
            return redirect()->guest(route('admin.login_page'));
        }

        return redirect()->guest(route('login'));
    }
}
