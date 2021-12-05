<?php

namespace app\admin\controllers\Subscribers\pages\Archive;

use app\general\models\Subscribers\SubscribersManager;
use app\admin\controllers\Subscribers\pages\Archive\ArchivePage;


/**
 * Service class for ArchivePage
 * 
 * @package app\admin\controllers\Subscribers\pages\Archive
 * 
 * @internal
 */
class GetParametrs
{
    private const KEY_KEYWORD    = 's';
    private const KEY_SORT_BY    = 'sort';
    private const KEY_PROVIDER   = 'providers';
    private const KEY_SUBSCRIBER = 'subscribers';

    public const NAME_KEYWORD    = self::KEY_KEYWORD;
    public const NAME_SORT_BY    = self::KEY_SORT_BY;
    public const NAME_PROVIDER   = self::KEY_PROVIDER . '[]';
    public const NAME_SUBSCRIBER = self::KEY_SUBSCRIBER . '[]';

    public const VALUE_SORT_BY_DATE = 'by_date';
    public const VALUE_SORT_BY_NAME = 'by_value';


    /** @var string */
    private $keyword;

    /** @var string */
    private $sortBy;

    /** @var array */
    private $providers;

    /** @var array */
    private $subscribers;


    public function __construct()
    {
        $this->keyword     = $_GET[self::KEY_KEYWORD] ?? null;
        $this->sortBy      = $_GET[self::KEY_SORT_BY] ?? null;
        $this->providers   = $_GET[self::KEY_PROVIDER] ?? [];
        $this->subscribers = $_GET[self::KEY_SUBSCRIBER] ?? [];
    }


    public function getFilteringOptions() : array
    {
        $result = [];

        if (!empty($this->keyword)) {
            $result['keyword'] = $this->keyword;
        }

        if (isset($this->sortBy)) {
            if ($this->sortBy === self::VALUE_SORT_BY_DATE) {
                $result['sortBy'] = SubscribersManager::FILTER_SORT_BY_DATE;
            }
            else if ($this->sortBy === self::VALUE_SORT_BY_NAME) {
                $result['sortBy'] = SubscribersManager::FILTER_SORT_BY_NAME;
            }
        }

        if (!empty($this->providers)) {
            $result['providers'] = $this->providers;
        }

        return $result;
    }


    public function exists() : bool
    {
        return !empty($_SERVER['QUERY_STRING']);
    }


    public function getFullQueryString() : string
    {
        if (!$this->exists()) {
            return '';
        }

        return "?{$_SERVER['QUERY_STRING']}";
    }

    /**
     * @return string|null
     */
    public function getKeywordValue()
    {
        return $this->keyword;
    }

    /**
     * @return string|null
     */
    public function getSelectedSortBy()
    {
        return $this->sortBy;
    }


    public function hasSortBy() : bool
    {
        return $this->getSelectedSortBy() !== null;
    }


    public function getCheckedProviders() : array
    {
        return $this->providers;
    }


    public function isProviderChecked($value) : bool
    {
        return in_array($value, $this->providers);
    }


    public function getCheckedSubscribers() : array
    {
        return $this->subscribers;
    }


    public function isSubscriberChecked($value) : bool
    {
        return in_array($value, $this->subscribers);
    }
}
