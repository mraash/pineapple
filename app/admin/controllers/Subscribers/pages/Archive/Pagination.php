<?php

namespace app\admin\controllers\Subscribers\pages\Archive;

/**
 * @package app\admin\controllers\Subscribers\pages\Archive
 * 
 * @internal
 */
class Pagination
{
    /** @var int */
    private $currentPage;

    /** @var int */
    private $firstPage = 1;

    /** @var int */
    private $lastPage;

    /** @var int */
    private $maxLength;


    /**
     * @param array $options = [
     *    'currentPage'    => (int)
     *    'itemsOnOnePage' => (int)
     *    'totalItems'     => (int)
     * ]
     */
    public function __construct(array $options)
    {
        $currentPage    = $options['currentPage'];
        $itemsOnOnePage = $options['itemsOnOnePage'];
        $totalItems     = $options['totalItems'];
        $maxLength      = $options['maxLength'] ?? INF;

        $totalPages = (int)ceil($totalItems / $itemsOnOnePage);

        $this->maxLength   = $maxLength;
        $this->currentPage = $currentPage;
        $this->lastPage    = $totalPages;
    }


    /**
     * @param callback $itemHandler  Function for handling one pagination item
     *   It will be called with two arguments:
     *     1 (int)    Items page number
     *     2 (bool)   Is item current
     *   It shoud return value that will be added in method results['items'] array
     * 
     * @return array [
     *    'hasLeftTail'  => (bool),
     *    'hasRightTail' => (bool),
     *    'items'        => (array) Array of handled items,
     */
    public function getListOfItems(callable $itemHandler) : array
    {
        $startItem = $this->currentPage < $this->lastPage ? $this->currentPage : $this->lastPage;

        $items = [];
        $items[] = $itemHandler($startItem, $startItem === $this->currentPage);

        $leftItem        = $startItem;
        $rightItem       = $startItem;

        $iteration       = 0;
        $isLeftSideTurn  = false;

        while (++$iteration < $this->maxLength) {
            $canAddToLeft  = $leftItem > $this->firstPage;
            $canAddToRight = $rightItem < $this->lastPage;

            if (($isLeftSideTurn && $canAddToLeft) || (!$canAddToRight && $canAddToLeft)) {
                $leftItem--;

                $handledItem = $itemHandler($leftItem, false);
                array_unshift($items, $handledItem);
            }
            else if (!$isLeftSideTurn && $canAddToRight || (!$canAddToLeft && $canAddToRight)) {
                $rightItem++;

                $handledItem = $itemHandler($rightItem  , false);
                array_push($items, $handledItem);
            }
            else {
                break;
            }

            $isLeftSideTurn = !$isLeftSideTurn;
        }

        return [
            'hasLeftTail'  => $leftItem > $this->firstPage,
            'hasRightTail' => $rightItem < $this->lastPage,
            'items' => $items,
        ];
    }


    public function getLastPageNumber() : int
    {
        return $this->lastPage;
    }

    /**
     * It always will return 1 so method is pointless, but it looks pretty
     */
    public function getFirstPageNumber() : int
    {
        return $this->firstPage;
    }
}
