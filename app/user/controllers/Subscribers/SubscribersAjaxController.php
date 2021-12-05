<?php

namespace app\user\controllers\Subscribers;

use app\user\controllers\UserAjaxController;
use app\general\models\Subscribers\SubscribersManager;


class SubscribersAjaxController extends UserAjaxController
{
    public function __construct()
    {
        parent::__construct();
        self::setContentTypeHeader();

        $this->model = SubscribersManager::getInstance();
    }


    public function add() : void
    {
        $email         = $this->postParams['email'];
        $isTermsAccept = $this->postParams['is_terms_accept'];


        if (!isset($email)) {
            $this->printErrorResponse(
                self::CODE_NOT_SPECIFIED_PARAM,
                "'email' parametr is required"
            );

            return;
        }

        if (!isset($isTermsAccept)) {
            $this->printErrorResponse(
                self::CODE_NOT_SPECIFIED_PARAM,
                "'is_terms_accept' parametr is required"
            );

            return;
        }


        $formDetails = ($this->model->add($email, $isTermsAccept))['form'];

        if ($formDetails['isValid']) {
            $this->printSuccessResponse();
        }
        else {
            $code    = self::CODE_INVALID_PARAM;
            $message = 'Invalid data';
            $details = [
                'subject' => $formDetails['err']['subject'],
                'type' => $formDetails['err']['type'],
            ];
            $httpCode = 412;

            $this->printErrorResponse($code, $message, $details, $httpCode);
        }
    }
}
