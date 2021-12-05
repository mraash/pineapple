<?php

namespace app\general\models\Subscribers;

use \DateTime;
use \DateTimeZone;

/**
 * Class for validation (and doing a little processing) of input data SubscriberManager::add()
 *   method
 * 
 * @package app\general\models\Subscribers
 * 
 * @internal
 */
class SubscriptionForm
{
    private const EMAIL_REGEX = '/^[^@]{2,}@[^@]{2,}\.[^@]{2,5}$/';

    /** @var array  $data = [
     *    'email'    => (string)  // Full email
     *    'provider' => (string)  // Emails provider
     *    'date'     => (string)  // Current date (dd-mm-yyyy hh:mm:ss)
     * ]
     */
    private $data;

    /** 
     * @var array  $validationInfo = [
     *    'isValid' => (bool),
     *    'err'     => (null|array) [
     *       'subject' => 'email'|'terms',
     *       'type'    => 'email_empty'|'email_invalid'|'email_colombia'|'terms_dissent',
     *    ],
     * ]
     */
    private $validationInfo;


    public function __construct(string $email, bool $isTermsAccept)
    {
        $this->validationInfo = self::buildValidationInfo($email, $isTermsAccept);
        $this->data = [
            'email'    => $email,
            'provider' => self::getProvider($email),
            'date'     => self::getCurrentDate(),
        ];
    }

    /**
     * @return [
     *    'email'    => (string)  // Full email
     *    'provider' => (string)  // Emails provider
     *    'date'     => (string)  // Current date (dd-mm-yyyy hh:mm:ss)
     * ]
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * @return [
     *    'isValid' => (bool),
     *    'err'     => (null|array) [
     *       'subject' => 'email'|'terms',
     *       'type'    => 'email_empty'|'email_invalid'|'email_colombia'|'terms_dissent',
     *    ],
     * ]
     */
    public function getValidationInfo() : array
    {
        return $this->validationInfo;
    }


    public function isValid() : bool
    {
        return $this->getValidationInfo()['isValid'];
    }


    private static function buildValidationInfo(string $email, bool $isTermsAccept) : array
    {
        if ($email === '') {
            return self::getValidationInfoObject(false, 'email', 'email_empty');
        }

        if (!preg_match(self::EMAIL_REGEX, $email)) {
            return self::getValidationInfoObject(false, 'email', 'email_invalid');
        }

        if (preg_match('/.co$/', $email)) {
            return self::getValidationInfoObject(false, 'email', 'email_colombia');
        }

        if (!$isTermsAccept) {
            return self::getValidationInfoObject(false, 'terms', 'terms_dissent');
        }

        return self::getValidationInfoObject(true);
    }


    private static function getValidationInfoObject(
        bool $isValid,
        string $subject = null,
        string $type = null
    ) : array
    {
        if ($isValid) {
            return [
                'isValid' => true,
                'err' => null,
            ];
        }
        else {
            return [
                'isValid' => false,
                'err' => [
                    'subject' => $subject,
                    'type' => $type,
                ],
            ];
        }
    }


    private static function getProvider(string $email) : string
    {
        $result = $email;

        $result = preg_replace('/^[^@]+@/', '', $result);
        $result = preg_replace('/\.[^.]+$/', '', $result);

        return $result;
    }


    private static function getCurrentDate() : string
    {
        $date = new DateTime('NOW', new DateTimeZone('+0000'));
        return $date->format('Y-m-d H:i:s');
    }
}
