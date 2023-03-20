<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;

class ApiErrorResponse implements Responsable
{
    public function __construct(
        protected \Throwable $e,
        protected string $message,
        protected int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        protected array $headers = [],
    )
    {}

    public function toResponse($request): \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        $response = ['message' => $this->message];

        if ($this->e && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->e->getMessage(),
                'file' => $this->e->getFile(),
                'line' => $this->e->getLine(),
                'trace' => $this->e->getTraceAsString(),
            ];
        }

        return response()->json($response, $this->code, $this->headers);
    }
}
