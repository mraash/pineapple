<?php

namespace app\general\models\Subscribers;

use app\general\libraries\HelperTraits\Singleton;
use app\general\libraries\SqlBuilder\SqlSelectString;
use app\general\libraries\SqlBuilder\SqlDeleteString;

use app\general\models\Model;
use app\general\models\Subscribers\exceptions\InvalidFormDataException;
use app\general\models\Subscribers\SubscriptionForm;
use app\general\models\Subscribers\EmailProviderModel;


/**
 * Subscribers model
 * 
 * @package app\general\models\Subscribers
 */
class SubscribersManager extends Model
{
    use Singleton;


    public const FILTER_SORT_BY_DATE = 'date';
    public const FILTER_SORT_BY_NAME = 'name';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @todo Now if input data is invalid method will return an array with error details,
     *   but it would be uch better if it throws some kind of exception
     * 
     * @return [
     *    'form'      => [
     *       'isValid'   => (bool)
     *       'err'       => (array|null) [
     *          'subject' => 'email'|'terms'
     *          'subject' => 'email_empty'|'email_invalid'|'email_colombia'|'terms_dissent'
     *       ]
     *    ]
     * ]
     */
    public function add(string $email, bool $isTermsAccept) : array
    {
        $form = new SubscriptionForm($email, $isTermsAccept);
        
        if (!$form->isValid()) {
            return [
                'form' => $form->getValidationInfo(),
            ];
        }

        if ($this->isEmailAlreadySubscribed($email)) {
            return [
                'form' => $form->getValidationInfo(),
            ];
        }

        $formData = $form->getData();

        $providerName = $formData['provider'];

        $provider = new EmailProviderModel($providerName);
        $provider->createIfNotExist();

        $providerId = $provider->getId();
        $date       = $formData['date'];

        $sql = 'INSERT INTO `subscribers` (`email`, `provider_id`, `date`) VALUES (?, ?, ?)';

        $this->db->query($sql, [ $email, $providerId, $date ]);

        return [
            'form' => $form->getValidationInfo(),
        ];
    }


    public function delete(array $listOfId) : void
    {
        if (empty($listOfId)) {
            return;
        }

        $sql       = new SqlDeleteString('`subscribers`');
        $variables = [];

        foreach ($listOfId as $id) {
            $sql->addWhereConditionByOr('`id` = ?');
            array_push($variables, $id);
        }

        $sqlString = $sql->getString();

        $this->db->query($sqlString, $variables);
    }


    /**
     * @todo Omg this method is huge! Someone should definitely divide it into 1-2 classes
     * 
     * @param array $filtrationOptions (optional) = [
     *   'ids'       => (int[])
     *   'limit'     => (int)
     *   'offset'    => (int)
     *   'keyword'   => (string)
     *   'providers' => (int[])        // List of ids
     *   'sortBy'    => 'date'|'name'
     * ]
     * 
     * @return array  Array of subscriber rows from db [
     *    'offset' => (int)  // Offset
     *    'length' => (int)  // Length of list
     *    'total'  => (int)  // How many records are in the database
     *    'list'   => [      // List of subscribers
     *       0 => [
     *          'id'   => (int)
     *          'email'=> (string)
     *          'date' => (string)  // in format 'yyyy-mm-dd hh:mm:ss'
     *       ]
     *       1 => ...
     *    ]
     * ]
     */
    public function getList(array $filtrationOptions = []) : array
    {
        $ids       = $filtrationOptions['ids']       ?? [];
        $limit     = $filtrationOptions['limit']     ?? 100;
        $offset    = $filtrationOptions['offset']    ?? 0;
        $keyword   = $filtrationOptions['keyword']   ?? null;
        $providers = $filtrationOptions['providers'] ?? [];
        $orderBy   = $filtrationOptions['sortBy']    ?? null;


        $subscribersSql = new SqlSelectString('`subscribers` AS s');
        $queryVariables  = [];


        $subscribersSql
            ->setColumns(['s.id', 's.email', 's.date'])
            ->addLeftJoin('`email_providers` AS p', 's.provider_id = p.id')
        ;

        if (!empty($ids)) {
            $subscribersSql->startWhereBlockByAnd();

            foreach ($ids as $index => $id) {
                $key = "id_{$index}";

                $subscribersSql->addWhereConditionByOr("s.id = :{$key}");
                $queryVariables[$key] = $id;
            }

            $subscribersSql->endWhereBlock();
        }

        if (isset($keyword)) {
            $subscribersSql->addWhereConditionByAnd("s.email LIKE :keyword");
            $queryVariables['keyword'] = "%{$keyword}%";
        }

        if (!empty($providers)) {
            $subscribersSql->startWhereBlockByAnd();

            foreach ($providers as $index => $providerId) {
                $key = "provider_{$index}";

                $subscribersSql->addWhereConditionByOr("p.id = :{$key}");
                $queryVariables[$key] = $providerId;
            }

            $subscribersSql->endWhereBlock();
        }

        if (isset($orderBy)) {
            if ($orderBy == self::FILTER_SORT_BY_DATE) {
                $subscribersSql->setOrderBy('s.date DESC');
            }
            else if ($orderBy == self::FILTER_SORT_BY_NAME) {
                $subscribersSql->setOrderBy('s.email');
            }
        }

        if (isset($offset)) {
            $subscribersSql->setLimitsOffset(':limits_offset');
            $queryVariables['limits_offset'] = $offset;
        }

        if (isset($limit)) {
            $subscribersSql->setLimitsCount(':limits_count');
            $queryVariables['limits_count'] = $limit;
        }


        $sqlTotal = clone $subscribersSql;

        $sqlTotal->setColumns([ 'COUNT(*)' ]);
        $sqlTotal->removeOrderBy();
        $sqlTotal->removeLimit();

        $variablesTotal = json_decode(json_encode($queryVariables), true);
        unset($variablesTotal['limits_offset']);
        unset($variablesTotal['limits_count']);


        $listsSqlString  = $subscribersSql->getString();
        $totalsSqlString = $sqlTotal->getString();


        $list       = $this->db->getTable($listsSqlString, $queryVariables);
        $totalCount = $this->db->getTableCell($totalsSqlString, $variablesTotal);


        return [
            'offset' => $offset,
            'length' => count($list),
            'total'  => $totalCount,
            'list'   => $list,
        ];
    }


    public function getActiveProviders() : array
    {
        $sqlString = 
            'SELECT DISTINCT p.id, p.name FROM `subscribers` AS s
            LEFT JOIN `email_providers` AS p ON s.provider_id = p.id';

        $idList = $this->db->getTable($sqlString);

        return $idList;
    }


    private function isEmailAlreadySubscribed($email) : bool
    {
        $sql = 'SELECT COUNT(*) FROM `subscribers` WHERE `email` = ?';

        $result = $this->db->getTableCell($sql, [ $email ]);

        return $result > 0;
    }
}
