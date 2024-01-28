<?php

namespace App\Exceptions;

use App\Traits\HttpResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponse;
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

        });

        $this->renderable(function (Throwable $e) {
            return $this->error(
                "Server Error",
                Response::HTTP_NOT_FOUND,
                $e->getMessage()
            );
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return $this->error(
                "Record sought does not exist",
                Response::HTTP_NOT_FOUND,
                $e->getMessage()
            );
        });
    }
}
