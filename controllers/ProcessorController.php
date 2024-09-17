<?php

namespace app\controllers;

use Yii;
use yii\web\Response;

class ProcessorController extends AbstractController
{
    public function actionProcess(int $delay = 5) : array
    {
        if ($delay < 0) {
            $delay = 5;
        }

        $command = Yii::getAlias('@app/yii') . " process-loan-requests/index $delay > /dev/null 2>&1 &";
        exec($command);

        Yii::$app->response->statusCode = 200;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['result' => true];
    }

}