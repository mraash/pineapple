<?php

namespace app\user\controllers;


abstract class UserAjaxController
{
    protected const CODE_NOT_SPECIFIED_PARAM = 1;
    protected const CODE_INVALID_PARAM = 2;

    /** @var array */
    protected $postParams;


    public function __construct()
    {
        $requestBody = file_get_contents('php://input');
        $postParams = json_decode($requestBody, true);

        $this->postParams = $postParams;
    }


    protected static function setContentTypeHeader() : void
    {
        header('Content-type: application/json');
    }


    protected function printSuccessResponse($responseData = true) : void
    {
        echo json_encode([
            'success' => true,
            'response' => $responseData,
        ], JSON_PRETTY_PRINT);
    }


    protected function printErrorResponse(
        int $code,
        string $message,
        array $details = [],
        int $httpCode = 400
    ) : void
    {
        $errorData = [
            'success' => false,
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ];

        if (!empty($details)) {
            $errorData['error']['details'] = $details;
        }

        http_response_code($httpCode);
        echo json_encode($errorData, JSON_PRETTY_PRINT);
    }
}
