<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use BadMethodCallException;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->renderable(function (Throwable $e, $request) {
            if ($e->getPrevious() instanceof ErrorException) {
                return $this->errorResponse([], 500, 'Falha ao tentar buscar propriedade :' . $e->getPrevious()->getTraceAsString());
            }
            if ($request->is('api/*')) {
                if ($e instanceof QueryException) {
                    return $this->errorResponse([], 422, 'Falha ao executar query na base de dados :' . $e->getPrevious()->getMessage());
                }

                if ($e->getPrevious() instanceof ErrorException) {
                    return $this->errorResponse([], 500, 'Falha ao tentar buscar propriedade :' . $e->getPrevious()->getTraceAsString());
                }

                if ($e->getPrevious() instanceof BadMethodCallException) {
                    return $this->errorResponse([], 500, 'A chamada do método é indefinida :' . $e->getPrevious()->getTraceAsString());
                }

                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    return $this->errorResponse([], 404, 'Falha ao recuperar a instância do modelo : '.str_replace('App\\Models\\', '', $e->getPrevious()->getModel()));
                }

                if ($e->getPrevious() instanceof MethodNotAllowedHttpException) {
                    return $this->errorResponse([], 405, 'O método especificado para a solicitação é inválido');
                }

                if ($e->getPrevious() instanceof ErrorException) {
                    return $this->errorResponse([], 500, 'Falha ao tentar buscar propriedade :' . $e->getPrevious()->getTraceAsString());
                }

                if ($e->getPrevious() instanceof FileNotFoundException) {
                    return $this->errorResponse([], 500, 'Arquivo Não Existe :' . $e->getPrevious()->getTraceAsString());
                }

                if ($e->getPrevious() instanceof UploadException) {
                    return $this->errorResponse([], 500, 'Erro ao realizar o Upload! Tente novamente :' . $e->getPrevious()->getTraceAsString());
                }

                // return $this->errorResponse([], 404, 'Destino não encontrado');
            }
        });
    }
}
