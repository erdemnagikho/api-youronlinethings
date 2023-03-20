<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;

class ApiSuccessResponse implements Responsable
{
    public function __construct(
        protected mixed $data,
        protected array $metaData,
        protected int   $code = Response::HTTP_OK,
        protected array $headers = [],
    )
    {}

    public function toResponse($request): \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        return response()->json([
            'data' => $this->data,
            'metadata' => $this->metaData,
        ], $this->code, $this->headers);
    }
}
