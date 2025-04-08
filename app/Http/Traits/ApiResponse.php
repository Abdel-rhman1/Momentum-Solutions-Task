<?php

namespace App\Http\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ApiResponse
{
    /**
     * @param null $message
     * @param null $data
     * @param int $code
     * @param null $errors
     * @param null $token
     * @return JsonResponse
     */
    public function apiResponse(
        $data = null,
        int $code = 200,
        $message = null,
        $errors = null,
        $token = null
    ): JsonResponse
    {
        $response = [
//            'message' => $message,
            'errors' => [
                "validation_error" => $errors,
                "general_error" => $message ? [
                    'code' => config('errors.' . $message),
                    'message' => $message
                ] : null
            ],
            'data' => $data,
        ];

        if ($token) $response = array_merge($response, ['token' => $token]);

        return response()->json($response, $code, ['message' => 'error']);
    }

    /**
     * This function apiResponseValidation for Validation Request
     * @param $validator
     */
    public function apiResponseValidation($validator)
    {
        $errors = $this->respondWithError($validator->errors()->toArray());
        Log::debug('response register client', [$errors]);
        $response = $this->apiResponse(null, 422, null, $errors);
        throw new HttpResponseException($response);
    }

    public function respondWithError($messages_array)
    {
        $message_key = array();
        foreach ($messages_array as $key => $messages) {
            $message_key[] = [
                'message' => $messages[0],
                'code' => $key
            ];

//            $message_key[] = $messages[0];
        }
        return $message_key;
        //return $this->apiResponse(null , 422 , null , $message_key);
//        return ResponseController::sendResponse(422, false, "", null, $message_key);
    }


    public function apiResponseError(
        $message = null,
        $code = 400,
        $errors = null,
    ): JsonResponse
    {
        $response = [
            'errors' => [
                "validation_error" => $errors,
                "general_error" => $message ? [
                    'code' => 400,
                    'message' => $message
                ] : null
            ]
        ];
        return response()->json($response, $code);
    }
}
