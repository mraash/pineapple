<?php

namespace app\admin\controllers\Subscribers;

use app\admin\libraries\CSV\CsvTable;
use app\general\models\Subscribers\SubscribersManager;


class SubscribersDownloadsController
{
    public function csvTable() : void
    {
        $csv = new CsvTable(['email', 'date']);
        $ids = $_GET['ids'] ?? [];

        if (!empty($ids)) {
            $model = SubscribersManager::getInstance();
            $subscribers = $model->getList([ 'ids' => $ids ])['list'];

            foreach ($subscribers as $subscriber) {
                $email = $subscriber['email'];
                $date  = $subscriber['date'];

                $csv->addRow([ $email, $date ]);
            }
        }

        header('Content-Type: text\csv');
        echo $csv->toString();
    }
}
