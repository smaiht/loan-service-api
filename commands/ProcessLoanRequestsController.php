<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class ProcessLoanRequestsController extends Controller
{
    public function actionIndex(int $delay = 5)
    {
        if ($delay < 0) {
            $delay = 5;
        }

        Yii::$app->loanRequestService->process($delay);
    }
}