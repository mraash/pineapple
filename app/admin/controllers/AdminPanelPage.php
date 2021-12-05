<?php

namespace app\admin\controllers;

use app\general\controllers\TwigPage;

abstract class AdminPanelPage extends TwigPage
{
    protected function __construct()
    {
        parent::__construct(PATH_ADMIN_VIEWS);
    }
}
