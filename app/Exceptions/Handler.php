<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\TrainingNotFoundException;
use App\Exceptions\NutritionPlanNotFoundException;
use App\Exceptions\ProgressLogNotFoundException;
use App\Exceptions\UnauthorizedAccessException;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\TokenNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Registrar as exceptions personalizadas
        $this->renderable(function (TrainingNotFoundException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (NutritionPlanNotFoundException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (ProgressLogNotFoundException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (UnauthorizedAccessException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (InvalidCredentialsException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (UserAlreadyExistsException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (TokenNotFoundException $e, $request) {
            return $e->render($request);
        });
    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'error' => 'Authentication token missing or invalid. Please login again.'
        ], 401);
    }

}
