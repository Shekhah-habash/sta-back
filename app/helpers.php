<?php

use App\Helpers\ApiResponse;

// Define helper functions for ApiResponse
if (!function_exists('apiSuccess')) {
    function apiSuccess(string $message = 'Operation successful', $data = null, int $statusCode = 200)
    {
        return ApiResponse::success($message, $data, $statusCode);
    }
}

if (!function_exists('apiError')) {
    function apiError(string $message = 'An error occurred', $errors = null, int $statusCode = 400)
    {
        return ApiResponse::error($message, $errors, $statusCode);
    }
}

// New helper functions
if (!function_exists('apiNotFound')) {
    function apiNotFound(string $message = 'Resource not found')
    {
        return ApiResponse::notFound($message);
    }
}

if (!function_exists('apiValidationError')) {
    function apiValidationError(string $message = 'Invalid data', $errors = [])
    {
        return ApiResponse::validationError($message, $errors);
    }
}

if (!function_exists('apiUnauthorized')) {
    function apiUnauthorized(string $message = 'Unauthorized')
    {
        return ApiResponse::unauthorized($message);
    }
}
