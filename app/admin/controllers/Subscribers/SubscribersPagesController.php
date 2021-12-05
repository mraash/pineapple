<?php

namespace app\admin\controllers\Subscribers;

use app\admin\controllers\Subscribers\pages\Archive\ArchivePage;

class SubscribersPagesController
{
    public function indexPage($paginationPage) : void
    {
        $page = new ArchivePage($paginationPage);
        $page->render();
    }
}
