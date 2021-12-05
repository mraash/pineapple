<?php

namespace app\user\controllers;

use app\general\controllers\TwigPage;

abstract class UserPanelPage extends TwigPage
{
    public function __construct()
    {
        parent::__construct(PATH_USER_VIEWS);
    }
}
