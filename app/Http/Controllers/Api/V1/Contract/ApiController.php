<?php

namespace App\Http\Controllers\Api\V1\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * @var mixed
     */
    private $statusCode;

    public function respondSuccessWithMessage($message)
    {
        return $this->setStatusCode(Response::HTTP_OK)
            ->respond([
            'message' => $message,
            'status' => 1
        ]);
    }

    public function respondSuccessWithData($data)
    {
        return $this->setStatusCode(Response::HTTP_OK)
            ->respond([
            'data' => $data,
            'status' => 1
        ]);
    }

    public function respondErrorUnAuthenticated($message)
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    public function respondErrorUnAuthorized($message)
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)->respondWithError($message);
    }

    public function respondNotFound($message)
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondErrorValidation($errors)
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->respondWithErrors($errors);
    }

    public function respondWithErrorMessage($message)
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    private function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
            ],
            'status' => 0
        ]);
    }

    private function respondWithErrors($errors)
    {
        return $this->respond([
            'errors' => [
                $errors,
            ], 'status' => 0
        ]);
    }

    private function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    private function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    private function getStatusCode()
    {
        return $this->statusCode;
    }

}
