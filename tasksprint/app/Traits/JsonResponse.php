<?php

namespace App\Traits;

trait JsonResponse
{
    

        public function successResponse($data = null, $message = 'Success', $code = 200)
        {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ], $code);
        }

        public function failResponse($message = 'Error', $code = 400, $errors = null)
        {
            $response = [
                'success' => false,
                'message' => $message
            ];

            if ($errors) {
                $response['errors'] = $errors;
            }

            return response()->json($response, $code);
        }
    }
