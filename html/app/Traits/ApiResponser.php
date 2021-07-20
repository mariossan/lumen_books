<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /*
    * Build success response
    * @param string|array $data
    * @param int $code
    * @return Illuminate\Http\JsonResponse
    */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
         return response()->json(["data" => $data], $code);
    }

    /*
    * Build success response
    * @param string|array $data
    * @param int $code
    * @return Illuminate\Http\JsonResponse
    */
    public function errorResponse($message, $code)
    {
         return response()->json([
                "message"   => $message,
                "code"      => $code
            ],
            $code);
    }
}
