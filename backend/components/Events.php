<?php

namespace backend\components;

use backend\models\Expenses;
use backend\models\Products;
use backend\components\events\OperationsHistoryEvent;
use backend\models\Profit;
use yii\base\Component;
use yii\base\Event;

class Events extends Component
{
    /**
     * Init global Events
     */
    public function init()
    {
        Event::on(Products::class,Products::EVENT_SAVE_HISTORY,  [OperationsHistoryEvent::class, 'save']);
        Event::on(Expenses::class,Expenses::EVENT_SAVE_HISTORY,  [OperationsHistoryEvent::class, 'save']);
        Event::on(Profit::class,Profit::EVENT_SAVE_HISTORY,  [OperationsHistoryEvent::class, 'save']);
    }
}