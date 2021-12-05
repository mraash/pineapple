<?php

namespace app\user\controllers\Content\pages\Index;

/**
 * Service class for IndexPage
 * 
 * @package app\user\constrollers\Content\pages\Index
 * 
 * @internal
 */
class PostParametrs
{
    public const NAME_EMAIL  = 'email';
    public const NAME_TERMS  = 'terms';
    public const NAME_SUBMIT = 'is_form_sended';

    public const VALUE_SUBMIT = 'yes';


    /** @var string|null */
    private $email;

    /** @var string|null */
    private $terms;

    /** @var bool */
    private $isSended;


    public function __construct()
    {
        $requestParams = $_POST;

        $this->email    = $requestParams[self::NAME_EMAIL] ?? null;
        $this->terms    = $requestParams[self::NAME_TERMS] ?? null;
        $this->isSended = isset($requestParams[self::NAME_SUBMIT]);
    }


    public function isFormSended() : bool
    {
        return $this->isSended;
    }


    public function getEmailValue() : string
    {
        return $this->email ?? '';
    }

    public function isTermsAccept() : bool
    {
        return isset($this->terms);
    }
}
