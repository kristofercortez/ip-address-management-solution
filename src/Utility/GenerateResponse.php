<?php

namespace App\Utility;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GenerateResponse
 * @package App\Utility
 */
class GenerateResponse
{
    /**
     * @param bool $isSuccess
     * @param array $data
     * @param string $message
     * @param int|null $statusCode
     * @return JsonResponse
     */
    public static function json(
        bool $isSuccess,
        array $data,
        string $message,
        ?int $statusCode = Response::HTTP_OK
    ): JsonResponse {
        return new JsonResponse([
            'success' => $isSuccess,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }
}
