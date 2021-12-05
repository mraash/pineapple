<?php

namespace app\user\controllers\Content\pages\Index;

use app\user\controllers\Content\pages\Index\PostParametrs;
use app\user\controllers\UserPanelPage;
use app\general\models\Subscribers\SubscribersManager;


/**
 * @package app\user\controllers\Content\pages\Index
 */
class IndexPage extends UserPanelPage
{
    private const TEMPLATE_FILENAME = 'index.html';

    private const ERR_MSG = [
        'email_empty'    => 'Email address is required',
        'email_invalid'  => 'Please provide a valid e-mail address',
        'email_colombia' => 'We are not accepting subscriptions from Colombia emails',
        'terms_dissent'  => 'You must accept the terms and conditions',
    ];


    /** @var PostParametrs */
    private $postParams;


    public function __construct()
    {
        parent::__construct();

        $this->postParams = new PostParametrs();

        $this->pageData->set('form_method', 'POST');
        $this->pageData->set('inputs', [
            'email'  => [
                'name'  => PostParametrs::NAME_EMAIL,
                'value' => $this->postParams->getEmailValue(),
            ],
            'terms'  => [
                'name'       => PostParametrs::NAME_TERMS,
                'is_checked' => $this->postParams->isTermsAccept(),
            ],
            'submit' => [
                'name'  => PostParametrs::NAME_SUBMIT,
                'value' => PostParametrs::VALUE_SUBMIT,
            ],
        ]);


        if ($this->postParams->isFormSended()) {
            $this->processTheForm();
        }
    }


    public function render() : void
    {
        $this->renderTwigFile(self::TEMPLATE_FILENAME);
    }

    /**
     * Sends form data to subscribers model and add 'nojs_form' to pageData
     */
    private function processTheForm() : void
    {
        $email = $this->postParams->getEmailValue();
        $terms = $this->postParams->isTermsAccept();


        $model = SubscribersManager::getInstance();
        $result = $model->add($email, $terms)['form'];


        $isFormValid   = $result['isValid'];
        $isEmailValid  = true;
        $areTermsValid = true;
        $errorMessage  = '';

        if (!$isFormValid) {
            $errType    = $result['err']['type'];
            $errSubject = $result['err']['subject'];

            $isEmailValid  = $errSubject !== 'email';
            $areTermsValid = $errSubject !== 'terms';
            $errorMessage  = self::ERR_MSG[$errType];
        }


        $this->pageData->set('nojs_form', [
            'is_sended'       => $isFormValid,
            'is_valid'        => $isFormValid,
            'is_email_valid'  => $isEmailValid,
            'are_terms_valid' => $areTermsValid,
            'error_message'   => $errorMessage,
        ]);
    }
}
