<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    const AREA_API = 'api';

    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        HttpException::class,
        TokenMismatchException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param Throwable $e
     * @throws \Exception
     */
    public function report(Throwable $e)
    {
        try {
            if ($this->shouldReport($e)) {
                $message = $e->getMessage() . PHP_EOL . $e->getTraceAsString();
                $message .= '","[F]' . $e->getFile() . '",[L]' . $e->getLine();
                logError($message);
            }
        } catch (\Exception $exception) {
            logError($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            throw $exception;
        }
    }

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

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        return parent::render($request, $e);
    }

    /**
     * @param Throwable $e
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     */
    protected function convertExceptionToResponse(Throwable $e)
    {
        if (config('app.debug')) {
            return parent::convertExceptionToResponse($e);
        }

        try {
            DB::connection()->getPdo();

            if (!DB::connection()->getDatabaseName()) {
                die(trans('messages.db_not_connect'));
            }
        } catch (\Exception $e) {
            die(trans('messages.db_not_connect'));
        }

        $area = getArea();

        if (view()->exists("{$area}.errors.500")) {
            return response()->view("{$area}.errors.500", [
                'exception' => $e,
                'area' => getArea(), 'title' => config('app.name')
            ], 500);
        }

        return parent::convertExceptionToResponse($e);
    }

    /**
     * @param HttpExceptionInterface $e
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        $status = $e->getStatusCode();
        $area = getArea();

        if ($area == self::AREA_API) {
            switch (true) {
                case $e instanceof NotFoundHttpException:
                    $code = getConstant('HTTP_CODE.NOT_FOUND');
                    break;
                case $e instanceof MethodNotAllowedHttpException:
                    $code = getConstant('HTTP_CODE.METHOD_NOT_ALLOWED');
                    break;
                default:
                    $code = getConstant('HTTP_CODE.SERVER_ERROR');
                    break;
            }

            return response()->json([
                'status' => false,
                'message' => data_get(trans('messages.http_code'), $code),
                'data' => [],
            ], $code);
        }

        if (view()->exists("{$area}.errors.{$status}")) {
            return response()->view("{$area}.errors.{$status}", [
                'exception' => $e,
                'area' => $area,
                'title' => config('app.name')],
                $status,
                $e->getHeaders());
        }

        return $this->convertExceptionToResponse($e);
    }
}
