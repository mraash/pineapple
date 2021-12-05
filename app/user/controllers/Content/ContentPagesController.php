<?php

namespace app\user\controllers\Content;

use app\user\controllers\Content\pages\Index\IndexPage;

/**
 * Controller for static pages like index.html about.html contacts.html ect
 */
class ContentPagesController
{
    public function indexPage() : void
    {
        $page = new IndexPage();
        $page->render();
    }
}
