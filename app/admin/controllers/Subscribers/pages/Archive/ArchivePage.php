<?php

namespace app\admin\controllers\Subscribers\pages\Archive;

use app\general\models\Subscribers\SubscribersManager;
use app\admin\controllers\AdminPanelPage;
use app\admin\controllers\Subscribers\pages\Archive\GetParametrs;
use app\admin\controllers\Subscribers\pages\Archive\Pagination;


class ArchivePage extends AdminPanelPage
{
    private const TEMPLATE_FILENAME = 'archive.html';

    private const CSV_TABLE_FILENAME = 'subscribers.csv';

    private const MODELS_DEFAULT_SORT = SubscribersManager::FILTER_SORT_BY_DATE;
    private const VIEWS_DEFAULT_SORT  = GetParametrs::VALUE_SORT_BY_DATE;

    private const PAGINATION_PAGE_ITEMS = 10;
    private const PAGINATION_MAX_LENGTH = 6;


    /** @var GetParametrs Pages get paramters */
    private $getParams;


    /**
     * @param int $pageNum Pagination page number
     */
    public function __construct(int $pageNum)
    {
        parent::__construct();

        $this->getParams = new GetParametrs();

        $filteringOptions = $this->getParams->getFilteringOptions();
        $filteringOptions['limit']  = self::PAGINATION_PAGE_ITEMS;
        $filteringOptions['offset'] = ($pageNum - 1) * self::PAGINATION_PAGE_ITEMS;

        if (!$this->getParams->hasSortBy()) {
            $filteringOptions['sortBy'] = self::MODELS_DEFAULT_SORT;
        }


        $model = SubscribersManager::getInstance();

        $subscribersData = $model->getList($filteringOptions);
        $providersData   = $model->getActiveProviders();
        $paginationObject = new Pagination([
            'currentPage'    => $pageNum,
            'itemsOnOnePage' => self::PAGINATION_PAGE_ITEMS,
            'totalItems'     => $subscribersData['total'],
            'maxLength'      => self::PAGINATION_MAX_LENGTH,
        ]);


        $subscribers = $this->buildSubscribersPD($subscribersData['list']);
        $pagination  = $this->buildPaginationPD($paginationObject);
        $keyword     = $this->buildKeywordPD();
        $sorting     = $this->buildSortingPD();
        $providers   = $this->buildProvidersPD($providersData);


        $this->pageData->set('subscribers', $subscribers);
        $this->pageData->set('pagination', $pagination);
        $this->pageData->set('filter_form', [
            'method' => 'GET',
            'action' => '/admin/subscribers/page/1',
        ]);
        $this->pageData->set('filter', [
            'keyword'   => $keyword,
            'sorting'   => $sorting,
            'providers' => $providers,
        ]);
        $this->pageData->set('csv_table', [
            'uri'      => '/admin-downloads/subscibers.csv',
            'file_name' => self::CSV_TABLE_FILENAME,
        ]);
    }


    public function render() : void
    {
        $this->renderTwigFile(self::TEMPLATE_FILENAME);
    }


    private function buildSubscribersPD(array $subscribers) : array
    {
        $result = [];

        foreach ($subscribers as $i => $subscriberRow) {
            $id = $subscriberRow['id'];

            $subscriberView = [
                'html_name'  => GetParametrs::NAME_SUBSCRIBER,
                'html_value' => $id,
                'is_checked' => $this->getParams->isSubscriberChecked($id),
                'email'      => $subscriberRow['email'],
                'date'       => $subscriberRow['date'],
            ];

            $result[$i] = $subscriberView;
        }

        return $result;
    }


    private function buildPaginationPD(Pagination $pagination) : array
    {
        $uriBase = '/' . URI_PREFIX_ADMIN_PAGES . '/subscribers/page/';

        $pagitems = $pagination->getListOfItems(function($pageNum, $isCurrent) use ($uriBase) {
            $link = $uriBase . $pageNum . $this->getParams->getFullQueryString();

            return [
                'link' => $link,
                'number' => $pageNum,
                'is_current' => $isCurrent,
            ];
        });

        $result = [
            'list'      => $pagitems['items'],
            'has_first' => $pagitems['hasLeftTail'],
            'has_last'  => $pagitems['hasRightTail'],
        ];

        if ($pagitems['hasLeftTail']) {
            $result['first'] = [
                'link' => "{$uriBase}{$pagination->getFirstPageNumber()}",
            ];
        }

        if ($pagitems['hasRightTail']) {
            $result['last'] = [
                'link'  => "{$uriBase}{$pagination->getLastPageNumber()}",
            ];
        }

        return $result;
    }


    private function buildKeywordPD() : array
    {
        return [
            'html_name'  => GetParametrs::NAME_KEYWORD,
            'html_value' => $this->getParams->getKeywordValue() ?? '',
        ];
    }


    private function buildSortingPD() : array
    {
        $selected = $this->getParams->getSelectedSortBy() ?: self::VIEWS_DEFAULT_SORT;

        return [
            [
                'html_name'  => GetParametrs::NAME_SORT_BY,
                'html_value' => GetParametrs::VALUE_SORT_BY_NAME,
                'content'    => 'name',
                'is_active'  => $selected === GetParametrs::VALUE_SORT_BY_NAME,
            ],
            [
                'html_name'  => GetParametrs::NAME_SORT_BY,
                'html_value' => GetParametrs::VALUE_SORT_BY_DATE,
                'content'    => 'date',
                'is_active'  => $selected === GetParametrs::VALUE_SORT_BY_DATE,
            ],
        ];
    }


    private function buildProvidersPD(array $providers) : array
    {
        $result = [];

        foreach ($providers as $i => $provider) {
            $value = $providers[$i]['id'];

            $result[$i] = [
                'html_name'  => GetParametrs::NAME_PROVIDER,
                'html_value' => $value,
                'is_checked' => $this->getParams->isProviderChecked($value),
                'name'       => $providers[$i]['name'],
            ];
        }

        return $result;
    }
}
