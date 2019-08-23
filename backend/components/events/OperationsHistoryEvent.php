<?php

namespace backend\components\events;

use backend\models\OperationsHistory;
use yii\base\Event;

class OperationsHistoryEvent extends Event
{
    /**
     * @var string operation
     */
    public $operation;

    /**
     * @param $event
     * @throws \ErrorException
     */
    public function save($event)
    {
        $operationHistoryModel = new OperationsHistory();
        $operationHistoryModel->owner_id = $event->sender->owner_id;
        $operationHistoryModel->operation = $event->operation;
        $operationHistoryModel->model = get_class($event->sender);
        $operationHistoryModel->model_id = $event->sender->id;

        if (!$operationHistoryModel->save()) {
            throw new \ErrorException(get_class($event->sender) . ' can not save history');
        }

    }

}